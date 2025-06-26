<?php
$pageTitle = 'Convert Files';
$pageDescription = 'Convert various file types including images, videos, audio, PDFs, documents, and archives. Easily upload and convert files to your desired format.';
require 'Header.php'; ?>
<link rel="stylesheet" href="styles/convertfiles.css">

<main>
    <div class="titlePage convertimg">
        <img src="./img/convertfile/imgtriangle.png" alt="Image de la page" class="triangleimg">
        <img src="./img/convertfile/circleflower.png" alt="Image de la page" class="circletriangleimg">
        <img src="./img/convertfile/flower.png" alt="Image de la page" class="flowerimg">
        <img src="./img/convertfile/imgtriangleinverse.png" alt="Image de la page" class="imgtriangleinverse">

        <h1>Convertir un fichier.</h1>

    </div>
 <div class="contentPage">
        <section class="conversion-section">
            <div class="conversion-type-selection">
                <h2>Choisissez le type de fichier à convertir :</h2>
                <div class="type-buttons">
                    <button class="type-button active" data-type="image">
                        <i class="fas fa-image"></i>
                        <span>Image</span>
                    </button>
                    <button class="type-button" data-type="video">
                        <i class="fas fa-video"></i>
                        <span>Vidéo</span>
                    </button>
                    <button class="type-button" data-type="audio">
                        <i class="fas fa-music"></i>
                        <span>Audio</span>
                    </button>
                    <button class="type-button" data-type="pdf">
                        <i class="fas fa-file-pdf"></i>
                        <span>PDF</span>
                    </button>
                    <button class="type-button" data-type="document">
                        <i class="fas fa-file-alt"></i>
                        <span>Document</span>
                    </button>
                    <button class="type-button" data-type="archive">
                        <i class="fas fa-file-archive"></i>
                        <span>Archive</span>
                    </button>
                </div>
            </div>

            <div class="conversion-options-container">
                <div class="conversion-options active" id="image-options">
                    <h3>Convertir une image</h3>
                    <p>Sélectionnez le format de sortie pour votre image.</p>
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="type" value="image">
                        <div class="option-group">
                            <label for="image-input" class="upload-area">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Glissez-déposez ou cliquez pour téléverser votre image</span>
                                <input type="file" id="image-input" name="file" accept="image/*" hidden>
                                <div class="preview"></div>
                            </label>
                            <div class="conversion-format">
                                <span>Convertir en:</span>
                                <div class="select-wrapper">
                                    <select id="image-format" name="format">
                                        <option value="jpg">JPG</option>
                                        <option value="png">PNG</option>
                                        <option value="webp">WEBP</option>
                                        <option value="avif">AVIF</option>
                                        <option value="gif">GIF</option>
                                        <option value="tiff">TIFF</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="convert-button">Convertir</button>
                    </form>
                </div>

                <div class="conversion-options" id="video-options">
                    <h3>Convertir une vidéo</h3>
                    <p>Sélectionnez le format de sortie pour votre vidéo.</p>
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="type" value="video">
                        <div class="option-group">
                            <label for="video-input" class="upload-area">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Glissez-déposez ou cliquez pour téléverser votre vidéo</span>
                                <input type="file" id="video-input" name="file" accept="video/*" hidden>
                                <div class="preview"></div>
                            </label>
                            <div class="conversion-format">
                                <span>Convertir en:</span>
                                <div class="select-wrapper">
                                    <select id="video-format" name="format">
                                        <option value="mp4">MP4</option>
                                        <option value="avi">AVI</option>
                                        <option value="mov">MOV</option>
                                        <option value="webm">WEBM</option>
                                        <option value="mkv">MKV</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="convert-button">Convertir</button>
                    </form>
                </div>

                <div class="conversion-options" id="audio-options">
                    <h3>Convertir un fichier audio</h3>
                    <p>Sélectionnez le format de sortie pour votre fichier audio.</p>
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="type" value="audio">
                        <div class="option-group">
                            <label for="audio-input" class="upload-area">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Glissez-déposez ou cliquez pour téléverser votre audio</span>
                                <input type="file" id="audio-input" name="file" accept="audio/*" hidden>
                                <div class="preview"></div>
                            </label>
                            <div class="conversion-format">
                                <span>Convertir en:</span>
                                <div class="select-wrapper">
                                    <select id="audio-format" name="format">
                                        <option value="mp3">MP3</option>
                                        <option value="wav">WAV</option>
                                        <option value="flac">FLAC</option>
                                        <option value="ogg">OGG</option>
                                        <option value="aac">AAC</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="convert-button">Convertir</button>
                    </form>
                </div>

                <div class="conversion-options" id="pdf-options">
                    <h3>Convertir un fichier PDF</h3>
                    <p>Sélectionnez le format de sortie pour votre PDF.</p>
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="type" value="pdf">
                        <div class="option-group">
                            <label for="pdf-input" class="upload-area">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Glissez-déposez ou cliquez pour téléverser votre PDF</span>
                                <input type="file" id="pdf-input" name="file" accept=".pdf" hidden>
                                <div class="preview"></div>
                            </label>
                            <div class="conversion-format">
                                <span>Convertir en:</span>
                                <div class="select-wrapper">
                                    <select id="pdf-format" name="format">
                                        <option value="docx">DOCX</option>
                                        <option value="jpg">JPG</option>
                                        <option value="png">PNG</option>
                                        <option value="txt">TXT</option>
                                        <option value="html">HTML</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="convert-button">Convertir</button>
                    </form>
                </div>

                <div class="conversion-options" id="document-options">
                    <h3>Convertir un document</h3>
                    <p>Sélectionnez le format de sortie pour votre document.</p>
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="type" value="document">
                        <div class="option-group">
                            <label for="document-input" class="upload-area">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Glissez-déposez ou cliquez pour téléverser votre document</span>
                                <input type="file" id="document-input" name="file" accept=".doc,.docx,.txt,.odt,.rtf" hidden>
                                <div class="preview"></div>
                            </label>
                            <div class="conversion-format">
                                <span>Convertir en:</span>
                                <div class="select-wrapper">
                                    <select id="document-format" name="format">
                                        <option value="pdf">PDF</option>
                                        <option value="txt">TXT</option>
                                        <option value="html">HTML</option>
                                        <option value="odt">ODT</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="convert-button">Convertir</button>
                    </form>
                </div>

                <div class="conversion-options" id="archive-options">
                    <h3>Convertir une archive</h3>
                    <p>Sélectionnez le format de sortie pour votre archive.</p>
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="type" value="archive">
                        <div class="option-group">
                            <label for="archive-input" class="upload-area">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Glissez-déposez ou cliquez pour téléverser votre archive</span>
                                <input type="file" id="archive-input" name="file" accept=".zip,.rar,.7z,.tar" hidden>
                                <div class="preview"></div>
                            </label>
                            <div class="conversion-format">
                                <span>Convertir en:</span>
                                <div class="select-wrapper">
                                    <select id="archive-format" name="format">
                                        <option value="zip">ZIP</option>
                                        <option value="7z">7Z</option>
                                        <option value="tar">TAR</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="convert-button">Convertir</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

