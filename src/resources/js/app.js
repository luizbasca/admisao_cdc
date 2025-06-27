// Import bootstrap configuration first
import './bootstrap';

import Alpine from 'alpinejs'
import mask from '@alpinejs/mask'

Alpine.plugin(mask)
Alpine.start()

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