<?php require 'Header.php'; ?>
<link rel="stylesheet" href="styles/mockup.css">
<main>
    <div class="titlePage mockupgenerator">
        <img src="./img/mockupgenerator/imgtriangle.png" alt="Image de la page" class="triangleimg">
        <img src="./img/mockupgenerator/circleflower.png" alt="Image de la page" class="circletriangleimg">
        <img src="./img/mockupgenerator/flower.png" alt="Image de la page" class="flowerimg">
        <img src="./img/mockupgenerator/imgtriangleinverse.png" alt="Image de la page" class="imgtriangleinverse">
        <h1>Générer un mockup.</h1>
    </div>

    <div class="contentPage">
        <section class="selectParameters">
            <!-- PAGE 1 -->
            <div class="page1" id="p1">
                <h2>Sélectionnez le format idéal pour votre mockup</h2>
                <div class="listformat">
                    <div class="cardformat">
                        <p class="format-ratio">1:1</p>
                        <div class="f1 format-preview"></div>
                        <p class="format-description">Carré / Idéal pour Instagram</p>
                    </div>
                    <div class="cardformat">
                        <p class="format-ratio">16:9</p>
                        <div class="f2 format-preview"></div>
                        <p class="format-description">Horizontal / Écrans d'ordinateur</p>
                    </div>
                    <div class="cardformat">
                        <p class="format-ratio">9:16</p>
                        <div class="f3 format-preview"></div>
                        <p class="format-description">Vertical / Stories mobiles</p>
                    </div>
                </div>
                <div class="button-container">
                    <button class="continue-button" id="cp1">Continuer</button>
                </div>
            </div>

            <!-- PAGE 2 -->
            <div class="page2" id="p2">
                <h2>Sélectionnez le mockup idéal</h2>
                <div class="listformat">
                    <div class="cardmockup">
                        <img src="./img/mockupgenerator/mockup/ordinateur.png" alt="Ordinateur">
                        <p class="format-description">Ordinateur</p>
                    </div>
                    <div class="cardmockup">
                        <img src="./img/mockupgenerator/mockup/tablette.png" alt="Tablette">
                        <p class="format-description">Tablette</p>
                    </div>
                    <div class="cardmockup">
                        <img src="./img/mockupgenerator/mockup/telephone.png" alt="Téléphone">
                        <p class="format-description">Téléphone</p>
                    </div>
                </div>
                <div class="button-container">
                    <button class="continue-button" id="cp2" disabled>Continuer</button>
                </div>
            </div>

            <!-- PAGE 3 -->
            <div class="page3 mockupscene" id="p3" style="display: none;">
                <div class="leftmenu"></div>
          <div class="canvascene" id="canvas-container">
  <div id="mockupcanvas" class="mockupcanvas"></div>
</div>

                <div class="rightmenu"></div>
            </div>
        </section>
    </div>
</main>
<?php require 'Footer.php'; ?>
<script src="https://unpkg.com/konva@9.3.0/konva.min.js"></script>
<script>

document.addEventListener('DOMContentLoaded', () => {
    const page1 = document.getElementById('p1');
    const page2 = document.getElementById('p2');
    const page3 = document.getElementById('p3');

    const cardsFormat = document.querySelectorAll('.cardformat');
    const continueBtnP1 = document.getElementById('cp1');

    const cardsMockup = document.querySelectorAll('.cardmockup');
    const continueBtnP2 = document.getElementById('cp2');

    // Masquer pages 2 et 3 au chargement
    page2.style.display = 'none';
    page3.style.display = 'none';

    // PAGE 1 - Sélection format
    const updateButtonP1 = () => {
        const active = document.querySelector('.cardformat.active');
        continueBtnP1.disabled = !active;
        continueBtnP1.classList.toggle('active', !!active);
    };

    cardsFormat.forEach(card => {
        card.addEventListener('click', () => {
            cardsFormat.forEach(c => c.classList.remove('active'));
            card.classList.add('active');
            updateButtonP1();
        });
    });

    continueBtnP1.addEventListener('click', () => {
        if (!continueBtnP1.disabled) {
            page1.style.display = 'none';
            page2.style.display = 'block';
        }
    });

    updateButtonP1();

    // PAGE 2 - Sélection mockup
    const updateButtonP2 = () => {
        const active = document.querySelector('.cardmockup.active');
        continueBtnP2.disabled = !active;
        continueBtnP2.classList.toggle('active', !!active);
    };

    cardsMockup.forEach(card => {
        card.addEventListener('click', () => {
            cardsMockup.forEach(c => c.classList.remove('active'));
            card.classList.add('active');
            updateButtonP2();
        });
    });

    continueBtnP2.addEventListener('click', () => {
        if (!continueBtnP2.disabled) {
            page2.style.display = 'none';
            page3.style.display = 'flex';
            initializeCanvas();
        }
    });

    updateButtonP2();
});

