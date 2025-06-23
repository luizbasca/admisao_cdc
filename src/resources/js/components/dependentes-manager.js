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
            if (e.target.

                closest('.btn-remover-dependente')) {
                const dependenteItem = e.target.closest('.dependente-item');
                this.removerDependente(dependenteItem);
            }
        });

        // Event delegation para validação em tempo real
        this.container.addEventListener('input', (e) => {
            this.validateField(e.target);
        });

        this.container.addEventListener('change', (e) => {
            this.validateField(e.target);
            this.handleConditionalFields(e.target);
        });
    }

    adicionarDependente() {
        if (this.counter >= this.options.maxDependentes) {
            if (window.showToast) {
                window.showToast('error', `Máximo de ${this.options.maxDependentes} dependentes permitidos.`);
            } else {
                alert(`Máximo de ${this.options.maxDependentes} dependentes permitidos.`);
            }
            return;
        }

        this.counter++;
        const dependenteHtml = this.createDependenteTemplat

        e(this.counter);

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
            this.renumberDependentes();
        }
    }

    createDependenteTemplate(id) {
        return `
        <div class="dependente-item card mb-3" data-dependente="${id}">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="bi bi-person me-2"></i>Dependente ${id}
                </h6>
                <button type="button" class="btn btn-sm btn-outline-danger btn-

remover-dependente">
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
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control cpf-mask" 
                                   name="dependentes[${id}][cpf]" 
                                   placeholder="000.000.000

-00"
                                   pattern="\\d{3}\\.\\d{3}\\.\\d{3}-\\d{2}">
                            <label>CPF</label>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" 
                                   name="dependentes[${id}][data_nascimento]" required>
                            <label>Data de nascimento *</label>
                            <div class="invalid-feedback"></div>
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
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="col-12" id="outros-dependencia-${id}" style="display: none;">
                        <div class="form-floating">
                            <input type="text" class="form-control" 
                                   name="dependentes[${id}][outros_especificar]" 


                                   placeholder="Especificar">
                            <label>Especificar tipo de dependência</label>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
    }

    // Validação de campos
    validateField(field) {
        if (!field.name) return true;

        const value = field.value.trim();
        let isValid = true;
        let errorMessage = '';

        // Remove classes de validação anteriores
        field.classList.remove('is-valid', 'is-invalid');

        // Validação de campo obrigatório
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            errorMessage = 'Este campo é obrigatório.';
        }

        // Validações específicas
        if (field.classList.contains('cpf-mask') && value) {
            if (!this.validateCPF(value)) {
                isValid = false;


                errorMessage = 'CPF inválido.';
            }
        }

        if (field.type === 'date' && value) {
            if (!this.validateAge(value)) {
                isValid = false;
                errorMessage = 'Idade deve ser válida.';
            }
        }

        // Aplicar resultado da validação
        if (isValid && value) {
            field.classList.add('is-valid');
        } else if (!isValid) {
            field.classList.add('is-invalid');
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = errorMessage;
            }
        }

        return isValid;
    }

    // Campos condicionais
    handleConditionalFields(field) {
        if (field.name && field.name.includes('[tipo_dependencia]')) {
            const dependenteId = field.name.match(/\[(\d+)\]/)[1];
            const outrosContainer = document.getElementById(`outros-dependencia-${dependenteId}`);
            const

                outrosInput = outrosContainer?.querySelector('input');

            if (outrosContainer) {
                if (field.value === 'outros') {
                    outrosContainer.style.display = 'block';
                    if (outrosInput) outrosInput.required = true;
                } else {
                    outrosContainer.style.display = 'none';
                    if (outrosInput) {
                        outrosInput.required = false;
                        outrosInput.value = '';
                        outrosInput.classList.remove('is-valid', 'is-invalid');
                    }
                }
            }
        }
    }

    // Renumerar dependentes após remoção
    renumberDependentes() {
        const dependentes = this.container.querySelectorAll('.dependente-item');
        dependentes.forEach((dependente, index) => {
            const novoNumero = index + 1;
            const numeroAtual = dependente.getAttribute('data-dependente');

            // Atualizar atributo data-dependent

            e
            dependente.setAttribute('data-dependente', novoNumero);

            // Atualizar título
            const titulo = dependente.querySelector('h6');
            if (titulo) {
                titulo.innerHTML = `<i class="bi bi-person me-2"></i>Dependente ${novoNumero}`;
            }

            // Atualizar todos os names e ids
            const elementos = dependente.querySelectorAll('[name*="dependentes["], [id*="outros-dependencia-"]');
            elementos.forEach(elemento => {
                if (elemento.name) {
                    elemento.name = elemento.name.replace(/\[\d+\]/, `[${novoNumero}]`);
                }
                if (elemento.id) {
                    elemento.id = elemento.id.replace(/-\d+/, `-${novoNumero}`);
                }
            });
        });

        this.counter = dependentes.length;
    }

    // Validação de CPF
    validateCPF(cpf) {
        cpf = cpf.replace(/\D/g, '');

        if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {


            return false;
        }

        let sum = 0;
        for (let i = 0; i < 9; i++) {
            sum += parseInt(cpf.charAt(i)) * (10 - i);
        }

        let remainder = 11 - (sum % 11);
        if (remainder === 10 || remainder === 11) remainder = 0;
        if (remainder !== parseInt(cpf.charAt(9))) return false;

        sum = 0;
        for (let i = 0; i < 10; i++) {
            sum += parseInt(cpf.charAt(i)) * (11 - i);
        }

        remainder = 11 - (sum % 11);
        if (remainder === 10 || remainder === 11) remainder = 0;

        return remainder === parseInt(cpf.charAt(10));
    }

    // Validação de idade
    validateAge(birthDate) {
        const today = new Date();
        const birth = new Date(birthDate);
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }

        return age >=

            0 && age <= 120; // Ajustado para dependentes
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

    // Validar todos os dependentes
    validateAll() {
        const allInputs = this.container.querySelectorAll('input, select');
        let isValid = true;

        allInputs.forEach(input => {
            if (!this.validateField(input)) {
                isValid = false;
            }
        });

        return isValid;
    }

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