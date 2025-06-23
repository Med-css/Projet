<?php require 'Header.php'; ?>
<link rel="stylesheet" href="styles/videodownloader.css">

<main>
    <div class="titlePage videodownloader">
        <img src="./img/videodownloader/imgtriangle.png" alt="Image de la page" class="triangleimg">
        <img src="./img/videodownloader/circleflower.png" alt="Image de la page" class="circletriangleimg">
        <img src="./img/videodownloader/flower.png" alt="Image de la page" class="flowerimg">
        <img src="./img/videodownloader/imgtriangleinverse.png" alt="Image de la page" class="imgtriangleinverse">
        <h1>Télécharger une vidéo.</h1>
    </div>
    <div class="contentPage">
        <div class="platform-selection">
            <button class="btn-platform youtube-btn" data-platform="youtube">
                <i class="fab fa-youtube"></i> Télécharger de YouTube
            </button>
            <button class="btn-platform tiktok-btn" data-platform="tiktok">
                <i class="fab fa-tiktok"></i> Télécharger de TikTok
            </button>
        </div>

        <div class="downloader-container" id="youtube-downloader">
            <div class="input-section">
                <input type="text" class="video-url-input" placeholder="Collez le lien de la vidéo YouTube ici...">
            </div>
            <div class="previewyoutube">
                <!-- mettre en display block quand vidéo trouvée + miniature vidéo dans background image-->
            </div>
            <button class="btn-download" id="youtube-download-btn">Télécharger la vidéo YouTube</button>
        </div>

        <div class="downloader-container hidden" id="tiktok-downloader">
            <div class="input-section">
                <input type="text" class="video-url-input" placeholder="Collez le lien de la vidéo TikTok ici...">
            </div>
            <div class="previewtiktok">
                <!-- mettre en display block quand vidéo trouvée + miniature vidéo dans background image-->
            </div>
            <button class="btn-download" id="tiktok-download-btn">Télécharger la vidéo TikTok</button>
        </div>
        <div class="downloader-container" id="container1">
            <h2>Sélectionnez une plateforme.</h2>
        </div>
    </div>

<?php require 'Footer.php'; ?>
<script>
    // afficher la carte en fonction du bouton
document.addEventListener('DOMContentLoaded', () => {
    const youtubeBtn = document.querySelector('.youtube-btn');
    const tiktokBtn = document.querySelector('.tiktok-btn');
    const youtubeDownloader = document.getElementById('youtube-downloader');
    const tiktokDownloader = document.getElementById('tiktok-downloader');
    const container1 = document.getElementById('container1');

    function activatePlatform(platform) {
        youtubeBtn.classList.remove('active');
        tiktokBtn.classList.remove('active');
        youtubeDownloader.classList.add('hidden');
        tiktokDownloader.classList.add('hidden');

        if (platform === 'youtube') {
            container1.style.display = 'none';
            youtubeBtn.classList.remove('disabled');
            youtubeBtn.classList.add('active');
            youtubeDownloader.classList.remove('hidden');
            tiktokBtn.classList.add('disabled');
            tiktokBtn.classList.remove('active');
        } else if (platform === 'tiktok') {
            container1.style.display = 'none';
            tiktokBtn.classList.add('active');
            tiktokDownloader.classList.remove('hidden');
            tiktokBtn.classList.remove('disabled');
            youtubeBtn.classList.add('disabled');
            youtubeBtn.classList.remove('active');
        }
    }

    youtubeBtn.addEventListener('click', () => activatePlatform('youtube'));
    tiktokBtn.addEventListener('click', () => activatePlatform('tiktok'));

    youtubeDownloader.classList.add('hidden');
    tiktokDownloader.classList.add('hidden');

    //changer le contenu du bouton sur mobile responsive
    const downloadButtons = document.querySelectorAll('.btn-download');
    const originalButtonTexts = {};

    downloadButtons.forEach(button => {
        originalButtonTexts[button.dataset.platform] = button.innerHTML;
    });

    function updateButtonText() {
        if (window.innerWidth <= 501) {
            downloadButtons.forEach(button => {
                button.innerHTML = '<i class="fas fa-download"></i>';
            });
        } else {
            downloadButtons.forEach(button => {
                const platform = button.closest('.downloader-container').id.includes('youtube') ? 'youtube' : 'tiktok';
                button.innerHTML = `Télécharger la vidéo ${platform === 'youtube' ? 'YouTube' : 'TikTok'}`;
            });
        }
    }

    updateButtonText();

    window.addEventListener('resize', updateButtonText);
});
</script>
