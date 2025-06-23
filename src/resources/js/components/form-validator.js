export class FormValidator {
    constructor(formId, options = {}) {
        this.form = document.getElementById(formId);
        this.options = {
            realTimeValidation: options.realTimeValidation !== false,
            showProgress: options.showProgress !== false,
            ...options
        };

        if (this.form) {
            this.init();
        }
    }

    init() {
        this.setupEventListeners();
        if (this.options.showProgress) {
            this.setupProgressIndicator();
        }
    }

    setupEventListeners() {
        // Validação em tempo real
        if (this.options.realTimeValidation) {
            this.form.addEventListener('input', (e) => this.validateField(e.target));
            this.form.addEventListener('change', (e) => this.validateField(e.target));
        }

        // Submissão do formulário
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    setupProgressIndicator() {
        const sections = this.form.querySelectorAll('[data-section]');
        const progressBar = document.getElementById('formProgress');

        if (!progressBar || sections.length === 0) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const sectionNumber = parseInt(entry.target.dataset.section);
                    const progress = (sectionNumber / sections.length) * 100;
                    progressBar.style.width = `${progress}%`;
                    progressBar.setAttribute('aria-valuenow', progress);
                }
            });
        }, { threshold: 0.5 });

        sections.forEach(

            section => observer.observe(section));
    }

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

        // Validações específicas por tipo de campo
        if (value) {
            switch (field.type) {
                case 'email':
                    if (!this.validateEmail(value)) {
                        isValid = false;
                        errorMessage = 'Email inválido.';
                    }
                    break;
                case 'date':
                    if (field.name.includes('nascimento') && !this.validateAge(value)) {
                        isValid = false;
                        errorMessage = 'Idade deve ser entre 16 e 100 anos.';
                    }
                    break;
            }

            // Validações por atributo data-mask ou classe
            if (field.hasAttribute('data-mask') || field.classList.contains('cpf-mask')) {
                const mask = field.getAttribute('data-mask') || 'cpf';
                if (mask === 'cpf' && !this.validateCPF(value)) {
                    isValid = false;
                    errorMessage = 'CPF inválido.';
                }
            }

            if (field.hasAttribute('data-mask') && field.getAttribute('data-mask') === 'cep') {
                if (!/^\d{5}-\d{3}$/.test(value)) {
                    isValid = false;
                    errorMessage = 'CEP deve estar no formato 00000-000.';
                }
            }
        }

        // Aplicar resultado da validação
        if (isValid && value) {
            field.classList.add('is-valid');
        } else {
            if (!isValid) {
                field.classList.add('is-invalid');
                const feedback = field.parentNode.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.textContent = errorMessage;
                }
            }
        }

        return isValid;
    }

    validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

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

        remainder = 11 -

            (sum % 11);
        if (remainder === 10 || remainder === 11) remainder = 0;

        return remainder === parseInt(cpf.charAt(10));
    }

    validateAge(birthDate) {
        const today = new Date();
        const birth = new Date(birthDate);
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }

        return age >= 16 && age <= 100;
    }

    validateAll() {
        const allFields = this.form.querySelectorAll('input, select, textarea');
        let isFormValid = true;

        allFields.forEach(field => {
            if (!this.validateField(field)) {
                isFormValid = false;
            }
        });

        return isFormValid;
    }

    handleSubmit(e) {
        e.preventDefault();

        const isValid = this.validateAll();

        if (isValid) {
            // Permitir submissão normal
            return true;
        } else {
            // Mostrar erro e focar no primeiro campo inválido
            if (window.showToast) {
                window.showToast('error', 'Por favor, corrija os erros no formulário.');
            }

            const firstError = this.form.querySelector('.is-invalid');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }

            return false;
        }
    }
}

// Disponibilizar globalmente
window.FormValidator = FormValidator;