<script>
    function createPreview(file, url) {
        let el;
        const type = file.type;

        if (type.startsWith('image/')) {
            el = document.createElement('img');
            el.src = url;
            el.style.maxWidth = '100%';
            el.style.maxHeight = '200px';
        } else if (type.startsWith('video/')) {
            el = document.createElement('video');
            el.src = url;
            el.controls = true;
            el.style.maxWidth = '100%';
            el.style.maxHeight = '200px';
        } else if (type.startsWith('audio/')) {
            el = document.createElement('audio');
            el.src = url;
            el.controls = true;
        } else if (type === 'application/pdf') {
            el = document.createElement('embed');
            el.src = url;
            el.type = 'application/pdf';
            el.style.width = '100%';
            el.style.height = '200px';
        } else {
            el = document.createElement('p');
            el.textContent = `Fichier : ${file.name}`;
        }

        return el;
    }


    document.addEventListener('DOMContentLoaded', function() {
        const typeButtons = document.querySelectorAll('.type-button');
        const conversionOptions = document.querySelectorAll('.conversion-options');

        typeButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Supprimer la classe 'active' de tous les boutons
                typeButtons.forEach(btn => btn.classList.remove('active'));
                // Ajouter la classe 'active' au bouton cliqué
                this.classList.add('active');

                // Masquer toutes les sections d'options de conversion
                conversionOptions.forEach(option => option.classList.remove('active'));

                // Afficher la section d'options correspondante
                const dataType = this.dataset.type; // Récupère la valeur de l'attribut data-type (ex: 'image')
                const targetId = `${dataType}-options`; // Construit l'ID cible (ex: 'image-options')
                const targetSection = document.getElementById(targetId);

                if (targetSection) {
                    targetSection.classList.add('active');
                }
            });
        });

        document.querySelectorAll('.convert-button').forEach(button => {
            button.addEventListener('click', async function (event) {
                event.preventDefault();

                const section = button.closest('.conversion-options');
                const input = section.querySelector('input[type="file"]');
                const select = section.querySelector('select');
                const type = section.id.replace('-options', '');
                const file = input.files[0];

                if (!file) return alert("Veuillez sélectionner un fichier.");

                const formData = new FormData();
                formData.append('file', file);
                formData.append('type', type);
                formData.append('format', select.value);

                // Sauvegarder l'état d'origine
                const originalText = button.innerHTML;
                button.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Conversion...`;

                // Sélectionner tous les boutons et les liens
                const allButtons = document.querySelectorAll('button, .convert-button');
                const allLinks = document.querySelectorAll('a');

                // Désactiver les boutons
                allButtons.forEach(btn => btn.disabled = true);

                // Désactiver les liens en les bloquant temporairement
                allLinks.forEach(link => {
                    link.setAttribute('data-href', link.getAttribute('href'));
                    link.setAttribute('href', '#');
                    link.classList.add('disabled-link'); // pour éventuel style CSS
                });

                const controller = new AbortController();
                const timeout = setTimeout(() => controller.abort(), 45000); // 45s timeout

                try {
                    const res = await fetch('convert', {
                        method: 'POST',
                        body: formData,
                        signal: controller.signal
                    });

                    clearTimeout(timeout);

                    if (!res.ok) {
                        const errorText = await res.text();
                        if (res.status === 413) {
                            alert("Le fichier est trop volumineux. Veuillez essayer avec un fichier plus petit.\nErreur : " + errorText);
                            return;
                        }
                        else if (res.status === 500) {
                            alert("Erreur interne du serveur. Veuillez réessayer plus tard.\nErreur : " + errorText);
                            return;
                        }
                        else {
                            alert("Erreur lors de la conversion.\nCode HTTP : " + res.status + " - " + errorText);
                            return;
                        }
                    }

                    const blob = await res.blob();
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `${file.name.split('.')[0]}.${select.value}`;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);
                } catch (err) {
                    alert("Erreur réseau : " + err.message);
                } finally {
                    // Restaurer tous les éléments
                    button.innerHTML = originalText;
                    allButtons.forEach(btn => btn.disabled = false);

                    allLinks.forEach(link => {
                        const originalHref = link.getAttribute('data-href');
                        if (originalHref) {
                            link.setAttribute('href', originalHref);
                            link.removeAttribute('data-href');
                        }
                        link.classList.remove('disabled-link');
                    });
                }
            });
        });



        // Optionnel: Afficher la section "Image" par défaut au chargement de la page
        // Trouvez le bouton "Image" et simulez un clic
        const defaultButton = document.querySelector('.type-button[data-type="image"]');
        if (defaultButton) {
            defaultButton.click();
        }

        const dropZones = document.querySelectorAll('.upload-area');

        // Extensions valides par type de champ
        const validExtensions = {
            'image-input': ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif', 'tiff'],
            'video-input': ['mp4', 'avi', 'mov', 'webm', 'mkv'],
            'audio-input': ['mp3', 'wav', 'flac', 'ogg', 'aac'],
            'pdf-input': ['pdf'],
            'document-input': ['doc', 'docx', 'txt', 'odt', 'rtf'],
            'archive-input': ['zip', 'rar', '7z', 'tar']
        };

        // juste sous validExtensions
        const extMap = {
            'mpeg': 'mp3',
            'plain': 'txt',
            'vnd.openxmlformats-officedocument.wordprocessingml.document': 'docx',
            'vnd.openxmlformats-officedocument.presentationml.presentation': 'pptx',
            'vnd.openxmlformats-officedocument.spreadsheetml.sheet': 'xlsx',
            'vnd.ms-excel': 'xls',
            'vnd.ms-powerpoint': 'ppt',
            'vnd.oasis.opendocument.text': 'odt',
            'vnd.oasis.opendocument.spreadsheet': 'ods',
            'vnd.oasis.opendocument.presentation': 'odp',
            'vnd.oasis.opendocument.graphics': 'odg',
            'vnd.oasis.opendocument.formula': 'odf',
            'vnd.oasis.opendocument.chart': 'odc',
            'vnd.oasis.opendocument.image': 'odi',
            'vnd.oasis.opendocument.text-master': 'odm',
            'vnd.oasis.opendocument.text-web': 'odt',
            'vnd.oasis.opendocument.text-template': 'odt',
            'msword' : 'doc',
            'x-msdownload': 'exe',
            'x-zip-compressed': 'zip',
            'x-tar': 'tar',
            'x-7z-compressed': '7z',
            'x-rar-compressed': 'rar',
            'x-gzip': 'gz',
            'x-bzip2': 'bz2',
            'x-compressed': 'zip',
            'x-archive': 'zip',
        };

        dropZones.forEach(zone => {
            const input = zone.querySelector('input[type="file"]');
            const allowed = validExtensions[input.id];
            const preview = zone.querySelector('.preview');
            const icon = zone.querySelector('i');
            const span = zone.querySelector('span');

            input.addEventListener('change', e => {
                const file = e.target.files[0];
                if (!file) return;

                // Extraction et normalisation de l'extension
                let ext = file.name.split('.').pop().toLowerCase();
                ext = extMap[ext] || ext;

                // Récupération des éléments
                const formatContainer = zone.closest('.option-group').querySelector('.conversion-format');
                const convertSpan    = formatContainer.querySelector('span');
                const select         = formatContainer.querySelector('select');

                // 1) Mise à jour du <span>
                convertSpan.textContent = `Convertir (${ext}) en :`;

                // 2) Réactivation de toutes les options, puis masquage de celle de l'extension source
                Array.from(select.options).forEach(opt => opt.hidden = false);
                const toHide = Array.from(select.options).find(opt => opt.value.toLowerCase() === ext);
                if (toHide) toHide.hidden = true;

                // 3) Choix de la première option visible
                const firstVisibleIndex = Array.from(select.options).findIndex(opt => !opt.hidden);

                if (firstVisibleIndex >= 0) {
                    select.selectedIndex = firstVisibleIndex;
                }

                // 4) Réinitialisation de l'aperçu et de l'UI du drop-zone
                preview.innerHTML    = '';
                span.style.display   = 'none';
                icon.style.display   = 'none';

                if (!allowed.includes(ext)) {
                    preview.innerHTML = `<p style="color: red;">Extension invalide : ${file.name}</p>`;
                    input.value = '';           // reset pour pouvoir re-sélectionner
                    span.style.display = 'none';
                    icon.style.display = 'none';
                    return;
                }

                const url = URL.createObjectURL(file);
                preview.appendChild(createPreview(file, url));

                input.files = e.target.files;
            });

            // Drag over
            zone.addEventListener('dragover', e => {
                e.preventDefault();
                zone.classList.add('dragover');

                const items = e.dataTransfer.items;
                if (!items.length) {
                    zone.classList.add('invalid-drag');
                    return;
                }

                // essaie de récupérer le nom
                let ext = null;
                const fileItem = items[0].getAsFile();
                if (fileItem) {
                    ext = fileItem.name.split('.').pop().toLowerCase();
                } else {
                    // fallback : on utilise le MIME type (ex: 'image/png')
                    const mime = items[0].type;
                    ext = mime.split('/').pop().toLowerCase();
                }

                ext = extMap[ext] || ext;

                if (allowed.includes(ext)) {
                    zone.classList.remove('invalid-drag');

                } else {
                    zone.classList.add('invalid-drag');
                }
            });

            // Drag leave
            zone.addEventListener('dragleave', () => {
                zone.classList.remove('dragover');
                zone.classList.remove('invalid-drag');
            });

            // Drop
            zone.addEventListener('drop', e => {
                e.preventDefault();
                zone.classList.remove('dragover');
                zone.classList.remove('invalid-drag');

                const file = e.dataTransfer.files[0];
                if (!file) return;

                // Extension
                const fileExt = file.name.split('.').pop().toLowerCase();

                const optionGroup     = zone.closest('.option-group');
                const formatContainer = optionGroup.querySelector('.conversion-format');
                const convertSpan     = formatContainer.querySelector('span');
                const select          = formatContainer.querySelector('select');

                convertSpan.textContent = `Convertir (${fileExt}) en :`;

                Array.from(select.options).forEach(opt => opt.hidden = false);

                const toHide = Array.from(select.options).find(opt => opt.value.toLowerCase() === fileExt);
                if (toHide) toHide.hidden = true;

                const firstVisibleIndex = Array.from(select.options).findIndex(opt => !opt.hidden);
                if (firstVisibleIndex >= 0) {
                    select.selectedIndex = firstVisibleIndex;
                }

                preview.innerHTML = '';
                span.style.display = 'none';
                icon.style.display = 'none';

                if (!allowed.includes(fileExt)) {
                    preview.innerHTML = `<p style="color: red;">Extension invalide : ${file.name}</p>`;
                    input.value = '';
                    span.style.display = '';
                    icon.style.display = '';
                    return;
                }

                const fileURL = URL.createObjectURL(file);
                preview.appendChild(createPreview(file, fileURL));

                input.files = e.dataTransfer.files;
            });

        });
    });
</script>

<?php require 'Footer.php'; ?>