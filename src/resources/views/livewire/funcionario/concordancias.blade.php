<!-- Termo LGPD -->
<section class="card section-card" data-section="9">
    <div class="section-header">
        <i class="bi bi-person-fill"></i>
        <h2 class="h4 mb-0">Termo LGPD</h2>
    </div>
    <div class="card-body">

        {{-- LGPD --}}
        <div class="mb-4">
            <div class="border rounded p-3 mb-3 bg-light">
                <div class="mb-3">
                    <p class="mb-2" style="font-size: 0.9rem; line-height: 1.4;">
                        <strong>TERMO DE CONSENTIMENTO PARA TRATAMENTO DE DADOS PESSOAIS</strong>
                    </p>
                    <p class="mb-3" style="font-size: 0.9rem; line-height: 1.4;">
                        Pelo presente instrumento, o(a) Titular de dados pessoais, bem como seus dependentes, declara ciência de que os dados coletados serão utilizados para:
                    </p>
                </div>

                <div class="mb-3">
                    <p class="mb-2" style="font-size: 0.9rem; line-height: 1.4;">
                        <strong>Finalidades legais:</strong> elaboração do contrato de trabalho e cumprimento de obrigações legais e regulatórias perante os seguintes órgãos e sistemas:
                    </p>
                    <ul class="mb-3" style="font-size: 0.85rem;">
                        <li>Receita Federal do Brasil;</li>
                        <li>Instituto Nacional do Seguro Social (INSS);</li>
                        <li>Caixa Econômica Federal (inclusive por meio da SEFIP e Conectividade Social);</li>
                        <li>Portal do eSocial;</li>
                        <li>Empregador Web;</li>
                        <li>Plataforma Gov.br;</li>
                        <li>Programa de Integração Social – PIS, quando aplicável;</li>
                        <li>Declarações obrigatórias como RAIS e DIRF;</li>
                        <li>Empresas de transporte para atividades remuneradas;</li>
                        <li>Instituições bancárias para fins de processamento de folha e pagamento;</li>
                        <li>Contato com a empresa.</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <p class="mb-2" style="font-size: 0.9rem; line-height: 1.4;">
                        <strong>Compartilhamento de dados:</strong> mediante o presente, o(a) Titular consente expressamente com o eventual compartilhamento de seus dados pessoais com prestadores de serviços contratados pela empresa, única e exclusivamente para o cumprimento das finalidades legais citadas.
                    </p>
                </div>

                <div class="mb-3">
                    <p class="mb-2" style="font-size: 0.9rem; line-height: 1.4;">
                        <strong>Medidas de proteção e princípios da LGPD:</strong> Em conformidade com a Lei nº 13.709/2018 (LGPD), serão adotadas medidas técnicas e administrativas apropriadas para proteção dos dados pessoais contra acessos não autorizados e de situações acidentais ou ilícitas de destruição, perda, alteração, comunicação ou qualquer forma de tratamento inadequado ou ilícito, observando-se, entre outros.
                    </p>
                </div>

                <div class="mb-3">
                    <p class="mb-2" style="font-size: 0.9rem; line-height: 1.4;">
                        <strong>Prazo de conservação:</strong> os dados pessoais serão armazenados enquanto perdurar o vínculo contratual e, após o encerramento, por até 2 (dois) anos, findo os quais serão eliminados ou anonimizados, conforme previsto na LGPD.
                    </p>
                </div>

                <div class="mb-0">
                    <h6 class="fw-bold mb-2" style="font-size: 0.95rem;">Declaração de consentimento do titular:</h6>
                    <p class="mb-0" style="font-size: 0.9rem; line-height: 1.4;">
                        Declaro que li e compreendi o conteúdo deste Termo de Consentimento para Tratamento de Dados Pessoais. Estou ciente de que os dados fornecidos serão utilizados para fins legais, conforme descrito, e autorizo seu tratamento e eventual compartilhamento nas condições aqui estabelecidas.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input @error('funcionario.concordancia_lgpd') is-invalid @enderror" 
                               type="checkbox" 
                               wire:model.live.debounce.500ms="funcionario.concordancia_lgpd" 
                               id="funcionario.concordancia_lgpd">
                        <label class="form-check-label fw-bold" for="funcionario.concordancia_lgpd">
                            Li e concordo com termos.
                        </label>
                        @error('concordancia_lgpd')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>