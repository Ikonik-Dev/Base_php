// Gestion de la navbar flottante
export class NavbarManager {
    constructor() {
        this.navbar = document.querySelector(".navbar");
        this.navbarTrigger = document.getElementById("navbarTrigger");
        this.isVisible = false;
        this.timeout = null;
        this.height = 0;
        this.init();
    }

    init() {
        if (!this.navbar) {
            console.error("Navbar non trouvée !");
            return;
        }

        console.log("Navbar trouvée, initialisation...");

        // Calculer la hauteur avec délais
        setTimeout(() => this.calculateHeight(), 100);
        setTimeout(() => this.calculateHeight(), 500);

        this.setupEventListeners();
        this.showInitialDemo();
    }

    calculateHeight() {
        console.log("Tentative de calcul de hauteur navbar...");

        // Temporairement forcer l'affichage pour mesurer
        this.navbar.classList.add("visible");
        this.navbar.style.visibility = "hidden";

        this.height = this.navbar.offsetHeight;
        console.log("Hauteur navbar calculée:", this.height + "px");

        // Remettre en état caché
        this.navbar.classList.remove("visible");
        this.navbar.style.visibility = "visible";
    }

    show() {
        if (!this.isVisible) {
            this.navbar.classList.add("visible");
            this.isVisible = true;
            clearTimeout(this.timeout);
            console.log("Navbar affichée");
        }
    }

    hide() {
        this.timeout = setTimeout(() => {
            this.navbar.classList.remove("visible");
            this.isVisible = false;
            console.log("Navbar cachée");
        }, 300);
    }

    setupEventListeners() {
        // Détection de la souris en haut de l'écran
        document.addEventListener("mousemove", (e) => {
            const triggerZone = Math.max(
                50,
                this.height > 0 ? this.height * 0.5 : 50
            );

            if (e.clientY <= triggerZone) {
                this.show();
            } else if (e.clientY > this.height + 20 && this.isVisible) {
                const navbarRect = this.navbar.getBoundingClientRect();
                if (e.clientY > navbarRect.bottom + 10) {
                    this.hide();
                }
            }
        });

        // Garder la navbar visible au survol
        this.navbar.addEventListener("mouseenter", () => {
            this.show();
        });

        this.navbar.addEventListener("mouseleave", (event) => {
            setTimeout(() => {
                if (event.clientY > this.height + 20) {
                    this.hide();
                }
            }, 100);
        });

        // Recalculer la hauteur au redimensionnement
        window.addEventListener("resize", () => {
            setTimeout(() => this.calculateHeight(), 100);
        });
    }

    showInitialDemo() {
        setTimeout(() => {
            console.log("Test initial navbar...");
            this.show();
            setTimeout(() => {
                console.log("Masquage automatique navbar...");
                this.hide();
            }, 3000);
        }, 500);
    }
}

// Initialisation automatique
document.addEventListener("DOMContentLoaded", function () {
    new NavbarManager();
});
