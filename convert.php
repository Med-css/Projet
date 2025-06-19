<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Méthode non autorisée.";
    exit;
}

$type = $_POST['type'] ?? null;
$format = $_POST['format'] ?? null;
$file = $_FILES['file'] ?? null;

if (!$type || !$format || !$file || $file['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo "Paramètres invalides.";
    exit;
}

$tmpName = $file['tmp_name'];
$originalName = pathinfo($file['name'], PATHINFO_FILENAME);
$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$targetFile = sys_get_temp_dir() . '/' . uniqid('converted_', true) . '.' . $format;

switch ($type) {
    case 'image':
        exec("convert $tmpName $targetFile");
        break;
    case 'video':
        exec("ffmpeg -i $tmpName $targetFile");
        break;
    case 'audio':
        exec("ffmpeg -i $tmpName $targetFile");
        break;
    case 'pdf':
    case 'document':
        exec("unoconv -f $format -o $targetFile $tmpName");
        break;
    case 'archive':
        $tempDir = sys_get_temp_dir() . '/' . uniqid('unzip_', true);
        mkdir($tempDir);

        // Détection du format d’archive en entrée
        $inputExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Décompression
        switch ($inputExt) {
            case 'zip':
                exec("unzip " . escapeshellarg($tmpName) . " -d " . escapeshellarg($tempDir));
                break;
            case '7z':
                exec("7z x " . escapeshellarg($tmpName) . " -o" . escapeshellarg($tempDir));
                break;
            case 'rar':
                exec("7z x " . escapeshellarg($tmpName) . " -o" . escapeshellarg($tempDir));
                break;
            default:
                http_response_code(400);
                echo "Format d'archive non supporté en entrée.";
                exit;
        }

        // Recompression
        $targetFile = sys_get_temp_dir() . '/' . uniqid('converted_', true) . '.' . $format;

        // Exemples de formats valides : zip, 7z, tar
        exec("7z a -t" . escapeshellarg($format) . " " . escapeshellarg($targetFile) . " " . escapeshellarg($tempDir . '/*'));
        break;
    default:
        http_response_code(400);
        echo "Type non supporté.";
        exit;
}

// Envoi du fichier
if (!file_exists($targetFile)) {
    http_response_code(500);
    echo "Erreur de conversion.";
    exit;
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($targetFile) . '"');
readfile($targetFile);
unlink($targetFile);
