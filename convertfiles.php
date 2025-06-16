<?php require 'Header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                    <div class="option-group">
                        <label for="image-input" class="upload-area">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Glissez-déposez ou cliquez pour téléverser votre image</span>
                            <input type="file" id="image-input" accept="image/*" hidden>
                            <div class="preview"></div>
                        </label>
                        <div class="conversion-format">
                            <span>Convertir en:</span>
                            <div class="select-wrapper">
                                <select id="image-format">
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
                    <button class="convert-button">Convertir</button>
                </div>

                <div class="conversion-options" id="video-options">
                    <h3>Convertir une vidéo</h3>
                    <p>Sélectionnez le format de sortie pour votre vidéo.</p>
                    <div class="option-group">
                        <label for="video-input" class="upload-area">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Glissez-déposez ou cliquez pour téléverser votre vidéo</span>
                            <input type="file" id="video-input" accept="video/*" hidden>
                            <div class="preview"></div>
                        </label>
                        <div class="conversion-format">
                            <span>Convertir en:</span>
                            <div class="select-wrapper">
                                <select id="video-format">
                                    <option value="mp4">MP4</option>
                                    <option value="avi">AVI</option>
                                    <option value="mov">MOV</option>
                                    <option value="webm">WEBM</option>
                                    <option value="mkv">MKV</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="convert-button">Convertir</button>
                </div>

                <div class="conversion-options" id="audio-options">
                    <h3>Convertir un fichier audio</h3>
                    <p>Sélectionnez le format de sortie pour votre fichier audio.</p>
                    <div class="option-group">
                        <label for="audio-input" class="upload-area">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Glissez-déposez ou cliquez pour téléverser votre audio</span>
                            <input type="file" id="audio-input" accept="audio/*" hidden>
                            <div class="preview"></div>
                        </label>
                        <div class="conversion-format">
                            <span>Convertir en:</span>
                            <div class="select-wrapper">
                                <select id="audio-format">
                                    <option value="mp3">MP3</option>
                                    <option value="wav">WAV</option>
                                    <option value="flac">FLAC</option>
                                    <option value="ogg">OGG</option>
                                    <option value="aac">AAC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="convert-button">Convertir</button>
                </div>

                <div class="conversion-options" id="pdf-options">
                    <h3>Convertir un fichier PDF</h3>
                    <p>Sélectionnez le format de sortie pour votre PDF.</p>
                    <div class="option-group">
                        <label for="pdf-input" class="upload-area">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Glissez-déposez ou cliquez pour téléverser votre PDF</span>
                            <input type="file" id="pdf-input" accept=".pdf" hidden>
                            <div class="preview"></div>
                        </label>
                        <div class="conversion-format">
                            <span>Convertir en:</span>
                            <div class="select-wrapper">
                                <select id="pdf-format">
                                    <option value="docx">DOCX</option>
                                    <option value="jpg">JPG</option>
                                    <option value="png">PNG</option>
                                    <option value="txt">TXT</option>
                                    <option value="html">HTML</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="convert-button">Convertir</button>
                </div>

                <div class="conversion-options" id="document-options">
                    <h3>Convertir un document</h3>
                    <p>Sélectionnez le format de sortie pour votre document.</p>
                    <div class="option-group">
                        <label for="document-input" class="upload-area">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Glissez-déposez ou cliquez pour téléverser votre document</span>
                            <input type="file" id="document-input" accept=".doc,.docx,.txt,.odt,.rtf" hidden>
                            <div class="preview"></div>
                        </label>
                        <div class="conversion-format">
                            <span>Convertir en:</span>
                            <div class="select-wrapper">
                                <select id="document-format">
                                    <option value="pdf">PDF</option>
                                    <option value="txt">TXT</option>
                                    <option value="html">HTML</option>
                                    <option value="odt">ODT</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="convert-button">Convertir</button>
                </div>

                <div class="conversion-options" id="archive-options">
                    <h3>Convertir une archive</h3>
                    <p>Sélectionnez le format de sortie pour votre archive.</p>
                    <div class="option-group">
                        <label for="archive-input" class="upload-area">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Glissez-déposez ou cliquez pour téléverser votre archive</span>
                            <input type="file" id="archive-input" accept=".zip,.rar,.7z,.tar" hidden>
                            <div class="preview"></div>
                        </label>
                        <div class="conversion-format">
                            <span>Convertir en:</span>
                            <div class="select-wrapper">
                                <select id="archive-format">
                                    <option value="zip">ZIP</option>
                                    <option value="rar">RAR</option>
                                    <option value="7z">7Z</option>
                                    <option value="tar">TAR</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="convert-button">Convertir</button>
                </div>
            </div>
        </section>
    </div>


<script>
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
            'x-zip-compressed': 'zip',
            'x-compressed': 'rar',
            'x-tar': 'tar'
        };


        dropZones.forEach(zone => {
            const input = zone.querySelector('input[type="file"]');
            const allowed = validExtensions[input.id];
            const preview = zone.querySelector('.preview');
            const icon = zone.querySelector('i');
            const span = zone.querySelector('span');

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

                console.log(`Extension détectée : ${ext}`);

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

                const inputId = input.id;
                const fileExt = file.name.split('.').pop().toLowerCase();

                preview.innerHTML = '';
                span.style.display = 'none';
                icon.style.display = 'none';

                if (!allowed.includes(fileExt)) {
                    preview.innerHTML = `<p style="color: red;">Extension invalide : ${file.name}</p>`;
                    input.value = ''; // Reset le champ fichier
                    span.style.display = '';
                    icon.style.display = '';
                    return;
                }

                // Afficher l'aperçu selon le type
                const fileURL = URL.createObjectURL(file);
                let element;

                if (file.type.startsWith('image/')) {
                    element = document.createElement('img');
                    element.src = fileURL;
                    element.style.maxWidth = '100%';
                    element.style.maxHeight = '200px';
                } else if (file.type.startsWith('video/')) {
                    element = document.createElement('video');
                    element.src = fileURL;
                    element.controls = true;
                    element.style.maxWidth = '100%';
                    element.style.maxHeight = '200px';
                } else if (file.type.startsWith('audio/')) {
                    element = document.createElement('audio');
                    element.src = fileURL;
                    element.controls = true;
                } else if (file.type === 'application/pdf') {
                    element = document.createElement('embed');
                    element.src = fileURL;
                    element.type = 'application/pdf';
                    element.style.width = '100%';
                    element.style.height = '200px';
                } else {
                    element = document.createElement('p');
                    element.textContent = `Fichier : ${file.name}`;
                }

                preview.appendChild(element);
                input.files = e.dataTransfer.files; // Charger le fichier dans l'input
            });
        });
    });
</script>

<?php require 'Footer.php'; ?>
