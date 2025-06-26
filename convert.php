<?php

// Configuration
$logFile = __DIR__ . '/logs/conversion.log';
$timeout = 20; // secondes

// Assurez-vous que le dossier de logs existe
if (!is_dir(dirname($logFile))) {
    mkdir(dirname($logFile), 0777, true);
}

if (!file_exists($logFile)) {
    file_put_contents($logFile, "Log file created on " . date('Y-m-d H:i:s') . "\n");
}

// Fonction pour enregistrer les messages dans le log
function logMessage($message) {
    global $logFile;
    error_log(date('[Y-m-d H:i:s] ') . $message . PHP_EOL, 3, $logFile);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Méthode non autorisée.";
    exit;
}

// Récupération des données
$type = $_POST['type'] ?? null;
$format = $_POST['format'] ?? null;
$file = $_FILES['file'] ?? null;

if (!$type || !$format || !$file || $file['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo "Paramètres invalides.";
    logMessage("Requête invalide : type=$type, format=$format, fichier absent ou corrompu.");
    exit;
}

$tmpName = $file['tmp_name'];
$originalName = pathinfo($file['name'], PATHINFO_FILENAME);
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$mime = mime_content_type($tmpName);
logMessage("Fichier reçu : $originalName.$ext (MIME: $mime)");

// Définir le chemin de sortie
$targetFile = sys_get_temp_dir() . '/' . uniqid('converted_', true) . '.' . escapeshellcmd($format);

// Initialisation
$output = [];
$returnCode = 0;

// Traitement selon le type
switch ($type) {
    case 'image':
        // ImageMagick - qualité optimisée, sans redimensionnement
        $cmd = sprintf(
            'timeout %d convert %s -quality 92 -strip %s',
            $timeout,
            escapeshellarg($tmpName),
            escapeshellarg($targetFile)
        );
        break;

    case 'video':
        // FFmpeg - H.264 vidéo + AAC audio
        $cmd = sprintf(
            'timeout %d ffmpeg -y -i %s -c:v libx264 -crf 23 -preset medium -c:a aac -b:a 128k %s 2>&1',
            $timeout,
            escapeshellarg($tmpName),
            escapeshellarg($targetFile)
        );
        break;

    case 'audio':
        // FFmpeg - AAC audio
        $cmd = sprintf(
            'timeout %d ffmpeg -y -i %s -c:a aac -b:a 128k %s 2>&1',
            $timeout,
            escapeshellarg($tmpName),
            escapeshellarg($targetFile)
        );
        break;

    case 'pdf':
    case 'document':
        // LibreOffice headless
        $outputDir = dirname($targetFile);
        $cmd = sprintf(
            'timeout %d libreoffice --headless --convert-to %s --outdir %s %s 2>&1',
            $timeout,
            escapeshellarg($format),
            escapeshellarg($outputDir),
            escapeshellarg($tmpName)
        );
        break;

    case 'archive':
        // Décompression
        $tempDir = sys_get_temp_dir() . '/' . uniqid('unzip_', true);
        mkdir($tempDir, 0777, true);
        $inputExt = strtolower($ext);

        switch ($inputExt) {
            case 'zip':
                $extractCmd = sprintf('timeout %d unzip %s -d %s 2>&1', $timeout, escapeshellarg($tmpName), escapeshellarg($tempDir));
                break;
            case '7z':
            case 'rar':
                $extractCmd = sprintf('timeout %d 7z x %s -o%s 2>&1', $timeout, escapeshellarg($tmpName), escapeshellarg($tempDir));
                break;
            default:
                http_response_code(400);
                echo "Format d'archive non supporté.";
                logMessage("Archive non supportée : .$inputExt");
                exit;
        }

        exec($extractCmd, $output, $returnCode);
        if ($returnCode !== 0) {
            http_response_code(500);
            echo "Erreur de décompression.";
            logMessage("Erreur de décompression : " . implode("\n", $output));
            exit;
        }

        // Recompression
        $cmd = sprintf(
            'timeout %d 7z a -t%s -mx=9 %s %s 2>&1',
            $timeout,
            escapeshellarg($format),
            escapeshellarg($targetFile),
            escapeshellarg($tempDir . '/*')
        );
        break;

    default:
        http_response_code(400);
        echo "Type non supporté.";
        logMessage("Type non pris en charge : $type");
        exit;
}

// Exécution de la commande si définie
if (!isset($cmd)) {
    http_response_code(500);
    echo "Commande non définie.";
    logMessage("Aucune commande générée.");
    exit;
}

exec($cmd, $output, $returnCode);
logMessage("Commande exécutée : $cmd");
logMessage("Résultat : " . implode("\n", $output));

if ($returnCode !== 0 || !file_exists($targetFile)) {
    http_response_code(500);
    echo "Erreur de conversion.";
    logMessage("Échec de conversion (code: $returnCode), fichier non généré.");
    exit;
}

// Envoi du fichier
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($targetFile) . '"');
readfile($targetFile);

// Nettoyage
unlink($targetFile);
if (isset($tempDir) && is_dir($tempDir)) {
    exec('rm -rf ' . escapeshellarg($tempDir));
}
unlink($tmpName);

logMessage("Conversion réussie : $originalName.$ext -> $targetFile");