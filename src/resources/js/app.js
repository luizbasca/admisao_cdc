// Import bootstrap configuration first
import './bootstrap';

// Importar componentes
import './components/masks';
import './components/toast-manager';
import './components/dependentes-manager';

// Importar Pages
import './pages/funcionarios';

// Importar utilitários
import { setupCSRF } from './utils/api';

document.addEventListener('DOMContentLoaded', function () {
    // Configurar CSRF
    setupCSRF();

    // Aplicar máscaras globais
    window.applyMasks();

    // Inicializar toasts globais
    window.initToasts();
});