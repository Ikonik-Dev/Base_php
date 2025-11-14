/**
 * ModalManager - Gestionnaire de modales pour les concepts PHP
 * Gère l'ouverture, la fermeture et les interactions avec les modales
 */

export class ModalManager {
    constructor() {
        this.activeModal = null;
        this.modals = new Map();
        this.init();
    }

    init() {
        // Enregistrer toutes les modales
        document.querySelectorAll("[data-modal]").forEach((modal) => {
            const id = modal.dataset.modal;
            this.modals.set(id, modal);
        });

        // Event listeners
        this.setupEventListeners();

        // Gestion du clavier
        document.addEventListener("keydown", (e) => this.handleKeyboard(e));

        console.log(
            `✅ ModalManager initialisé avec ${this.modals.size} modale(s)`
        );
    }

    setupEventListeners() {
        // Boutons d'ouverture de modal (sur les cards)
        document.addEventListener("click", (e) => {
            const trigger = e.target.closest("[data-open-modal]");
            if (trigger) {
                e.preventDefault();
                const modalId = trigger.dataset.openModal;
                this.open(modalId);
            }
        });

        // Boutons de fermeture
        document.addEventListener("click", (e) => {
            if (
                e.target.matches("[data-modal-close]") ||
                e.target.closest("[data-modal-close]")
            ) {
                e.preventDefault();
                this.close();
            }
        });

        // Copie de code
        document.addEventListener("click", (e) => {
            const copyBtn = e.target.closest(".modal__code-copy");
            if (copyBtn) {
                e.preventDefault();
                this.copyCode(copyBtn);
            }
        });
    }

    /**
     * Ouvrir une modale
     */
    open(modalId) {
        const modal = this.modals.get(modalId);

        if (!modal) {
            console.warn(`⚠️ Modale "${modalId}" introuvable`);
            return;
        }

        // Fermer la modale active si existante (sans animation pour éviter conflit)
        if (this.activeModal && this.activeModal !== modal) {
            this.closeImmediate();
        }

        // Ouvrir la nouvelle modale
        modal.setAttribute("aria-hidden", "false");
        modal.style.display = "flex";

        // Bloquer le scroll du body
        document.body.style.overflow = "hidden";

        // Focus sur le premier élément focusable
        setTimeout(() => {
            const firstFocusable = modal.querySelector(
                "button, a, input, textarea, select"
            );
            if (firstFocusable) {
                firstFocusable.focus();
            }
        }, 100);

        this.activeModal = modal;

        // Animation d'entrée
        requestAnimationFrame(() => {
            modal.style.opacity = "1";
        });

        // Event personnalisé
        this.dispatchEvent("modal:opened", { modalId, modal });

        console.log(`✅ Modale "${modalId}" ouverte`);
    }

    /**
     * Fermer la modale active
     */
    close() {
        if (!this.activeModal) return;

        const modalId = this.activeModal.dataset.modal;

        // Retirer le focus AVANT de marquer aria-hidden (accessibilité)
        if (
            document.activeElement &&
            this.activeModal.contains(document.activeElement)
        ) {
            document.activeElement.blur();
        }

        // Animation de sortie
        this.activeModal.style.opacity = "0";

        setTimeout(() => {
            this.activeModal.setAttribute("aria-hidden", "true");
            this.activeModal.style.display = "none";

            // Restaurer le scroll
            document.body.style.overflow = "";

            // Event personnalisé
            this.dispatchEvent("modal:closed", {
                modalId,
                modal: this.activeModal,
            });

            this.activeModal = null;

            console.log(`✅ Modale "${modalId}" fermée`);
        }, 300);
    }

    /**
     * Fermer immédiatement (sans animation) pour changement de modale
     */
    closeImmediate() {
        if (!this.activeModal) return;

        const modalId = this.activeModal.dataset.modal;

        // Retirer le focus immédiatement
        if (
            document.activeElement &&
            this.activeModal.contains(document.activeElement)
        ) {
            document.activeElement.blur();
        }

        // Fermeture immédiate
        this.activeModal.setAttribute("aria-hidden", "true");
        this.activeModal.style.display = "none";
        this.activeModal.style.opacity = "0";

        // Event personnalisé
        this.dispatchEvent("modal:closed", {
            modalId,
            modal: this.activeModal,
        });

        console.log(`✅ Modale "${modalId}" fermée (immédiat)`);

        this.activeModal = null;
    }

    /**
     * Gestion du clavier
     */
    handleKeyboard(e) {
        // Échap pour fermer
        if (e.key === "Escape" && this.activeModal) {
            e.preventDefault();
            this.close();
        }

        // Tab trap dans la modale
        if (e.key === "Tab" && this.activeModal) {
            this.trapFocus(e);
        }
    }

    /**
     * Piéger le focus dans la modale (accessibilité)
     */
    trapFocus(e) {
        const focusableElements = this.activeModal.querySelectorAll(
            'button:not([disabled]), a[href], input:not([disabled]), textarea:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
        );

        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        if (e.shiftKey && document.activeElement === firstElement) {
            e.preventDefault();
            lastElement.focus();
        } else if (!e.shiftKey && document.activeElement === lastElement) {
            e.preventDefault();
            firstElement.focus();
        }
    }

    /**
     * Copier le code d'un bloc
     */
    async copyCode(button) {
        const targetId = button.dataset.copyTarget;
        const codeBlock = document.getElementById(targetId);

        if (!codeBlock) {
            console.warn("⚠️ Bloc de code introuvable");
            return;
        }

        const code = codeBlock.textContent;

        try {
            await navigator.clipboard.writeText(code);

            // Feedback visuel
            button.classList.add("copied");
            const originalText = button.querySelector(
                ".modal__code-copy-text"
            ).textContent;
            button.querySelector(".modal__code-copy-text").textContent =
                "Copié !";

            setTimeout(() => {
                button.classList.remove("copied");
                button.querySelector(".modal__code-copy-text").textContent =
                    originalText;
            }, 2000);

            console.log("✅ Code copié dans le presse-papier");
        } catch (err) {
            console.error("❌ Erreur lors de la copie:", err);

            // Fallback pour anciens navigateurs
            this.copyCodeFallback(code);
        }
    }

    /**
     * Fallback pour la copie (navigateurs anciens)
     */
    copyCodeFallback(text) {
        const textarea = document.createElement("textarea");
        textarea.value = text;
        textarea.style.position = "fixed";
        textarea.style.opacity = "0";
        document.body.appendChild(textarea);
        textarea.select();

        try {
            document.execCommand("copy");
            console.log("✅ Code copié (fallback)");
        } catch (err) {
            console.error("❌ Erreur lors de la copie fallback:", err);
        }

        document.body.removeChild(textarea);
    }

    /**
     * Dispatcher un événement personnalisé
     */
    dispatchEvent(eventName, detail) {
        const event = new CustomEvent(eventName, {
            detail,
            bubbles: true,
            cancelable: true,
        });
        document.dispatchEvent(event);
    }

    /**
     * Méthode publique pour ouvrir une modale depuis l'extérieur
     */
    static openModal(modalId) {
        const instance = window.modalManager;
        if (instance) {
            instance.open(modalId);
        } else {
            console.warn("⚠️ ModalManager non initialisé");
        }
    }

    /**
     * Méthode publique pour fermer la modale active
     */
    static closeModal() {
        const instance = window.modalManager;
        if (instance) {
            instance.close();
        }
    }
}

// Auto-initialisation au chargement du DOM
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", () => {
        window.modalManager = new ModalManager();
    });
} else {
    window.modalManager = new ModalManager();
}

// Export par défaut
export default ModalManager;
