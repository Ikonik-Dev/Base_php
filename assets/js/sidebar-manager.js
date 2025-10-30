// Gestion de la sidebar
export class SidebarManager {
    constructor() {
        this.sidebar = document.getElementById("sidebar");
        this.toggle = document.querySelector(".sidebar-toggle");
        console.log("SidebarManager - Sidebar:", this.sidebar);
        console.log("SidebarManager - Toggle:", this.toggle);
        this.init();
    }

    init() {
        if (!this.sidebar) {
            console.error("SidebarManager - Element sidebar non trouvé!");
            return;
        }
        if (!this.toggle) {
            console.error("SidebarManager - Bouton toggle non trouvé!");
            return;
        }

        console.log("SidebarManager - Initialisation réussie");

        // Restaurer l'état au chargement
        this.restoreState();

        // Événements
        this.setupEventListeners();
    }

    toggleSidebar() {
        console.log("SidebarManager - Toggle sidebar appelé");
        this.sidebar.classList.toggle("open");
        console.log(
            "SidebarManager - Sidebar open:",
            this.sidebar.classList.contains("open")
        );
        this.saveState();
    }

    saveState() {
        const isOpen = this.sidebar.classList.contains("open");
        localStorage.setItem("sidebarOpen", isOpen);
    }

    restoreState() {
        const sidebarState = localStorage.getItem("sidebarOpen");
        if (sidebarState === "true") {
            this.sidebar.classList.add("open");
        }
    }

    setupEventListeners() {
        // Toggle button
        console.log("SidebarManager - Ajout event listener sur toggle");
        this.toggle.addEventListener("click", (e) => {
            console.log("SidebarManager - Click détecté!");
            e.preventDefault();
            this.toggleSidebar();
        });

        // Fermer en cliquant à l'extérieur
        document.addEventListener("click", (event) => {
            if (
                !this.sidebar.contains(event.target) &&
                !this.toggle.contains(event.target) &&
                this.sidebar.classList.contains("open")
            ) {
                console.log("SidebarManager - Fermeture par click extérieur");
                this.sidebar.classList.remove("open");
                this.saveState();
            }
        });

        // Redimensionnement
        window.addEventListener("resize", () => {
            console.log("Resize détecté, état sidebar maintenu");
        });
    }
}

// Fonction globale pour compatibilité avec base.html.twig
window.toggleSidebar = function () {
    const sidebar = document.getElementById("sidebar");
    if (sidebar) {
        sidebar.classList.toggle("open");
        localStorage.setItem("sidebarOpen", sidebar.classList.contains("open"));
    }
};

// Initialisation automatique
document.addEventListener("DOMContentLoaded", function () {
    new SidebarManager();
});
