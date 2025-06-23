// Extrair e melhorar a função de toast do seu app.js
export function showToast(type, message, duration = 5000) {
    const toast = document.getElementById(type + 'Toast');
    const messageElement = document.getElementById(type + 'Message');

    if (toast && messageElement) {
        messageElement.textContent = message;
        const bsToast = new bootstrap.Toast(toast, { delay: duration });
        bsToast.show();
    }
}

export function initToasts() {
    // Configurações globais para toasts
    const toastElements = document.querySelectorAll('.toast');
    toastElements.forEach(toastEl => {
        toastEl.addEventListener('hidden.bs.toast', function () {
            // Limpar mensagem após fechar
            const messageEl = this.querySelector('[id$="Message"]');
            if (messageEl) messageEl.textContent = '';
        });
    });
}

// Disponibilizar globalmente
window.showToast = showToast;
window.initToasts = initToasts;