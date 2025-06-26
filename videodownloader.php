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
                <div class="error-message"></div>
            </div>
            <div class="previewyoutube">
                <!-- La preview sera insérée ici par JavaScript -->
            </div>
            <button class="btn-download" id="youtube-download-btn">Télécharger la vidéo YouTube</button>
            <div class="mp4-mp3"></div>
        </div>
        <div class="downloader-container hidden" id="tiktok-downloader">
            <div class="input-section">
                <input type="text" class="video-url-input" placeholder="Collez le lien de la vidéo TikTok ici...">
                <div class="error-message"></div>
            </div>
            <div class="previewtiktok">
                <!-- La preview sera insérée ici par JavaScript -->
            </div>
            <button class="btn-download" id="tiktok-download-btn">Télécharger la vidéo TikTok</button>
            <div class="mp4-mp3"></div>
        </div>
        <div class="downloader-container" id="container1">
            <h2>Sélectionnez une plateforme.</h2>
        </div>
    </div>

<?php require 'Footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const youtubeBtn = document.querySelector('.youtube-btn');
        const tiktokBtn = document.querySelector('.tiktok-btn');
        const youtubeDownloader = document.getElementById('youtube-downloader');
        const tiktokDownloader = document.getElementById('tiktok-downloader');
        const previewYoutube = document.querySelector('.previewyoutube');
        const previewTikTok = document.querySelector('.previewtiktok');
        const container1 = document.getElementById('container1');
        var titreVideo = '';

        // Fonction pour valider une URL YouTube
        function isValidYouTubeUrl(url) {
            const pattern = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+/;
            return pattern.test(url);
        }
        // Fonction pour valider une URL TikTok
        function isValidTikTokUrl(url) {
            const pattern = /^(https?:\/\/)?(www\.)?(tiktok\.com)\/.+/;
            return pattern.test(url);
        }
        // Fonction pour afficher une erreur
        function showError(inputElement, message) {
            const errorElement = inputElement.parentElement.querySelector('.error-message');
            inputElement.classList.add('error');
            errorElement.textContent = message;
            errorElement.classList.add('show');
            // Retirer l'erreur après l'animation
            setTimeout(() => {
                inputElement.classList.remove('error');
            }, 300);
        }
        // Fonction pour cacher l'erreur
        function hideError(inputElement) {
            const errorElement = inputElement.parentElement.querySelector('.error-message');
            inputElement.classList.remove('error');
            errorElement.textContent = '';
            errorElement.classList.remove('show');
        }
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
            // Réinitialiser les champs et erreurs lors du changement de plateforme
            const inputs = document.querySelectorAll('.video-url-input');
            inputs.forEach(input => {
                hideError(input);
                input.disabled = false;
                input.value = '';
            });
            // Réinitialiser les aperçus lors du changement de plateforme
            const previews = document.querySelectorAll('.previewyoutube, .previewtiktok');
            previews.forEach(preview => {
                preview.innerHTML = '';
                preview.style.display = 'none';
            });
            // Réinitialiser les boutons de téléchargement (mp4-mp3)
            const downloadButtons = document.querySelectorAll('.mp4-mp3');
            downloadButtons.forEach(button => {
                button.innerHTML = '';
                button.style.display = 'none';
            });
            // Réinitialiser les boutons de téléchargement (btn-download)
            const downloadButtonsAll = document.querySelectorAll('.btn-download');
            downloadButtonsAll.forEach(button => {
                button.style.display = 'block';
            });
        }
        youtubeBtn.addEventListener('click', () => activatePlatform('youtube'));
        tiktokBtn.addEventListener('click', () => activatePlatform('tiktok'));
        youtubeDownloader.classList.add('hidden');
        tiktokDownloader.classList.add('hidden');
        // Gestion de la validation lors de la saisie
        document.querySelectorAll('.video-url-input').forEach(input => {
            input.addEventListener('input', function() {
                hideError(this);
            });
            input.addEventListener('blur', function() {
                const platform = this.closest('.downloader-container').id.includes('youtube') ? 'youtube' : 'tiktok';
                const url = this.value.trim();
                if (url && !validateUrl(url, platform)) {
                    const errorMessage = platform === 'youtube'
                        ? 'Veuillez entrer une URL YouTube valide'
                        : 'Veuillez entrer une URL TikTok valide';
                    showError(this, errorMessage);
                }
            });
        });
        function validateUrl(url, platform) {
            if (platform === 'youtube') {
                return isValidYouTubeUrl(url);
            } else {
                return isValidTikTokUrl(url);
            }
        }
        document.querySelectorAll('.btn-download').forEach(button => {
            button.addEventListener('click', async function() {
                const container = this.closest('.downloader-container');
                const input = container.querySelector('.video-url-input');
                const url = input?.value.trim();
                if (!url) {
                    showError(input, 'Veuillez entrer une URL');
                    return;
                }
                const platform = container.id.includes('youtube') ? 'youtube' : 'tiktok';
                if (!validateUrl(url, platform)) {
                    const errorMessage = platform === 'youtube'
                        ? 'Veuillez entrer une URL YouTube valide'
                        : 'Veuillez entrer une URL TikTok valide';
                    showError(input, errorMessage);
                    return;
                }
                const preview = container.querySelector('.previewyoutube, .previewtiktok');
                preview.innerHTML = '<p>Chargement...</p>';
                preview.style.display = 'block';
                button.style.display = 'none';
                input.disabled = true;
                try {
                    const response = await fetch('scrapevideo', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `url=${encodeURIComponent(url)}&platform=${platform}`
                    });
                    const data = await response.json();
                    if (data.error) {
                        preview.innerHTML = `<p style="color: red;">Erreur: ${data.error}</p>`;
                        if (data.output) {
                            preview.innerHTML += `<pre style="color: grey; font-size: small;">${data.output}</pre>`;
                        }

                        const container = document.querySelector('.downloader-container:not(.hidden)');
                        const retryButtonsContainer = container.querySelector('.mp4-mp3');

                        // Masquer les boutons MP4 et MP3 et afficher le bouton de téléchargement en cours
                        retryButtonsContainer.innerHTML = `
                            <button class="mp4-btn">Réessayer plus tard</button>
                        `;
                        retryButtonsContainer.style.display = 'block';

                        const retryButton = retryButtonsContainer.querySelector('.mp4-btn');

                        retryButton.addEventListener('click', function() {
                            // Réinitialiser le formulaire pour télécharger une autre vidéo
                            activatePlatform(platform);
                        });

                        return;
                    }

                    titreVideo = data.title || 'Vidéo';

                    // Affiche la preview de la vidéo
                    preview.innerHTML = `
                        <div class="video-preview">
                            <img src="${data.thumbnail}" alt="Miniature de la vidéo">
                            <h3>${titreVideo}</h3>
                        </div>
                    `;
                    // Sélectionne le bon div pour les boutons dans le bon conteneur
                    const downloadButtonsContainer = container.querySelector('.mp4-mp3');
                    downloadButtonsContainer.innerHTML = `
                        <button class="mp4-btn" data-url="${url}" data-platform="${platform}">Télécharger en MP4</button>
                        <button class="mp3-btn" data-url="${url}" data-platform="${platform}">Télécharger en MP3</button>
                    `;
                    downloadButtonsContainer.style.display = 'flex';
                    // Ajoute les écouteurs d'événements aux nouveaux boutons
                    downloadButtonsContainer.querySelector('.mp4-btn').addEventListener('click', function() {
                        downloadVideo(url, platform, 'mp4');
                    });
                    downloadButtonsContainer.querySelector('.mp3-btn').addEventListener('click', function() {
                        downloadVideo(url, platform, 'mp3');
                    });
                } catch (error) {
                    preview.innerHTML = `<p style="color: red;">Une erreur est survenue: ${error.message}</p>`;
                }
            });
        });
        // Fonction pour gérer le téléchargement
        async function downloadVideo(url, platform, format) {
            const container = document.querySelector('.downloader-container:not(.hidden)');
            const downloadButtonsContainer = container.querySelector('.mp4-mp3');

            // Masquer les boutons MP4 et MP3 et afficher le bouton de téléchargement en cours
            downloadButtonsContainer.innerHTML = `
                <button class="mp3-btn" disabled><i class="fas fa-spinner fa-spin"></i> Téléchargement en cours…</button>
            `;
            downloadButtonsContainer.style.display = 'inline-block';

            try {
                // Envoyer une requête AJAX pour initier le téléchargement
                const response = await fetch(`download?url=${encodeURIComponent(url)}&platform=${platform}&format=${format}`);

                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(errorText || 'Erreur lors du téléchargement');
                }

                // Si le téléchargement est réussi, modifier le bouton
                const downloadButton = downloadButtonsContainer.querySelector('.mp3-btn');

                downloadButton.textContent = `Télécharger une autre vidéo ${platform === 'youtube' ? 'YouTube' : 'TikTok'}`;
                downloadButton.disabled = false;
                downloadButton.addEventListener('click', function() {
                    // Réinitialiser le formulaire pour télécharger une autre vidéo
                    activatePlatform(platform);
                });

                // Télécharger le fichier
                const blob = await response.blob();
                const downloadUrl = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = downloadUrl;
                a.download = `${titreVideo}.${format}`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(downloadUrl);

            } catch (error) {
                console.error("Erreur lors du téléchargement:", error);
                // Réafficher les boutons MP4 et MP3 en cas d'erreur
                downloadButtonsContainer.innerHTML = `
                    <button class="mp4-btn" data-url="${url}" data-platform="${platform}">Télécharger en MP4</button>
                    <button class="mp3-btn" data-url="${url}" data-platform="${platform}">Télécharger en MP3</button>
                `;
                downloadButtonsContainer.querySelector('.mp4-btn').addEventListener('click', function() {
                    downloadVideo(url, platform, 'mp4');
                });
                downloadButtonsContainer.querySelector('.mp3-btn').addEventListener('click', function() {
                    downloadVideo(url, platform, 'mp3');
                });
            }
        }
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