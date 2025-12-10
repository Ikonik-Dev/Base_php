/**
 * Gestionnaire pour les modales d'étapes E-commerce
 * - Copie de code
 * - Checklist interactives
 * Note: L'ouverture/fermeture des modales est gérée par modal-manager.js
 */

document.addEventListener("DOMContentLoaded", function () {
    console.log("🚀 Modal Etape Manager chargé");

    // Fonctionnalité de copie de code
    document.addEventListener("click", async function (e) {
        const copyBtn = e.target.closest(".modal__code-copy");
        if (!copyBtn) return;

        const targetId = copyBtn.getAttribute("data-copy-target");
        const codeElement = document.getElementById(targetId);

        if (!codeElement) return;

        try {
            const code = codeElement.textContent;
            await navigator.clipboard.writeText(code);

            // Feedback visuel
            const textEl = copyBtn.querySelector(".modal__code-copy-text");
            const iconEl = copyBtn.querySelector(".modal__code-copy-icon");
            const originalText = textEl.textContent;
            const originalIcon = iconEl.textContent;

            textEl.textContent = "Copié !";
            iconEl.textContent = "✓";
            copyBtn.style.borderColor = "var(--matrix-green)";
            copyBtn.style.background = "var(--matrix-green)";
            copyBtn.style.color = "var(--matrix-black)";

            setTimeout(() => {
                textEl.textContent = originalText;
                iconEl.textContent = originalIcon;
                copyBtn.style.borderColor = "";
                copyBtn.style.background = "";
                copyBtn.style.color = "";
            }, 2000);
        } catch (err) {
            console.error("Erreur lors de la copie:", err);
            copyBtn.querySelector(".modal__code-copy-text").textContent =
                "Erreur !";
        }
    });

    // Navigation entre modales - utilise le modalManager global
    document.addEventListener("click", function (e) {
        const navBtn = e.target.closest(".modal__nav-btn[data-open-modal]");
        if (!navBtn) return;

        e.preventDefault();
        const nextModalId = navBtn.getAttribute("data-open-modal");

        // Utiliser le modalManager global pour naviguer
        if (window.modalManager) {
            window.modalManager.close();
            setTimeout(() => {
                window.modalManager.open(nextModalId);
            }, 300);
        }
    });

    // Persistence des checkboxes dans localStorage
    document.querySelectorAll(".checklist-checkbox").forEach((checkbox) => {
        const modalId = checkbox.closest(".modal").id;
        const itemIndex = Array.from(
            checkbox.parentElement.parentElement.children
        ).indexOf(checkbox.parentElement);
        const storageKey = `checklist-${modalId}-${itemIndex}`;

        // Restaurer l'état sauvegardé
        const saved = localStorage.getItem(storageKey);
        if (saved === "true") {
            checkbox.checked = true;
        }

        // Sauvegarder les changements
        checkbox.addEventListener("change", function () {
            localStorage.setItem(storageKey, this.checked);

            // Animation de feedback
            const listItem = this.closest(".modal__list-item");
            if (this.checked) {
                listItem.style.transition = "opacity 0.3s ease";
                listItem.style.opacity = "0.6";
            } else {
                listItem.style.opacity = "1";
            }
        });
    });

    // Raccourcis clavier dans les modales
    document.addEventListener("keydown", function (e) {
        const activeModal = document.querySelector(".modal.modal--active");
        if (!activeModal) return;

        // Ctrl/Cmd + C pour copier le premier bloc de code visible
        if (
            (e.ctrlKey || e.metaKey) &&
            e.key === "c" &&
            !window.getSelection().toString()
        ) {
            const firstCopyBtn = activeModal.querySelector(".modal__code-copy");
            if (firstCopyBtn) {
                e.preventDefault();
                firstCopyBtn.click();
            }
        }

        // Flèches gauche/droite pour naviguer entre étapes
        if (e.key === "ArrowRight") {
            const nextBtn = activeModal.querySelector(".modal__nav-btn--next");
            if (nextBtn) nextBtn.click();
        }
        if (e.key === "ArrowLeft") {
            const prevBtn = activeModal.querySelector(".modal__nav-btn--prev");
            if (prevBtn) prevBtn.click();
        }
    });

    // Animation d'entrée des sections au scroll
    const observerOptions = {
        root: null,
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.animation = "slideDown 0.5s ease forwards";
            }
        });
    }, observerOptions);

    document
        .querySelectorAll(".modal__command-block, .modal__file-block")
        .forEach((el) => {
            observer.observe(el);
        });

    // Message de bienvenue dans la console pour les curieux
    console.log(
        "%c🚀 E-commerce Tutorial - Matrix Edition",
        "color: #00ff41; font-size: 20px; font-weight: bold; text-shadow: 0 0 5px #00ff41;"
    );
    console.log(
        "%cNavigation : Flèches ← → | Copie rapide : Ctrl+C",
        "color: #00ff41; font-size: 12px;"
    );
});
