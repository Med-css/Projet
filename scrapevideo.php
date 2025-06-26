<?php
header('Content-Type: application/json');

$url = $_POST['url'] ?? '';
$platform = $_POST['platform'] ?? '';

// Validation de base
if (!$url) {
    echo json_encode(['error' => 'URL is required']);
    exit;
}

// Fonction pour valider une URL YouTube côté serveur
function isValidYouTubeUrlServer($url) {
    $pattern = '/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+/';
    return preg_match($pattern, $url) === 1;
}

// Fonction pour valider une URL TikTok côté serveur
function isValidTikTokUrlServer($url) {
    $pattern = '/^(https?:\/\/)?(www\.)?(tiktok\.com)\/.+/';
    return preg_match($pattern, $url) === 1;
}

// Validation en fonction de la plateforme
$isValid = false;
if ($platform === 'youtube') {
    $isValid = isValidYouTubeUrlServer($url);
    if (!$isValid) {
        echo json_encode(['error' => 'URL YouTube invalide']);
        exit;
    }
} elseif ($platform === 'tiktok') {
    $isValid = isValidTikTokUrlServer($url);
    if (!$isValid) {
        echo json_encode(['error' => 'URL TikTok invalide']);
        exit;
    }
} else {
    echo json_encode(['error' => 'Plateforme non reconnue']);
    exit;
}

// Vérifier si yt-dlp est installé
$ytDlpCheck = shell_exec('which yt-dlp 2>&1');
if (empty($ytDlpCheck)) {
    echo json_encode(['error' => 'yt-dlp is not installed or not in PATH']);
    exit;
}

// Vérifier si yt-dlp est installé
$ytDlpCheck = shell_exec('which yt-dlp 2>&1');
if (empty($ytDlpCheck)) {
    echo json_encode(['error' => 'yt-dlp is not installed or not in PATH']);
    exit;
}

// Utiliser yt-dlp pour obtenir les infos avec la commande recommandée
// et désactiver le cache pour éviter les problèmes de permissions
$command = "yt-dlp --no-cache-dir -j --skip-download " . escapeshellarg($url);
$output = shell_exec($command . ' 2>&1');

// Configuration
$logFile = __DIR__ . '/logs/yt-dlp.log';

// Assurez-vous que le répertoire de logs existe
if (!is_dir(dirname($logFile))) {
    mkdir(dirname($logFile), 0777, true);
}
// Enregistrer la commande et la sortie dans le fichier de log
if (!file_exists($logFile)) {
    file_put_contents($logFile, "Log file created on " . date('Y-m-d H:i:s') . "\n");
}

// Tronquer le output si nécessaire
$logOutput = (preg_match('/^(ERROR|WARNING)/', $output)) ? $output : substr($output, 0, 100) . '...';

// Log the command and output
error_log(date('[Y-m-d H:i:s] ') . "Command: $command\nOutput: $logOutput\n\n", 3, $logFile);


if (empty($output)) {
    echo json_encode(['error' => 'Failed to fetch video info', 'details' => 'No output from yt-dlp']);
    exit;
}

// Essayer de décoder la sortie JSON
$data = json_decode($output, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    // Parfois, yt-dlp peut retourner des avertissements avant le JSON
    // On peut essayer de trouver le JSON dans la sortie complète
    $jsonStart = strpos($output, '{');
    if ($jsonStart !== false) {
        $jsonStr = substr($output, $jsonStart);
        $data = json_decode($jsonStr, true);
        if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {
            // Si le décodage réussit, continuer
        } else {
            // Sinon, retourner l'erreur originale
            echo json_encode([
                'error' => 'Failed to decode video info',
                'output' => $output,
                'json_error' => json_last_error_msg()
            ]);
            exit;
        }
    } else {
        echo json_encode([
            'error' => 'Failed to decode video info',
            'output' => $output,
            'json_error' => json_last_error_msg()
        ]);
        exit;
    }
}

if (empty($data)) {
    echo json_encode(['error' => 'No data returned from yt-dlp', 'output' => $output]);
    exit;
}

// Vérifier si la sortie contient des erreurs de yt-dlp
if (isset($data['_type']) && $data['_type'] === 'error') {
    echo json_encode(['error' => 'yt-dlp error: ' . ($data['error'] ?? 'Unknown error'), 'output' => $output]);
    exit;
}

// Fonction pour extraire la miniature correcte
function getThumbnailUrl($data, $platform) {
    // Pour YouTube, essayer d'abord la propriété thumbnail, puis le premier thumbnail
    if ($platform === 'youtube') {
        if (isset($data['thumbnail']) && !empty($data['thumbnail'])) {
            return $data['thumbnail'];
        } elseif (isset($data['thumbnails'][0]['url'])) {
            return $data['thumbnails'][0]['url'];
        }
    }
    // Pour TikTok, chercher le thumbnail avec l'ID "cover"
    elseif ($platform === 'tiktok') {
        if (isset($data['thumbnails'])) {
            foreach ($data['thumbnails'] as $thumbnail) {
                if (isset($thumbnail['id']) && $thumbnail['id'] === 'dynamicCover') {
                    return $thumbnail['url'];
                }
            }
            // Si aucun thumbnail avec ID "cover" n'est trouvé, retourner le premier
            if (!empty($data['thumbnails'])) {
                return $data['thumbnails'][0]['url'];
            }
        }
    }
    // Par défaut, retourner une chaîne vide
    return '';
}

// Extraire les infos nécessaires
$title = $data['title'] ?? 'No title';
$thumbnail = getThumbnailUrl($data, $platform);

echo json_encode([
    'title' => $title,
    'thumbnail' => $thumbnail
]);