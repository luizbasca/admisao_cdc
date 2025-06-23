import { DependentesManager } from '../components/dependentes-manager.js';
import { FormValidator } from '../components/form-validator.js';

export function initFuncionariosPage() {
    // Só executa se estiver na página de funcionários
    if (!document.getElementById('dependentesContainer')) return;

    // Inicializar validador do formulário
    const formValidator = new FormValidator('cadastroFuncionario', {
        realTimeValidation: true,
        showProgress: true
    });

    // Inicializar gerenciador de dependentes
    const dependentesManager = new DependentesManager('dependentesContainer', {
        maxDependentes: 5,
        showEmptyMessage: true
    });

    // Conectar botão de adicionar
    const btnAdicionar = document.getElementById('adicionarDependente');
    if (btnAdicionar) {
        btnAdicionar.addEventListener('click', () => {
            dependentesManager.adicionarDependente();
        });
    }

    // Busca CEP
    setupCepSearch();

    // Submissão via AJAX com validação
    setupFormSubmission(formValidator, dependentesManager);
}

function setupCepSearch() {
    const cepInput = document.getElementById('cep');
    if (!cepInput) return;

    cepInput.addEventListener('blur', async function () {
        const cep = this.value.replace(/\D/g, '');
        if (cep.length === 8) {
            try {
                const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                const data = await response.json();

                if (!data.erro) {
                    document.getElementById('rua').value = data.logradouro || '';
                    document.getElementById('bairro').value = data.bairro || '';
                    document.getElementById('cidade').value = data.localidade || '';
                    document.getElementById('estado').value = data.uf || '';
                    document.getElementById('numero')?.focus();
                }
            } catch (error) {
                console.error('Erro ao buscar CEP:', error);
                if (window.showToast) {
                    window.showToast('error', 'Erro ao buscar CEP');
                }
            }
        }
    });
}

function setupFormSubmission(formValidator, dependentesManager) {
    const form = document.getElementById('cadastroFuncionario');
    if (!form) return;

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        // Validar formulário principal
        const isFormValid = formValidator.validateAll();

        // Validar dependentes
        const areDependentesValid = dependentesManager.validateAll();

        if (!isFormValid || !areDependentesValid) {
            if (window.showToast) {
                window.showToast('error', 'Por favor, corrija os erros no formulário.');
            }
            return;
        }

        const submitBtn = form.querySelector('.btn-submit');
        const originalText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Processando...';

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();

            if (data.success) {
                if (window.showToast) {
                    window.showToast('success', data.message);
                } else {
                    alert('Sucesso: ' + data.message);
                }

                if (data.redirect) {
                    setTimeout(() => window.location.href = data.redirect, 1500);
                }
            } else {
                if (window.showToast) {
                    window.showToast('error', data.message);
                } else {
                    alert('Erro: ' + data.message);
                }
            }
        } catch (error) {
            console.error('Erro:', error);
            if (window.showToast) {
                window.showToast('error', 'Erro de conexão');
            } else {
                alert('Erro de conexão');
            }
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    });
}

// Auto-inicializar quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', initFuncionariosPage);