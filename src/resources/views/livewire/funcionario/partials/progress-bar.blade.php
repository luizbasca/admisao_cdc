<!-- Progress indicator -->
<div class="row mt-3">
    <div class="col-12">
        <div class="progress-container">
            <div class="progress-header">
                <h5 class="text-white mb-2">
                    <i class="bi bi-list-check me-2"></i>
                    Progresso do Cadastro
                </h5>
                <div class="progress bg-white bg-opacity-25" style="height: 6px;">
                    <div class="progress-bar bg-white" 
                        role="progressbar" 
                        id="form-progress"
                        style="width: {{ ($currentStep / $totalSteps) * 100 }}%"
                        aria-valuenow="{{ $currentStep }}"
                        aria-valuemin="0"
                        aria-valuemax="{{ $totalSteps }}">
                    </div>
                </div>
                <div class="step-info text-center mt-2">
                    <small class="text-white-50" id="step-info">
                        <i class="bi bi-info-circle me-1"></i>
                        Passo {{ $currentStep }} de {{ $totalSteps }}
                        ({{ round(($currentStep / $totalSteps) * 100) }}% concluído)
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>