<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Démarre la session seulement si elle n'est pas déjà active
}

define('BASE_URL', 'http://localhost:8082/');

$canonical_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$canonical_url .= "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$canonical_url = strtok($canonical_url, '?');
$canonical_url = htmlspecialchars($canonical_url);

$titleIndex = "Home Page";
$pageTitle = isset($pageTitle) ? htmlspecialchars($pageTitle) : htmlspecialchars($titleIndex);

$descriptionIndex = "A collection of tools for editing images, converting files, and downloading videos.";
$pageDescription = isset($pageDescription) ? htmlspecialchars($pageDescription) : htmlspecialchars($descriptionIndex);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= $pageTitle ?></title>
    <meta name="description" content="<?= $pageDescription ?>">

    <meta property="og:url" content="<?= $canonical_url ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $pageTitle ?>" />
    <meta property="og:description" content="<?= $pageDescription ?>" />
    <meta property="og:image" content="<?= BASE_URL ?>img/og-image.png" />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?= BASE_URL ?>img/og-image.png">
    <meta name="twitter:image:alt" content="Image">
    <meta name="twitter:title" content="<?= $pageTitle ?>">
    <meta name="twitter:description" content="<?= $pageDescription ?>">
    <meta name="twitter:site" content="@YourTwitterHandle">
    <meta name="twitter:creator" content="@YourTwitterHandle">

    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="7 days">
    <meta name="language" content="fr">

    <meta name="author" content="Your Name">
    <meta name="publisher" content="Your Name">
    <meta name="copyright" content="&copy; <?= date('Y') ?> Your Name">

    <meta name="keywords" content="image editing, file conversion, video downloading, mockup generator, online tools">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="canonical" href="<?= $canonical_url ?>">
    <link rel="icon" href="<?= BASE_URL ?>img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASE_URL ?>styles/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <!-- Schema.org -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "Your Website Name",
            "url": "<?= $canonical_url ?>",
            "description": "<?= $pageDescription ?>",
            "image": "<?= BASE_URL ?>img/og-image.png"
        }
    </script>
</head>
<body>
    <header>
        <h1>Menu</h1>
        <nav>
            <div class="headerCard" id="editingimages">
                <a href="editimage">
                    <div class="cardIcon">
                        <img src="./img/editimage.png" alt="Editing Images Icon">
                        <p>Editing Images</p>
                    </div>
                </a>
            </div>
            
            <div class="headerCard" id="convertfiles">
                <a href="convertfiles">
                    <div class="cardIcon">
                        <img src="./img/convertfile.png" alt="Convert Files Icon">
                        <p>Convert Files</p>
                    </div>
                </a>
            </div>

            <div class="headerCard" id="downloadvideos">
                <a href="videodownloader">
                    <div class="cardIcon">
                        <img src="./img/videodownloader.png" alt="Download Videos Icon">
                        <p>Download Videos</p>
                    </div>
                </a>
            </div>

            <div class="headerCard" id="mockup">
                <a href="mockupgenerator">
                    <div class="cardIcon">
                        <img src="./img/mockupgenerator.png" alt="mockup Icon">
                        <p>Générateur Mockup</p>
                    </div>
                </a>
            </div>

            <div class="headerCard">
                <a href="#">
                    <div class="cardIcon" style="display: none;">
                        <img src="./img/mockupgenerator.png" alt="Other Tools Icon">
                        <p>Other Tools</p>
                    </div>
                </a>
            </div>

            <div class="headerCard">
                <a href="#">
                    <div class="cardIcon" style="display: none;">
                        <img src="./img/mockupgenerator.png" alt="Other Tools Icon">
                        <p>Other Tools</p>
                    </div>
                </a>
            </div>

            <div class="headerCard">
                <a href="#">
                    <div class="cardIcon" style="display: none;">
                        <img src="./img/mockupgenerator.png" alt="Other Tools Icon">
                        <p>Other Tools</p>
                    </div>
                </a>
            </div>

            <div class="headerCard">
                <a href="#">
                    <div class="cardIcon" style="display: none;">
                        <img src="./img/mockupgenerator.png" alt="Other Tools Icon">
                        <p>Other Tools</p>
                    </div>
                </a>
            </div>
        </nav>
    </header>

    <script>
        // Script pour ajuster automatiquement la taille du texte selon sa longueur
        document.addEventListener('DOMContentLoaded', function() {
            const cardTexts = document.querySelectorAll('.cardIcon p');
            
            cardTexts.forEach(function(textElement) {
                const textLength = textElement.textContent.length;
                
                // Supprimer les anciens attributs data-length
                textElement.removeAttribute('data-length');
                
                // Attribuer une catégorie basée sur la longueur
                if (textLength <= 8) {
                    textElement.setAttribute('data-length', 'short');
                } else if (textLength <= 12) {
                    textElement.setAttribute('data-length', 'medium');
                } else if (textLength <= 16) {
                    textElement.setAttribute('data-length', 'long');
                } else {
                    textElement.setAttribute('data-length', 'very-long');
                }
            });
        });
    </script>
    <script>
        const headerCards = document.querySelectorAll('.headerCard');
        headerCards.forEach((card, index) => {
               // ajouter un delai animamtion à chacune avec 0.2s d'écrat à chaque petit à petit incrémentation
            // exemple la premier animation delay 0.2 la deuxième 0.4 la troisième 0.6 etc...
      
            card.style.animationDelay = `${index * 0.1}s`;
        });
    </script>