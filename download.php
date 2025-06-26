<?php
if (isset($_GET['url']) && isset($_GET['platform']) && isset($_GET['format'])) {
    $url = $_GET['url'] ?? '';
    $platform = $_GET['platform'] ?? '';
    $format = $_GET['format'] ?? 'mp4';

    if (!$url) {
        die('URL is required');
    }

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        die('Invalid URL');
    }

    // Options de yt-dlp pour MP4 ou MP3
    $formatOption = ($format === 'mp3') ? '-x --audio-format mp3' : '-f "bestvideo[ext=mp4]+bestaudio[ext=m4a]/best[ext=mp4]/best"';

    $tempDir = sys_get_temp_dir();
    $fileName = tempnam($tempDir, 'download_') . (($format === 'mp3') ? '.mp3' : '.mp4');
    $command = "yt-dlp $formatOption -o " . escapeshellarg($fileName) . " " . escapeshellarg($url);

    // Exécuter la commande et capturer la sortie pour le débogage
    $output = [];
    $returnVar = 0;
    exec($command . ' 2>&1', $output, $returnVar);

    // Vérifier si la commande a échoué
    if ($returnVar !== 0) {
        die('Failed to download video: ' . htmlspecialchars(implode("\n", $output)));
    }

    // Vérifier si le fichier a été créé et n'est pas vide
    if (!file_exists($fileName) || filesize($fileName) == 0) {
        die('Failed to download video: ' . htmlspecialchars(implode("\n", $output)));
    }

    // Déterminer le type MIME
    $mimeType = ($format === 'mp3') ? 'audio/mpeg' : 'video/mp4';

    // Envoyer le fichier au navigateur
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $mimeType);
    header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fileName));

    // Vider le buffer de sortie
    if (ob_get_level()) {
        ob_end_clean();
    }

    // Lire le fichier et l'envoyer au navigateur
    readfile($fileName);

    // Supprimer le fichier temporaire
    unlink($fileName);
    exit;
}

