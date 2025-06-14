<main>
    <div class="accueil">
        <div class="title">
            <h1>Titre lorem lorem</h1>
        </div>
        <div class="content">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum aperiam consequatur aliquid explicabo dolores provi</p>
        </div>
        <img src="./img/imgaccueil.png" alt="" class="imgaccueil">
    </div>
    <div class="accueilbg"></div>

    <script>
        gsap.from(".accueilbg", {
            duration: 1.5, // Durée de l'animation en secondes
            scaleY: 0, // Commence avec une échelle verticale de 0
            transformOrigin: "bottom", // L'animation part du bas
            ease: "power3.out" // Type d'accélération
        });

        gsap.from(".title h1", {
            duration: 1,
            y: -50, // Déplace le titre de 50px vers le haut
            opacity: 0, // Commence avec une opacité de 0
            ease: "power2.out",
            delay: 0.5 // Délai avant le début de l'animation
        });

        gsap.from(".content p", {
            duration: 1,
            y: 50, // Déplace le paragraphe de 50px vers le bas
            opacity: 0,
            ease: "power2.out",
            delay: 0.8 // Délai après l'animation du titre
        });

        gsap.from(".imgaccueil", {
            duration: 1.2,
            x: 100, // Déplace l'image de 100px vers la droite
            opacity: 0,
            ease: "power2.out",
            delay: 1 // Délai après l'animation du contenu
        });
    </script>