function initializeCanvas() {
    const container = document.getElementById('mockupcanvas');
    if (!container) return;

    const selectedFormatCard = document.querySelector('.cardformat.active');
    if (!selectedFormatCard) return;

    const ratioText = selectedFormatCard.querySelector('.format-ratio').textContent.trim();

    container.classList.remove('square', 'desktop', 'mobile');
    if (ratioText === '1:1') {
        container.classList.add('square');
    } else if (ratioText === '16:9') {
        container.classList.add('desktop');
    } else if (ratioText === '9:16') {
        container.classList.add('mobile');
    }

    function resizeStage() {
        const width = container.clientWidth;
        const height = container.clientHeight;

        if (!window.kStage) {
            window.kStage = new Konva.Stage({
                container: 'mockupcanvas',
                width: width,
                height: height,
            });

            const layer = new Konva.Layer();
            window.kStage.add(layer);

            const selectedMockupCard = document.querySelector('.cardmockup.active');
            const mockupImageSrc = selectedMockupCard ? selectedMockupCard.querySelector('img').src : '';
            const mockupType = selectedMockupCard ? selectedMockupCard.querySelector('p.format-description').textContent.toLowerCase() : '';

            if (mockupImageSrc) {
                const imageObj = new Image();
                imageObj.onload = function () {
                    const scale = Math.min(
                        width / imageObj.width,
                        height / imageObj.height
                    );

                    const imgWidth = imageObj.width * scale;
                    const imgHeight = imageObj.height * scale;
                    const imgX = (width - imgWidth) / 2;
                    const imgY = (height - imgHeight) / 2;

                    // Offset en % responsive selon type mockup
                    let offsetPercent = 0;
                    if (mockupType.includes('ordinateur')) {
                        offsetPercent = 0.22; // 15%
                    } else if (mockupType.includes('téléphone')) {
                        offsetPercent = 0.45; // 5%
                    } else if (mockupType.includes('tablette')) {
                        offsetPercent = 0.30; // 10%
                    }

                    const widthOffset = imgWidth * offsetPercent;
                    const rectWidth = imgWidth - widthOffset;
                    const rectX = (width - rectWidth) / 2;

                    // Créer le rectangle blanc (fond)
                    const backgroundRect = new Konva.Rect({
                        x: rectX,
                        y: imgY,
                        width: rectWidth,
                        height: imgHeight,
                        fill: 'white',
                        name: 'background-rect',
                    });

                    // Créer l'image Konva
                    const konvaImage = new Konva.Image({
                        image: imageObj,
                        x: imgX,
                        y: imgY,
                        width: imgWidth,
                        height: imgHeight,
                        name: 'mockup-image',
                    });

                    layer.add(backgroundRect);
                    layer.add(konvaImage);
                    layer.draw();
                };
                imageObj.src = mockupImageSrc;
            }
        } else {
            window.kStage.width(width);
            window.kStage.height(height);

            const image = window.kStage.findOne('.mockup-image');
            const backgroundRect = window.kStage.findOne('.background-rect');

            const selectedMockupCard = document.querySelector('.cardmockup.active');
            const mockupType = selectedMockupCard ? selectedMockupCard.querySelector('p.format-description').textContent.toLowerCase() : '';

            if (image && backgroundRect) {
                const scale = Math.min(
                    width / image.image().width,
                    height / image.image().height
                );

                const imgWidth = image.image().width * scale;
                const imgHeight = image.image().height * scale;
                const imgX = (width - imgWidth) / 2;
                const imgY = (height - imgHeight) / 2;

                let offsetPercent = 0;
                if (mockupType.includes('ordinateur')) {
                    offsetPercent = 0.22; // 15%
                } else if (mockupType.includes('téléphone')) {
                    offsetPercent = 0.45; // 5%
                } else if (mockupType.includes('tablette')) {
                    offsetPercent = 0.30; // 10%
                }

                const widthOffset = imgWidth * offsetPercent;
                const rectWidth = imgWidth - widthOffset;
                const rectX = (width - rectWidth) / 2;

                image.width(imgWidth);
                image.height(imgHeight);
                image.x(imgX);
                image.y(imgY);

                backgroundRect.width(rectWidth);
                backgroundRect.height(imgHeight);
                backgroundRect.x(rectX);
                backgroundRect.y(imgY);
            }

            window.kStage.draw();
        }
    }

    resizeStage();
    window.addEventListener('resize', resizeStage);
}

</script>
