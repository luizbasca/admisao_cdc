export class DependentesManager {
    constructor(containerId, options = {}) {
        this.container = document.getElementById(containerId);
        this.counter = 0;
        this.options = {
            maxDependentes: options.maxDependentes || 10,
            showEmptyMessage: options.showEmptyMessage !== false,
            ...options
        };

        this.init();
    }

    init() {
        this.updateEmptyMessage();
        this.setupEventListeners();
    }

    setupEventListeners() {
        // Event delegation para botões de remover
        this.container.addEventListener('click', (e) => {
            if (e.target.closest('.btn-remover-dependente')) {
                const dependenteItem = e.target.closest('.dependente-item');
                this.removerDependente(dependenteItem);
            }
        });
    }

    adicionarDependente() {
        if (this.counter >= this.options.maxDependentes) {
            alert(`Máximo de ${this.options.maxDependentes} dependentes permitidos.`);
            return;
        }

        this.counter++;
        const dependenteHtml = this.createDependenteTemplate(this.counter);

        this.container.insertAdjacentHTML('beforeend', dependenteHtml);
        this.updateEmptyMessage();
        this.applyMasks();

        // Focar no primeiro campo do novo dependente
        const novoItem = this.container.lastElementChild;
        const primeiroInput = novoItem.querySelector('input');
        if (primeiroInput) primeiroInput.focus();
    }

    removerDependente(item) {
        if (confirm('Deseja remover este dependente?')) {
            item.remove();
            this.updateEmptyMessage();
        }
    }

    createDependenteTemplate(id) {
        return `
            <div class="dependente-item card mb-3" data-dependente="${id}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="bi bi-person me-2"></i>Dependente ${id}
                    </h6>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remover-dependente">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" 
                                       name="dependentes[${id}][nome_completo]" 
                                       placeholder="Nome completo" required maxlength="100">
                                <label>Nome completo *</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control cpf-mask" 
                                       name="dependentes[${id}][cpf]" 
                                       placeholder="000.000.000-00">
                                <label>CPF</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" 
                                       name="dependentes[${id}][data_nascimento]" required>
                                <label>Data de nascimento *</label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-floating">
                                <select class="form-select" name="dependentes[${id}][tipo_dependencia]" required>
                                    <option value="">Selecione...</option>
                                    <option value="conjuge">Cônjuge</option>
                                    <option value="filho">Filho(a)</option>
                                    <option value="enteado">Enteado(a)</option>
                                    <option value="menor_tutela">Menor sob tutela</option>
                                    <option value="pais">Pais</option>
                                    <option value="outros">Outros</option>
                                </select>
                                <label>Tipo de dependência *</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    updateEmptyMessage() {
        const emptyMessage = document.getElementById('semDependentes');
        const hasDependentes = this.container.children.length > 0;

        if (emptyMessage) {
            emptyMessage.style.display = hasDependentes ? 'none' : 'block';
        }
    }

    applyMasks() {
        // Aplicar máscara CPF apenas nos novos campos
        const newCpfInputs = this.container.querySelectorAll('.cpf-mask:not([data-masked])');
        newCpfInputs.forEach(input => {
            input.setAttribute('data-masked', 'true');
            input.addEventListener('input', this.cpfMask);
        });
    }

    cpfMask(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = value;
    }

    // Métodos públicos para controle externo
    getDependentesData() {
        const dependentes = [];
        this.container.querySelectorAll('.dependente-item').forEach(item => {
            const inputs = item.querySelectorAll('input, select');
            const dependente = {};

            inputs.forEach(input => {
                const name = input.name.match(/\[([^\]]+)\]$/);
                if (name) {
                    dependente[name[1]] = input.value;
                }
            });

            dependentes.push(dependente);
        });

        return dependentes;
    }

    limparTodos() {
        if (confirm('Deseja remover todos os dependentes?')) {
            this.container.innerHTML = '';
            this.counter = 0;
            this.updateEmptyMessage();
        }
    }

    getCount() {
        return this.container.children.length;
    }
}

// Disponibilizar globalmente
window.DependentesManager = DependentesManager;