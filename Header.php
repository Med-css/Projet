<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/global.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

</head>
<body>
    <header>
        <h1>Test</h1>
        <nav>
            <div class="headerCard" id="editingimages">
                <a href="editimage.php">
                <div class="cardIcon">
                    <img src="./img/editimage.png">
                    <p>Editing Images</p>
                </div>
                </a>
            </div>
                 <div class="headerCard" id="convertfiles">
                <a href="convertfiles.php">

                <div class="cardIcon">
                    <img src="./img/convertfile.png">
                    <p>Convert Files</p>
                </div>
                </a>
            </div>
                 <div class="headerCard" id="downloadvideos">
                <a href="videodownloader.php">
                <div class="cardIcon">
                    <img src=">
                    <p class="long-text">Download Videos</p>
                </div> 
                </a>
            </div>
            <div class="headerCard">
                <div class="cardIcon"></div>
            </div>
            <div class="headerCard">
                <div class="cardIcon"></div>
            </div>
            <div class="headerCard">
                <div class="cardIcon"></div>
            </div>
            <div class="headerCard">
                <div class="cardIcon"></div>
            </div>
            <div class="headerCard">
                <div class="cardIcon"></div>
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