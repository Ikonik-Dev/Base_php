// Gestion des blocs de code
export class CodeBlockManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupCopyButtons();
        this.setupSyntaxHighlighting();
    }

    setupCopyButtons() {
        const copyButtons = document.querySelectorAll("[data-copy-code]");

        copyButtons.forEach((button) => {
            button.addEventListener("click", (e) => {
                const codeBlock = e.target.closest(".code-block");
                const code = codeBlock.querySelector(".code-block__code");

                if (code) {
                    this.copyToClipboard(code.textContent, button);
                }
            });
        });
    }

    async copyToClipboard(text, button) {
        try {
            await navigator.clipboard.writeText(text);
            this.showCopySuccess(button);
        } catch (err) {
            console.error("Erreur lors de la copie:", err);
            this.fallbackCopy(text, button);
        }
    }

    fallbackCopy(text, button) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();

        try {
            document.execCommand("copy");
            this.showCopySuccess(button);
        } catch (err) {
            console.error("Erreur fallback copie:", err);
        }

        document.body.removeChild(textArea);
    }

    showCopySuccess(button) {
        const originalText = button.textContent;
        button.classList.add("copied");
        button.textContent = "Copié !";

        setTimeout(() => {
            button.classList.remove("copied");
            button.textContent = originalText;
        }, 2000);
    }

    setupSyntaxHighlighting() {
        // Coloration syntaxique basique pour PHP
        const codeBlocks = document.querySelectorAll(
            ".code-block__code.language-php"
        );

        codeBlocks.forEach((block) => {
            let html = block.innerHTML;

            // Mots-clés PHP
            html = html.replace(
                /\b(function|class|public|private|protected|static|return|if|else|elseif|while|for|foreach|echo|print|var|const|extends|implements|interface|abstract|final|namespace|use|try|catch|finally|throw|new|instanceof)\b/g,
                '<span class="keyword">$1</span>'
            );

            // Chaînes de caractères
            html = html.replace(
                /('([^'\\]|\\.)*'|"([^"\\]|\\.)*")/g,
                '<span class="string">$1</span>'
            );

            // Commentaires
            html = html.replace(
                /(\/\/.*$|\/\*[\s\S]*?\*\/|#.*$)/gm,
                '<span class="comment">$1</span>'
            );

            // Variables PHP
            html = html.replace(/(\$\w+)/g, '<span class="variable">$1</span>');

            // Nombres
            html = html.replace(
                /\b(\d+\.?\d*)\b/g,
                '<span class="number">$1</span>'
            );

            block.innerHTML = html;
        });
    }
}

// Initialisation automatique
document.addEventListener("DOMContentLoaded", function () {
    new CodeBlockManager();
});
