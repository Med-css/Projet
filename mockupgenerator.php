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
                        <img src="./img/mockupgenerator/mockup/ordinateur.png" alt="">
                        <p class="format-description">Ordinateur</p>
                    </div>
                    <div class="cardmockup">
                        <img src="./img/mockupgenerator/mockup/tablette.png" alt="">
                        <p class="format-description">Tablette</p>
                    </div>
                    <div class="cardmockup">
                        <img src="./img/mockupgenerator/mockup/telephone.png" alt="">
                        <p class="format-description">Téléphone</p>
                    </div>
                </div>
                <div class="button-container">
                    <button class="continue-button" id="cp2" disabled>Continuer</button>
                </div>
            </div>

            <!-- PAGE 3 -->
            <div class="page3 mockupscene" id="p3" style="display:none;">

                
            </div>
        </section>
    </div>
</main>
<?php require 'Footer.php'; ?>

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
            page3.style.display = 'block';
            initializeCanvas();
        }
    });

    updateButtonP2();
});

function initializeCanvas() {
    const canvasElement = document.getElementById('mockupCanvas');
    const previewArea = document.querySelector('.mockup-preview-area');
    const dpr = window.devicePixelRatio || 1;

    const canvas = new fabric.Canvas('mockupCanvas', {
        selection: false,
        hoverCursor: 'default',
    });

    function resizeCanvas() {
        const windowHeight = window.innerHeight;
        const headerHeight = 100; // Assurez-vous que cela correspond à la hauteur réelle de votre header
        const availableHeight = windowHeight - headerHeight;

        const rect = previewArea.getBoundingClientRect();
        let width = rect.width;
        let height = availableHeight;

        if (width === 0 || height === 0) {
            setTimeout(resizeCanvas, 50);
            return;
        }

        canvasElement.style.width = width + 'px';
        canvasElement.style.height = height + 'px';

        canvasElement.width = width * dpr;
        canvasElement.height = height * dpr;

        const ctx = canvas.contextContainer;
        ctx.setTransform(1, 0, 0, 1, 0, 0);
        ctx.scale(dpr, dpr);

        // Redimensionner en fonction du format choisi
        const selectedFormat = document.querySelector('.cardformat.active .format-ratio').textContent;
        adjustCanvasToFormat(canvas, selectedFormat, width, height);
    }

    function adjustCanvasToFormat(canvas, format, maxWidth, maxHeight) {
        switch (format) {
            case '1:1':
                const size = Math.min(maxWidth, maxHeight);
                canvas.setWidth(size);
                canvas.setHeight(size);
                break;
            case '16:9':
                const width169 = maxWidth;
                const height169 = width169 * 9 / 16;
                canvas.setWidth(width169);
                canvas.setHeight(height169);
                break;
            case '9:16':
                const height916 = maxHeight;
                const width916 = height916 * 9 / 16;
                canvas.setWidth(width916);
                canvas.setHeight(height916);
                break;
            default:
                canvas.setWidth(maxWidth);
                canvas.setHeight(maxHeight);
        }
        canvas.renderAll();
    }

    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();
}
</script>
<script src="https://cdn.jsdelivr.net/npm/fabric@5.2.4/dist/fabric.min.js"></script>
