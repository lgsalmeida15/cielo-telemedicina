<!doctype html>
<html lang="pt-BR"><head><meta charset="utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Documentação Técnica — TeleMedicina (Laravel) | Ágil Desenvolvimento de Sistemas</title>
<style>
:root{--bg:#0b1020;--text:#e8eeff;--muted:#a9b6df;--line:rgba(255,255,255,.10);--accent:#7aa2ff;--accent2:#5eead4;--shadow:0 10px 40px rgba(0,0,0,.35);--radius:14px;--mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--sans:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
*{box-sizing:border-box}body{margin:0;background:radial-gradient(1200px 800px at 15% 10%, rgba(122,162,255,.15), transparent 60%),radial-gradient(900px 700px at 85% 20%, rgba(94,234,212,.10), transparent 55%),var(--bg);color:var(--text);font-family:var(--sans)}
a{color:var(--accent);text-decoration:none}a:hover{text-decoration:underline}code,pre{font-family:var(--mono)}
.layout{display:grid;grid-template-columns:320px 1fr;min-height:100vh}
.sidebar{border-right:1px solid var(--line);background:rgba(16,26,51,.55);backdrop-filter:blur(10px);padding:18px 16px;position:sticky;top:0;height:100vh;overflow:auto}
.brand{display:flex;align-items:center;gap:10px;padding:10px 10px 16px}
.dot{width:12px;height:12px;border-radius:999px;background:var(--accent2);box-shadow:0 0 0 4px rgba(94,234,212,.18)}
.brand h1{font-size:16px;margin:0}.brand .sub{font-size:12px;color:var(--muted);margin-top:2px}
.controls{display:flex;gap:10px;padding:10px;margin-bottom:8px;flex-wrap:wrap}
.btn{cursor:pointer;border:1px solid var(--line);background:rgba(15,23,48,.7);color:var(--text);padding:8px 10px;border-radius:10px;font-size:12px}
.btn:hover{border-color:rgba(122,162,255,.45)}
.toc{padding:6px 8px 14px}.toc .item{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:8px 10px;border-radius:10px;border:1px solid transparent;color:var(--text)}
.toc .item:hover{background:rgba(15,23,48,.55);border-color:var(--line)}.toc .item.active{background:rgba(122,162,255,.18);border-color:rgba(122,162,255,.35)}
.toc .badge{font-size:11px;color:var(--muted)}
.main{padding:26px 22px;overflow:auto}
.page{display:none;max-width:1200px;margin:0 auto 24px;background:rgba(16,26,51,.35);border:1px solid var(--line);border-radius:var(--radius);padding:22px 22px 26px;box-shadow:var(--shadow)}
.page.active{display:block}.page h2{margin:0 0 10px;font-size:22px}.page p{color:var(--muted);line-height:1.6}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:14px}@media(max-width:980px){.layout{grid-template-columns:1fr}.sidebar{position:relative;height:auto}.grid-2{grid-template-columns:1fr}}
.card{background:rgba(15,23,48,.65);border:1px solid var(--line);border-radius:14px;padding:14px;margin:10px 0}
.card-title{font-size:14px}.card-body{margin-top:8px;color:var(--muted);font-size:13px;line-height:1.5}
.muted{color:var(--muted)}.pill{display:inline-block;margin-left:8px;font-size:11px;padding:3px 8px;border-radius:999px;border:1px solid var(--line);color:var(--muted)}
.table-wrap{overflow:auto;border-radius:14px;border:1px solid var(--line)}
table{width:100%;border-collapse:collapse;background:rgba(15,23,48,.45)}th,td{padding:10px 12px;border-bottom:1px solid var(--line);vertical-align:top}th{text-align:left;font-size:12px;color:var(--muted)}td{font-size:13px}
pre{margin:10px 0;padding:12px 14px;border-radius:12px;border:1px solid var(--line);background:rgba(10,14,30,.55);overflow:auto}
.callout{border:1px solid rgba(94,234,212,.25);background:rgba(94,234,212,.06);border-radius:14px;padding:12px 14px;color:var(--muted);margin:12px 0}
.hint{font-size:12px;color:var(--muted);margin-top:6px}
</style></head><body>
<div class="layout">
<aside class="sidebar">
  <div class="brand"><div class="dot"></div><div><h1>TeleMedicina · Documentação Técnica</h1>
  <div class="sub">Desenvolvido por <strong>Ágil Desenvolvimento de Sistemas</strong> · gerado em 22/12/2025</div></div></div>
  <div class="controls"><button class="btn" id="prevBtn">◀ Anterior</button><button class="btn" id="nextBtn">Próxima ▶</button><button class="btn" id="allBtn">Ver tudo</button></div>
  <div class="toc" id="toc"></div>
  <div class="hint">Dica: <strong>Ctrl+F</strong> para buscar.</div>
</aside>
<main class="main" id="pages">
  <section class="page" data-title="Capa & Contexto do Projeto">
    <h2>Capa & Contexto do Projeto</h2>
    <p>Documentação técnica completa do <strong>TeleMedicina</strong> (Laravel), desenvolvida pela <strong>Ágil Desenvolvimento de Sistemas</strong>.</p>
    <div class="grid-2">
      <div class="card"><div class="card-title"><strong>Repositório / Branch</strong></div><div class="card-body"><ul>
        <li>Repositório: <code>github.com/grupoagil/TeleMedicina.git</code></li><li>Branch alvo: <code>develop</code></li>
        <li>Laravel: <code>^12.0</code></li><li>PHP: <code>^8.2</code></li>
      </ul></div></div>
      <div class="card"><div class="card-title"><strong>Inventário</strong></div><div class="card-body"><ul>
        <li>Commands: <code>1</code></li><li>Services: <code>11</code></li><li>Controllers: <code>37</code></li><li>Views: <code>98</code></li>
        <li>Rotas Web/API: <code>166/0</code></li>
      </ul></div></div>
    </div>
    <div class="callout"><strong>Empresa responsável:</strong> Ágil Desenvolvimento de Sistemas — desenvolvimento, arquitetura, integrações e manutenção.</div>
    <div class="hint"><strong>Ágil Desenvolvimento de Sistemas</strong> — responsável pelo desenvolvimento, arquitetura, integrações, manutenção e evolução contínua deste sistema.</div>
  </section>

  <section class="page" data-title="Configuração de Ambiente (.env)">
    <h2>Configuração de Ambiente (.env)</h2>
    <p>Mapa do <code>.env</code> informado (servidor), com valores sensíveis mascarados.</p>
    <div class="table-wrap"><table><thead><tr><th>Chave</th><th>Valor (mascarado quando sensível)</th></tr></thead><tbody><tr><td><code>APP_NAME</code></td><td><code>Laravel</code></td></tr><tr><td><code>APP_ENV</code></td><td><code>local</code></td></tr><tr><td><code>APP_KEY</code></td><td><code>base64:***</code></td></tr><tr><td><code>APP_DEBUG</code></td><td><code>true</code></td></tr><tr><td><code>APP_URL</code></td><td><code>http://localhost</code></td></tr><tr><td><code>IBAM_UUID</code></td><td><code>&quot;6dfd5b02-d77e-41d7-8077-726b0154a23f&quot;</code></td></tr><tr><td><code>ELO_UUID</code></td><td><code>&quot;b09eddec-9dca-4eaf-a71b-5fb3aa52fafd&quot;</code></td></tr><tr><td><code>ASAAS_TOKEN</code></td><td><code>aact_***</code></td></tr><tr><td><code>ASAAS_URL</code></td><td><code>https://api.asaas.com/v3</code></td></tr><tr><td><code>DB_CONNECTION</code></td><td><code>mysql</code></td></tr><tr><td><code>DB_HOST</code></td><td><code>127.0.0.1</code></td></tr><tr><td><code>DB_PORT</code></td><td><code>3306</code></td></tr><tr><td><code>DB_DATABASE</code></td><td><code>boxfarmaelo</code></td></tr><tr><td><code>DB_USERNAME</code></td><td><code>boxfarmaelo</code></td></tr><tr><td><code>DB_PASSWORD</code></td><td><code>***</code></td></tr><tr><td><code>MAIL_HOST</code></td><td><code>smtp-relay.brevo.com</code></td></tr><tr><td><code>MAIL_PORT</code></td><td><code>465</code></td></tr><tr><td><code>MAIL_USERNAME</code></td><td><code>&quot;9e16bc001@smtp-brevo.com&quot;</code></td></tr><tr><td><code>MAIL_PASSWORD</code></td><td><code>***</code></td></tr><tr><td><code>BREVO_API_KEY</code></td><td><code>xkeysib-***</code></td></tr></tbody></table></div>
    <div class="callout"><strong>Boas práticas:</strong> não versionar <code>.env</code> e rotacionar segredos periodicamente.</div>
    <div class="hint"><strong>Ágil Desenvolvimento de Sistemas</strong> — responsável pelo desenvolvimento, arquitetura, integrações, manutenção e evolução contínua deste sistema.</div>
  </section>

  <section class="page" data-title="Integração Asaas (Gateway)">
    <h2>Integração Asaas (Gateway)</h2>
    <p>Integração de cobranças/pagamentos via services em <code>App\Services\Asaas</code>.</p>
    <div class="grid-2">
      <div class="card"><div class="card-title"><strong>Variáveis</strong></div><div class="card-body"><ul><li><code>ASAAS_URL</code></li><li><code>ASAAS_TOKEN</code></li></ul></div></div>
      <div class="card"><div class="card-title"><strong>Services</strong></div><div class="card-body"><ul><li><code>AsaasService</code></li><li><code>AsaasCustomerService</code></li><li><code>AsaasPaymentService</code></li></ul></div></div>
    </div>
    <div class="hint"><strong>Ágil Desenvolvimento de Sistemas</strong> — responsável pelo desenvolvimento, arquitetura, integrações, manutenção e evolução contínua deste sistema.</div>
  </section>

  <section class="page" data-title="Integração IBAM Benefícios (Telemedicina)">
    <h2>Integração IBAM Benefícios (Telemedicina)</h2>
    <p>Integração baseada em UUIDs (<code>IBAM_UUID</code>/<code>ELO_UUID</code>) para relacionamento e escopo.</p>
    <div class="card"><div class="card-title"><strong>Service</strong></div><div class="card-body"><p><code>IBAMService</code> (em <code>app/Services</code>).</p></div></div>
    <div class="hint"><strong>Ágil Desenvolvimento de Sistemas</strong> — responsável pelo desenvolvimento, arquitetura, integrações, manutenção e evolução contínua deste sistema.</div>
  </section>

  <section class="page" data-title="Commands (Artisan) & Cron">
    <h2>Commands (Artisan) & Cron</h2>
    <div class="table-wrap"><table><thead><tr><th>Command</th><th>Signature</th><th>Descrição</th></tr></thead><tbody><tr><td><strong>AsaasSyncInvoices</strong><div class='muted'><code>app/Console/Commands/AsaasSyncInvoices.php</code></div></td><td><code>asaas:sync-invoices 
                            {--company= : ID da empresa (opcional)}
                            {--days=30 : Buscar cobranças dos últimos X dias}</code></td><td>Sincroniza cobranças do Asaas com Invoices e histórico</td></tr></tbody></table></div>
    <div class="card"><div class="card-title"><strong>Cron recomendado (Scheduler)</strong></div><div class="card-body"><pre><code>* * * * * cd /var/www/telemedicina &amp;&amp; php artisan schedule:run &gt;&gt; /dev/null 2&gt;&amp;1</code></pre>
    <div class="muted">Agendamentos devem ser definidos em <code>app/Console/Kernel.php</code>.</div></div></div>
    <div class="hint"><strong>Ágil Desenvolvimento de Sistemas</strong> — responsável pelo desenvolvimento, arquitetura, integrações, manutenção e evolução contínua deste sistema.</div>
  </section>

  <section class="page" data-title="Services (Mapa Completo)">
    <h2>Services (Mapa Completo)</h2>
    
        <div class="card">
          <div class="card-title"><strong>AsaasService</strong> <span class="pill">—</span></div>
          <div class="card-body">
            <div class="muted"><code>App\Services\Asaas</code> · <code>app/Services/Asaas/AsaasService.php</code></div>
            <div style="margin-top:8px"><strong>Métodos</strong><div style="margin-top:6px"><code>public __construct()</code><br><code>protected request(string $method, string $endpoint, array $params = [])</code><br><code>public getCustomers(int $offset = 0, int $limit = 100)</code><br><code>public getPayments(array $params = [])</code><br><code>public getSubscriptions(int $offset = 0, int $limit = 100)</code><br><code>public updateSubscriptionCreditCard(string $subscriptionId,
        array $creditCard,
        array $holderInfo,
        string $remoteIp)</code><br><code>public cancelSubscription(string $subscriptionId)</code><br><code>public generateCustomerPortalLink(string $asaasCustomerId)</code></div></div>
            <div style="margin-top:8px"><strong>Config keys</strong>: —</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>AsaasCustomerService</strong> <span class="pill">—</span></div>
          <div class="card-body">
            <div class="muted"><code>App\Services</code> · <code>app/Services/AsaasCustomerService.php</code></div>
            <div style="margin-top:8px"><strong>Métodos</strong><div style="margin-top:6px"><code>public createCustomerForBeneficiary($b)</code><br><code>private findCustomer($cpf, $email)</code><br><code>private createCustomer($b)</code></div></div>
            <div style="margin-top:8px"><strong>Config keys</strong>: —</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>AsaasPaymentService</strong> <span class="pill">—</span></div>
          <div class="card-body">
            <div class="muted"><code>App\Services</code> · <code>app/Services/AsaasPaymentService.php</code></div>
            <div style="margin-top:8px"><strong>Métodos</strong><div style="margin-top:6px"><code>public createPayment($b, $planUuid, $type)</code><br><code>public createSubscription($customer, $value, $description, $creditCard, $holderInfo)</code></div></div>
            <div style="margin-top:8px"><strong>Config keys</strong>: —</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>BeneficiaryPlanService</strong> <span class="pill">—</span></div>
          <div class="card-body">
            <div class="muted"><code>App\Services</code> · <code>app/Services/BeneficiaryPlanService.php</code></div>
            <div style="margin-top:8px"><strong>Métodos</strong><div style="margin-top:6px"><code>public createBeneficiaryPlan($beneficiary, $planUuid)</code></div></div>
            <div style="margin-top:8px"><strong>Config keys</strong>: —</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>BeneficiaryService</strong> <span class="pill">—</span></div>
          <div class="card-body">
            <div class="muted"><code>App\Services</code> · <code>app/Services/BeneficiaryService.php</code></div>
            <div style="margin-top:8px"><strong>Métodos</strong><div style="margin-top:6px"><code>public createBeneficiary($request, $companyUuid)</code></div></div>
            <div style="margin-top:8px"><strong>Config keys</strong>: —</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>BrevoMailService</strong> <span class="pill">—</span></div>
          <div class="card-body">
            <div class="muted"><code>App\Services</code> · <code>app/Services/BrevoMailService.php</code></div>
            <div style="margin-top:8px"><strong>Métodos</strong><div style="margin-top:6px">—</div></div>
            <div style="margin-top:8px"><strong>Config keys</strong>: —</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>IBAMService</strong> <span class="pill">—</span></div>
          <div class="card-body">
            <div class="muted"><code>App\Services</code> · <code>app/Services/IBAMService.php</code></div>
            <div style="margin-top:8px"><strong>Métodos</strong><div style="margin-top:6px"><code>public __construct($baseUrl)</code><br><code>private request($method, $endpoint, $payload = null)</code><br><code>public login()</code><br><code>public createBeneficiary(array $data)</code><br><code>public updateBeneficiary($uuidDocway, array $data)</code><br><code>public deleteBeneficiary($uuidDocway)</code><br><code>public findBeneficiary($cpf = null, $term = null)</code><br><code>public createDependent(string $cpf, array $data)</code><br><code>public listDependents(string $cpf)</code><br><code>public deleteDependent(string $cpf, string $dependentCpf)</code><br><code>public medcareCreate($docwayPatientId, array $data)</code><br><code>public medcareAvailableHours($docwayPatientId, $specialtyId, $date)</code><br><code>public medcareList($docwayPatientId)</code><br><code>public medcareListDependent($cpf)</code><br><code>public medcareInfo($docwayPatientId, $idAtendimento)</code><br><code>public medcareCancel($docwayPatientId, $idAtendimento)</code></div></div>
            <div style="margin-top:8px"><strong>Config keys</strong>: —</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>InvoiceHistoryService</strong> <span class="pill">—</span></div>
          <div class="card-body">
            <div class="muted"><code>App\Services</code> · <code>app/Services/InvoiceHistoryService.php</code></div>
            <div style="margin-top:8px"><strong>Métodos</strong><div style="margin-top:6px"><code>public createInvoiceHistory($invoice)</code></div></div>
            <div style="margin-top:8px"><strong>Config keys</strong>: —</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>InvoiceService</strong> <span class="pill">—</span></div>
          <div class="card-body">
            <div class="muted"><code>App\Services</code> · <code>app/Services/InvoiceService.php</code></div>
            <div style="margin-top:8px"><strong>Métodos</strong><div style="margin-top:6px"><code>public createInvoice($beneficiary, $beneficiaryPlan, $payment, $request)</code></div></div>
            <div style="margin-top:8px"><strong>Config keys</strong>: —</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>PlanStatusService</strong> <span class="pill">—</span></div>
          <div class="card-body">
            <div class="muted"><code>App\Services</code> · <code>app/Services/PlanStatusService.php</code></div>
            <div style="margin-top:8px"><strong>Métodos</strong><div style="margin-top:6px"><code>public resolveForBeneficiary(Beneficiary $beneficiary)</code><br><code>public label(string|null $status)</code></div></div>
            <div style="margin-top:8px"><strong>Config keys</strong>: —</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>SubscriptionCancellationService</strong> <span class="pill">—</span></div>
          <div class="card-body">
            <div class="muted"><code>App\Services</code> · <code>app/Services/SubscriptionCancellationService.php</code></div>
            <div style="margin-top:8px"><strong>Métodos</strong><div style="margin-top:6px"><code>public requestCancellation(Beneficiary $beneficiary)</code></div></div>
            <div style="margin-top:8px"><strong>Config keys</strong>: —</div>
          </div>
        </div>
        
    <div class="hint"><strong>Ágil Desenvolvimento de Sistemas</strong> — responsável pelo desenvolvimento, arquitetura, integrações, manutenção e evolução contínua deste sistema.</div>
  </section>

  <section class="page" data-title="Rotas — Web">
    <h2>Rotas — Web</h2>
    <h3>routes/web.php</h3><div class="table-wrap"><table><thead><tr><th>Método</th><th>URI</th><th>Ação</th><th>Name</th><th>Middleware</th></tr></thead><tbody><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;Admin\CheckoutController@landingPage&#x27;</code></td><td>home</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>convenios</code><div class='muted'>Params: —</div></td><td><code>&#x27;PublicConvenioController@index&#x27;</code></td><td></td><td>—</td></tr><tr><td><code>GET</code></td><td><code>convenios/iframe</code><div class='muted'>Params: —</div></td><td><code>&#x27;PublicConvenioController@iframe&#x27;</code></td><td></td><td>—</td></tr><tr><td><code>GET</code></td><td><code>beneficiario/login</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\BeneficiaryAuthController@showLoginForm&#x27;</code></td><td>beneficiary.login</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>beneficiario/login/submit</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\BeneficiaryAuthController@login&#x27;</code></td><td>beneficiary.login.submit</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>beneficiario/logout</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\BeneficiaryAuthController@logout&#x27;</code></td><td>beneficiary.logout</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryAreaController@index&#x27;</code></td><td>beneficiary.area.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/edit</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryAreaController@profileEdit&#x27;</code></td><td>beneficiary.area.profile.edit</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/update</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryAreaController@profileUpdate&#x27;</code></td><td>beneficiary.area.profile.update</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/dependents</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryAreaController@dependents&#x27;</code></td><td>beneficiary.area.dependent</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{plan}/details</code><div class='muted'>Params: <code>plan</code></div></td><td><code>&#x27;BeneficiaryAreaController@planDetails&#x27;</code></td><td>beneficiary.area.plan.details</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/telemedicine</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryAreaController@telemedicine&#x27;</code></td><td>beneficiary.area.telemedicine</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/telemedicine/redirect</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryAreaController@redirectToTelemedicine&#x27;</code></td><td>beneficiary.area.telemedicine.redirect</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/schedule</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryAreaController@schedules&#x27;</code></td><td>beneficiary.area.schedule</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/cancel</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryAreaController@cancel&#x27;</code></td><td>beneficiary.area.cancel</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/updatecreditcard</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryAreaController@updatecreditcard&#x27;</code></td><td>beneficiary.area.updatecreditcard</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>dependente/login</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\DependentAuthController@showLoginForm&#x27;</code></td><td>dependent.login</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>dependente/login</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\DependentAuthController@login&#x27;</code></td><td>dependent.login.submit</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>dependente/logout</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\DependentAuthController@logout&#x27;</code></td><td>dependent.logout</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;DependentAreaController@index&#x27;</code></td><td>dependent.area.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/edit</code><div class='muted'>Params: —</div></td><td><code>&#x27;DependentAreaController@profileEdit&#x27;</code></td><td>dependent.area.profile.edit</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/update</code><div class='muted'>Params: —</div></td><td><code>&#x27;DependentAreaController@profileUpdate&#x27;</code></td><td>dependent.area.profile.update</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{plan}/details</code><div class='muted'>Params: <code>plan</code></div></td><td><code>&#x27;DependentAreaController@planDetails&#x27;</code></td><td>dependent.area.plan.details</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/telemedicine</code><div class='muted'>Params: —</div></td><td><code>&#x27;DependentAreaController@telemedicine&#x27;</code></td><td>dependent.area.telemedicine</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/telemedicine/redirect</code><div class='muted'>Params: —</div></td><td><code>&#x27;DependentAreaController@redirectToTelemedicine&#x27;</code></td><td>dependent.area.telemedicine.redirect</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/schedule</code><div class='muted'>Params: —</div></td><td><code>&#x27;DependentAreaController@schedules&#x27;</code></td><td>dependent.area.schedules</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>{beneficiaryId}/create</code><div class='muted'>Params: <code>beneficiaryId</code></div></td><td><code>&#x27;DependentController@create&#x27;</code></td><td>dependent.create</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;DependentController@store&#x27;</code></td><td>dependent.store</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{dependent}/edit</code><div class='muted'>Params: <code>dependent</code></div></td><td><code>&#x27;DependentController@edit&#x27;</code></td><td>dependent.edit</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{dependent}/update</code><div class='muted'>Params: <code>dependent</code></div></td><td><code>&#x27;DependentController@update&#x27;</code></td><td>dependent.update</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{dependent}/delete</code><div class='muted'>Params: <code>dependent</code></div></td><td><code>&#x27;DependentController@softDelete&#x27;</code></td><td>dependent.softdelete</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{dependent}/show</code><div class='muted'>Params: <code>dependent</code></div></td><td><code>&#x27;DependentController@show&#x27;</code></td><td>dependent.show</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/beneficiaries/search</code><div class='muted'>Params: —</div></td><td><code>&#x27;Admin\CheckoutController@searchBeneficiary&#x27;</code></td><td>beneficiaries.search</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{uuid}/landing</code><div class='muted'>Params: <code>uuid</code></div></td><td><code>&#x27;Admin\CheckoutController@landingPage&#x27;</code></td><td>checkout.landing</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{uuid}/checkout</code><div class='muted'>Params: <code>uuid</code></div></td><td><code>&#x27;Admin\CheckoutController@checkout&#x27;</code></td><td>checkout.page</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/checkout/process</code><div class='muted'>Params: —</div></td><td><code>&#x27;Admin\CheckoutController@checkoutProcess&#x27;</code></td><td>checkout.process</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/checkout/confirmation/{invoiceUuid}</code><div class='muted'>Params: <code>invoiceUuid</code></div></td><td><code>&#x27;Admin\CheckoutController@checkoutConfirmation&#x27;</code></td><td>checkout.confirmation</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>{beneficiary}/store</code><div class='muted'>Params: <code>beneficiary</code></div></td><td><code>&#x27;BeneficiaryPlanController@store&#x27;</code></td><td>beneficiary.plan.store</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>{plan}/delete</code><div class='muted'>Params: <code>plan</code></div></td><td><code>&#x27;BeneficiaryPlanController@destroy&#x27;</code></td><td>beneficiary.plan.destroy</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/home</code><div class='muted'>Params: —</div></td><td><code>&#x27;HomeController@index&#x27;</code></td><td>admin.home</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>user</code><div class='muted'>Params: —</div></td><td><code>&#x27;UserController@index&#x27;</code></td><td>user.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>user/create</code><div class='muted'>Params: —</div></td><td><code>&#x27;UserController@create&#x27;</code></td><td>user.create</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>user/admin</code><div class='muted'>Params: —</div></td><td><code>&#x27;UserController@storeAdmin&#x27;</code></td><td>user.registro.admin</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>user/app</code><div class='muted'>Params: —</div></td><td><code>&#x27;UserController@storeApp&#x27;</code></td><td>user.registro.app</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>user/{user}/edit</code><div class='muted'>Params: <code>user</code></div></td><td><code>&#x27;UserController@edit&#x27;</code></td><td>user.edit</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>user</code><div class='muted'>Params: —</div></td><td><code>&#x27;UserController@update&#x27;</code></td><td>user.update</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>user/{user}</code><div class='muted'>Params: <code>user</code></div></td><td><code>&#x27;UserController@destroy&#x27;</code></td><td>user.destroy</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>profile</code><div class='muted'>Params: —</div></td><td><code>[&#x27;as&#x27; =&gt; &#x27;profile.edit&#x27;, &#x27;uses&#x27; =&gt; &#x27;ProfileController@edit&#x27;]</code></td><td></td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>profile</code><div class='muted'>Params: —</div></td><td><code>[&#x27;as&#x27; =&gt; &#x27;profile.update&#x27;, &#x27;uses&#x27; =&gt; &#x27;ProfileController@update&#x27;]</code></td><td></td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>profile/password</code><div class='muted'>Params: —</div></td><td><code>[&#x27;as&#x27; =&gt; &#x27;profile.password&#x27;, &#x27;uses&#x27; =&gt; &#x27;ProfileController@password&#x27;]</code></td><td></td><td>—</td></tr><tr><td><code>GET</code></td><td><code>delete/{id}</code><div class='muted'>Params: <code>id</code></div></td><td><code>&#x27;UserController@delete&#x27;</code></td><td>user.delete</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;CompanyController@index&#x27;</code></td><td>company.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/criar</code><div class='muted'>Params: —</div></td><td><code>&#x27;CompanyController@create&#x27;</code></td><td>company.form</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;CompanyController@store&#x27;</code></td><td>company.store</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{company}/show</code><div class='muted'>Params: <code>company</code></div></td><td><code>&#x27;CompanyController@show&#x27;</code></td><td>company.show</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{company}/edit</code><div class='muted'>Params: <code>company</code></div></td><td><code>&#x27;CompanyController@edit&#x27;</code></td><td>company.edit</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{company}/update</code><div class='muted'>Params: <code>company</code></div></td><td><code>&#x27;CompanyController@update&#x27;</code></td><td>company.update</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{company}/delete</code><div class='muted'>Params: <code>company</code></div></td><td><code>&#x27;CompanyController@softDelete&#x27;</code></td><td>company.softdelete</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/report</code><div class='muted'>Params: —</div></td><td><code>&#x27;CompanyController@report&#x27;</code></td><td>company.report</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>{company}/</code><div class='muted'>Params: <code>company</code></div></td><td><code>&#x27;PlanController@index&#x27;</code></td><td>plan.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>{company}/create</code><div class='muted'>Params: <code>company</code></div></td><td><code>&#x27;PlanController@create&#x27;</code></td><td>plan.create</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;PlanController@store&#x27;</code></td><td>plan.store</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{plan}/show</code><div class='muted'>Params: <code>plan</code></div></td><td><code>&#x27;PlanController@show&#x27;</code></td><td>plan.show</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{plan}/edit</code><div class='muted'>Params: <code>plan</code></div></td><td><code>&#x27;PlanController@edit&#x27;</code></td><td>plan.edit</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{plan}/update</code><div class='muted'>Params: <code>plan</code></div></td><td><code>&#x27;PlanController@update&#x27;</code></td><td>plan.update</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{plan}/destroy</code><div class='muted'>Params: <code>plan</code></div></td><td><code>&#x27;PlanController@destroy&#x27;</code></td><td>plan.destroy</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>{plan}/</code><div class='muted'>Params: <code>plan</code></div></td><td><code>&#x27;PlanConvenioController@index&#x27;</code></td><td>plan.convenience.index</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>{plan}/store</code><div class='muted'>Params: <code>plan</code></div></td><td><code>&#x27;PlanConvenioController@store&#x27;</code></td><td>plan.convenience.store</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>{plan_convenience}/destroy</code><div class='muted'>Params: <code>plan_convenience</code></div></td><td><code>&#x27;PlanConvenioController@destroy&#x27;</code></td><td>plan.convenience.destroy</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>{company}/</code><div class='muted'>Params: <code>company</code></div></td><td><code>&#x27;BeneficiaryController@index&#x27;</code></td><td>beneficiary.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>{company}/criar</code><div class='muted'>Params: <code>company</code></div></td><td><code>&#x27;BeneficiaryController@create&#x27;</code></td><td>beneficiary.form</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryController@store&#x27;</code></td><td>beneficiary.store</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{beneficiary}/delete</code><div class='muted'>Params: <code>beneficiary</code></div></td><td><code>&#x27;BeneficiaryController@softDelete&#x27;</code></td><td>beneficiary.softdelete</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{beneficiary}/show</code><div class='muted'>Params: <code>beneficiary</code></div></td><td><code>&#x27;BeneficiaryController@show&#x27;</code></td><td>beneficiary.show</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{beneficiary}/edit</code><div class='muted'>Params: <code>beneficiary</code></div></td><td><code>&#x27;BeneficiaryController@edit&#x27;</code></td><td>beneficiary.edit</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{beneficiary}/update</code><div class='muted'>Params: <code>beneficiary</code></div></td><td><code>&#x27;BeneficiaryController@update&#x27;</code></td><td>beneficiary.update</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/import</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryController@importExcel&#x27;</code></td><td>beneficiary.import</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>{beneficiaryId}/dependents</code><div class='muted'>Params: <code>beneficiaryId</code></div></td><td><code>&#x27;DependentController@index&#x27;</code></td><td>dependent.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryController@generalIndex&#x27;</code></td><td>beneficiary.general.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/removed</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryController@deleteIndex&#x27;</code></td><td>beneficiary.delete.index</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{beneficiary}/destroy</code><div class='muted'>Params: <code>beneficiary</code></div></td><td><code>&#x27;BeneficiaryController@destroy&#x27;</code></td><td>beneficiary.destroy</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/destroy/all</code><div class='muted'>Params: —</div></td><td><code>&#x27;BeneficiaryController@destroyAll&#x27;</code></td><td>beneficiary.destroy.all</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;ConveniosCategoriaController@index&#x27;</code></td><td>convenio.categoria.index</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;ConveniosCategoriaController@store&#x27;</code></td><td>convenio.categoria.store</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{categoria}</code><div class='muted'>Params: <code>categoria</code></div></td><td><code>&#x27;ConveniosCategoriaController@softDelete&#x27;</code></td><td>convenio.categoria.softdelete</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/convenio/categoria/store-ajax</code><div class='muted'>Params: —</div></td><td><code>&#x27;ConveniosCategoriaController@storeAjax&#x27;</code></td><td>convenio.categoria.store_ajax</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;ConvenioTypeController@index&#x27;</code></td><td>convenio.type.index</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;ConvenioTypeController@store&#x27;</code></td><td>convenio.type.store</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>{type}/destroy</code><div class='muted'>Params: <code>type</code></div></td><td><code>&#x27;ConvenioTypeController@destroy&#x27;</code></td><td>convenio.type.destroy</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store-ajax</code><div class='muted'>Params: —</div></td><td><code>&#x27;ConvenioTypeController@storeAjax&#x27;</code></td><td>convenio.type.store.ajax</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;ConvenioController@index&#x27;</code></td><td>convenio.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/create</code><div class='muted'>Params: —</div></td><td><code>&#x27;ConvenioController@create&#x27;</code></td><td>convenio.create</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;ConvenioController@store&#x27;</code></td><td>convenio.store</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{convenio}/show</code><div class='muted'>Params: <code>convenio</code></div></td><td><code>&#x27;ConvenioController@show&#x27;</code></td><td>convenio.show</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{convenio}/view_edit</code><div class='muted'>Params: <code>convenio</code></div></td><td><code>&#x27;ConvenioController@view_edit&#x27;</code></td><td>convenio.view_edit</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{convenio}/update</code><div class='muted'>Params: <code>convenio</code></div></td><td><code>&#x27;ConvenioController@update&#x27;</code></td><td>convenio.update</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{convenio}/delete</code><div class='muted'>Params: <code>convenio</code></div></td><td><code>&#x27;ConvenioController@delete&#x27;</code></td><td>convenio.delete</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;PartnerController@index&#x27;</code></td><td>partner.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/create</code><div class='muted'>Params: —</div></td><td><code>&#x27;PartnerController@create&#x27;</code></td><td>partner.create</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;PartnerController@store&#x27;</code></td><td>partner.store</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{partner}/edit</code><div class='muted'>Params: <code>partner</code></div></td><td><code>&#x27;PartnerController@edit&#x27;</code></td><td>partner.edit</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{partner}/update</code><div class='muted'>Params: <code>partner</code></div></td><td><code>&#x27;PartnerController@update&#x27;</code></td><td>partner.update</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{partner}/show</code><div class='muted'>Params: <code>partner</code></div></td><td><code>&#x27;PartnerController@show&#x27;</code></td><td>partner.show</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{partner}/delete</code><div class='muted'>Params: <code>partner</code></div></td><td><code>&#x27;PartnerController@softDelete&#x27;</code></td><td>partner.softdelete</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>{partner}/store</code><div class='muted'>Params: <code>partner</code></div></td><td><code>&#x27;PartnerCompanyController@store&#x27;</code></td><td>partner.indication.store</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>{indication}/delete</code><div class='muted'>Params: <code>indication</code></div></td><td><code>&#x27;PartnerCompanyController@destroy&#x27;</code></td><td>partner.indication.destroy</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;FinancialController@index&#x27;</code></td><td>financial.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/print</code><div class='muted'>Params: —</div></td><td><code>&#x27;FinancialController@print&#x27;</code></td><td>financial.print</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;FinancialController@store&#x27;</code></td><td>financial.store</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>{id}</code><div class='muted'>Params: <code>id</code></div></td><td><code>&#x27;FinancialController@update&#x27;</code></td><td>financial.update</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>{id}</code><div class='muted'>Params: <code>id</code></div></td><td><code>&#x27;FinancialController@destroy&#x27;</code></td><td>financial.destroy</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;CaixaController@index&#x27;</code></td><td>caixa.index</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;CaixaController@store&#x27;</code></td><td>caixa.store</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{caixa}/update</code><div class='muted'>Params: <code>caixa</code></div></td><td><code>&#x27;CaixaController@update&#x27;</code></td><td>caixa.update</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{caixa}/delete</code><div class='muted'>Params: <code>caixa</code></div></td><td><code>&#x27;CaixaController@softDelete&#x27;</code></td><td>caixa.delete</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;CostCenterController@index&#x27;</code></td><td>costcenter.index</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;CostCenterController@store&#x27;</code></td><td>costcenter.store</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{costcenter}/update</code><div class='muted'>Params: <code>costcenter</code></div></td><td><code>&#x27;CostCenterController@update&#x27;</code></td><td>costcenter.update</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{costcenter}/delete</code><div class='muted'>Params: <code>costcenter</code></div></td><td><code>&#x27;CostCenterController@delete&#x27;</code></td><td>costcenter.delete</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;ContaPagarController@index&#x27;</code></td><td>conta_pagar.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/create</code><div class='muted'>Params: —</div></td><td><code>&#x27;ContaPagarController@create&#x27;</code></td><td>conta_pagar.create</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;ContaPagarController@store&#x27;</code></td><td>conta_pagar.store</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{conta}/show</code><div class='muted'>Params: <code>conta</code></div></td><td><code>&#x27;ContaPagarController@show&#x27;</code></td><td>conta_pagar.show</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{conta}/view_edit</code><div class='muted'>Params: <code>conta</code></div></td><td><code>&#x27;ContaPagarController@view_edit&#x27;</code></td><td>conta_pagar.view_edit</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{conta}/update</code><div class='muted'>Params: <code>conta</code></div></td><td><code>&#x27;ContaPagarController@update&#x27;</code></td><td>conta_pagar.update</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{conta}/delete</code><div class='muted'>Params: <code>conta</code></div></td><td><code>&#x27;ContaPagarController@softDelete&#x27;</code></td><td>conta_pagar.softdelete</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>{conta}/pay</code><div class='muted'>Params: <code>conta</code></div></td><td><code>&#x27;ContaPagarController@pay&#x27;</code></td><td>conta_pagar.pay</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;ContaReceberController@index&#x27;</code></td><td>conta_receber.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/create</code><div class='muted'>Params: —</div></td><td><code>&#x27;ContaReceberController@create&#x27;</code></td><td>conta_receber.create</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;ContaReceberController@store&#x27;</code></td><td>conta_receber.store</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{conta}/view_edit</code><div class='muted'>Params: <code>conta</code></div></td><td><code>&#x27;ContaReceberController@view_edit&#x27;</code></td><td>conta_receber.view_edit</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/{conta}/show</code><div class='muted'>Params: <code>conta</code></div></td><td><code>&#x27;ContaReceberController@show&#x27;</code></td><td>conta_receber.show</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{conta}/update</code><div class='muted'>Params: <code>conta</code></div></td><td><code>&#x27;ContaReceberController@update&#x27;</code></td><td>conta_receber.update</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>{conta}/delete</code><div class='muted'>Params: <code>conta</code></div></td><td><code>&#x27;ContaReceberController@softDelete&#x27;</code></td><td>conta_receber.softdelete</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>{conta}/pay</code><div class='muted'>Params: <code>conta</code></div></td><td><code>&#x27;ContaReceberController@pay&#x27;</code></td><td>conta_receber.pay</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;ProdutoCategoriasController@index&#x27;</code></td><td>produtos.categorias.index</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;ProdutoCategoriasController@store&#x27;</code></td><td>produtos.categorias.store</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{categoria}/delete</code><div class='muted'>Params: <code>categoria</code></div></td><td><code>&#x27;ProdutoCategoriasController@softDelete&#x27;</code></td><td>produtos.categorias.softdelete</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;ProdutoUnidadeController@index&#x27;</code></td><td>produtos.unidades.index</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;ProdutoUnidadeController@store&#x27;</code></td><td>produtos.unidades.store</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{unidade}/update</code><div class='muted'>Params: <code>unidade</code></div></td><td><code>&#x27;ProdutoUnidadeController@update&#x27;</code></td><td>produtos.unidades.update</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{unidade}/delete</code><div class='muted'>Params: <code>unidade</code></div></td><td><code>&#x27;ProdutoUnidadeController@softDelete&#x27;</code></td><td>produtos.unidades.softdelete</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;ProdutoGrupoController@index&#x27;</code></td><td>produtos.grupos.index</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/store</code><div class='muted'>Params: —</div></td><td><code>&#x27;ProdutoGrupoController@store&#x27;</code></td><td>produtos.grupos.store</td><td>—</td></tr><tr><td><code>PUT</code></td><td><code>/{grupo}/update</code><div class='muted'>Params: <code>grupo</code></div></td><td><code>&#x27;ProdutoGrupoController@update&#x27;</code></td><td>produtos.grupos.update</td><td>—</td></tr><tr><td><code>DELETE</code></td><td><code>/{grupo}/delete</code><div class='muted'>Params: <code>grupo</code></div></td><td><code>&#x27;ProdutoGrupoController@softDelete&#x27;</code></td><td>produtos.grupos.softdelete</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/</code><div class='muted'>Params: —</div></td><td><code>&#x27;ProdutoController@index&#x27;</code></td><td>produtos.index</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/create</code><div class='muted'>Params: —</div></td><td><code>&#x27;ProdutoController@create&#x27;</code></td><td>produtos.create</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>login</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\LoginController@showLoginForm&#x27;</code></td><td>login</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>login</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\LoginController@login&#x27;</code></td><td></td><td>—</td></tr><tr><td><code>POST</code></td><td><code>logout</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\LoginController@logout&#x27;</code></td><td>logout</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>password/reset</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\ForgotPasswordController@showLinkRequestForm&#x27;</code></td><td>password.request</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>password/email</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\ForgotPasswordController@sendResetLinkEmail&#x27;</code></td><td>password.email</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>password/reset/{token}</code><div class='muted'>Params: <code>token</code></div></td><td><code>&#x27;Auth\ResetPasswordController@showResetForm&#x27;</code></td><td>password.reset</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>password/reset</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\ResetPasswordController@reset&#x27;</code></td><td>password.update</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>password/confirm</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\ConfirmPasswordController@showConfirmForm&#x27;</code></td><td>password.confirm</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>password/confirm</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\ConfirmPasswordController@confirm&#x27;</code></td><td></td><td>—</td></tr><tr><td><code>GET</code></td><td><code>email/verify</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\VerificationController@show&#x27;</code></td><td>verification.notice</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>email/verify/{id}/{hash}</code><div class='muted'>Params: <code>id</code>, <code>hash</code></div></td><td><code>&#x27;Auth\VerificationController@verify&#x27;</code></td><td>verification.verify</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>email/resend</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\VerificationController@resend&#x27;</code></td><td>verification.resend</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/password/forgot/form</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\AuthController@showForgotForm&#x27;</code></td><td>forgot.form.password</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/password/forgot/beneficiary/form</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\AuthController@showForgotFormBeneficiary&#x27;</code></td><td>forgot.form.beneficiary.password</td><td>—</td></tr><tr><td><code>POST</code></td><td><code>/password/forgot</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\AuthController@forgotPassword&#x27;</code></td><td>forgot.password</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/password/reset</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\AuthController@showResetForm&#x27;</code></td><td>reset.form.password</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/password/reset</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\AuthController@resetPassword&#x27;</code></td><td>update.password</td><td>—</td></tr><tr><td><code>GET</code></td><td><code>/confirm/email</code><div class='muted'>Params: —</div></td><td><code>&#x27;Auth\AuthController@confirm&#x27;</code></td><td>confirm.email</td><td>—</td></tr></tbody></table></div>
    <div class="hint"><strong>Ágil Desenvolvimento de Sistemas</strong> — responsável pelo desenvolvimento, arquitetura, integrações, manutenção e evolução contínua deste sistema.</div>
  </section>

  <section class="page" data-title="Rotas — API">
    <h2>Rotas — API</h2>
    <h3>routes/api.php</h3><div class='muted'>Nenhuma rota detectada.</div>
    <div class="hint"><strong>Ágil Desenvolvimento de Sistemas</strong> — responsável pelo desenvolvimento, arquitetura, integrações, manutenção e evolução contínua deste sistema.</div>
  </section>

  <section class="page" data-title="Controllers (funções e entradas)">
    <h2>Controllers (funções e entradas)</h2>
    
        <div class="card">
          <div class="card-title"><strong>AuthController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Auth</code> · <code>app/Http/Controllers/Auth/AuthController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>showForgotForm</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>showForgotForm()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>email</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:emails.new_password</code>, <code>view:pages.auth.confirm</code>, <code>view:pages.auth.forgot</code>, <code>view:pages.auth.forgotBeneficiary</code>, <code>view:pages.auth.reset</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>showForgotFormBeneficiary</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>showForgotFormBeneficiary()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>email</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:emails.new_password</code>, <code>view:pages.auth.confirm</code>, <code>view:pages.auth.forgotBeneficiary</code>, <code>view:pages.auth.reset</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>confirm</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>confirm()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>email</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:emails.new_password</code>, <code>view:pages.auth.confirm</code>, <code>view:pages.auth.reset</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>forgotPassword</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>forgotPassword(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>email</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:emails.new_password</code>, <code>view:pages.auth.reset</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>showResetForm</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>showResetForm(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>email</code>, <code>password</code>, <code>token</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.auth.reset</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>resetPassword</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>resetPassword(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>email</code>, <code>password</code>, <code>token</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:emails.new_password</code>, <code>view:pages.auth.reset</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>BeneficiaryAreaController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Beneficiary</code> · <code>app/Http/Controllers/Beneficiary/BeneficiaryAreaController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>birth_date</code>, <code>email</code>, <code>password</code>, <code>phone</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.area.dependents</code>, <code>view:pages.beneficiaries.area.edit</code>, <code>view:pages.beneficiaries.area.index</code>, <code>view:pages.beneficiaries.area.planDetails</code>, <code>view:pages.beneficiaries.area.schedules</code>, <code>view:pages.beneficiaries.area.telemedicine</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>profileEdit</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>profileEdit()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>birth_date</code>, <code>email</code>, <code>password</code>, <code>phone</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.area.dependents</code>, <code>view:pages.beneficiaries.area.edit</code>, <code>view:pages.beneficiaries.area.planDetails</code>, <code>view:pages.beneficiaries.area.schedules</code>, <code>view:pages.beneficiaries.area.telemedicine</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>profileUpdate</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>profileUpdate(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>birth_date</code>, <code>email</code>, <code>password</code>, <code>phone</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.area.dependents</code>, <code>view:pages.beneficiaries.area.planDetails</code>, <code>view:pages.beneficiaries.area.schedules</code>, <code>view:pages.beneficiaries.area.telemedicine</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>planDetails</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>planDetails($planId)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>hour</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.area.dependents</code>, <code>view:pages.beneficiaries.area.planDetails</code>, <code>view:pages.beneficiaries.area.schedules</code>, <code>view:pages.beneficiaries.area.telemedicine</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>updateCreditCard</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>updateCreditCard(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>hour</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.area.dependents</code>, <code>view:pages.beneficiaries.area.schedules</code>, <code>view:pages.beneficiaries.area.telemedicine</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>telemedicine</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>telemedicine(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>hour</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.area.dependents</code>, <code>view:pages.beneficiaries.area.schedules</code>, <code>view:pages.beneficiaries.area.telemedicine</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>redirectToTelemedicine</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>redirectToTelemedicine(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>hour</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.area.dependents</code>, <code>view:pages.beneficiaries.area.schedules</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>dependents</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>dependents()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.area.dependents</code>, <code>view:pages.beneficiaries.area.schedules</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>schedules</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>schedules()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.area.schedules</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>cancel</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>cancel(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>BeneficiaryAuthController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Auth</code> · <code>app/Http/Controllers/Auth/BeneficiaryAuthController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>showLoginForm</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>showLoginForm()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>email</code>, <code>password</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.auth.login</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>login</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>login(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>email</code>, <code>password</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>logout</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>logout(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>BeneficiaryController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/BeneficiaryController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index($company, PlanStatusService $planStatusService)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cpf</code>, <code>excel_file</code>, <code>excel_file.file</code>, <code>excel_file.max</code>, <code>excel_file.mimes</code>, <code>excel_file.required</code>, <code>name</code>, <code>plan_id</code>, <code>plan_id.required</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.create</code>, <code>view:pages.beneficiaries.edit</code>, <code>view:pages.beneficiaries.general.index</code>, <code>view:pages.beneficiaries.general.indexDelete</code>, <code>view:pages.beneficiaries.index</code>, <code>view:pages.beneficiaries.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>create</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>create($company)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cpf</code>, <code>excel_file</code>, <code>excel_file.file</code>, <code>excel_file.max</code>, <code>excel_file.mimes</code>, <code>excel_file.required</code>, <code>name</code>, <code>plan_id</code>, <code>plan_id.required</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.create</code>, <code>view:pages.beneficiaries.edit</code>, <code>view:pages.beneficiaries.general.index</code>, <code>view:pages.beneficiaries.general.indexDelete</code>, <code>view:pages.beneficiaries.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cpf</code>, <code>excel_file</code>, <code>excel_file.file</code>, <code>excel_file.max</code>, <code>excel_file.mimes</code>, <code>excel_file.required</code>, <code>name</code>, <code>plan_id</code>, <code>plan_id.required</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.edit</code>, <code>view:pages.beneficiaries.general.index</code>, <code>view:pages.beneficiaries.general.indexDelete</code>, <code>view:pages.beneficiaries.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>show</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>show($beneficiary)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cpf</code>, <code>excel_file</code>, <code>excel_file.file</code>, <code>excel_file.max</code>, <code>excel_file.mimes</code>, <code>excel_file.required</code>, <code>name</code>, <code>plan_id</code>, <code>plan_id.required</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.edit</code>, <code>view:pages.beneficiaries.general.index</code>, <code>view:pages.beneficiaries.general.indexDelete</code>, <code>view:pages.beneficiaries.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>edit</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>edit($beneficiary)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cpf</code>, <code>excel_file</code>, <code>excel_file.file</code>, <code>excel_file.max</code>, <code>excel_file.mimes</code>, <code>excel_file.required</code>, <code>name</code>, <code>plan_id</code>, <code>plan_id.required</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.edit</code>, <code>view:pages.beneficiaries.general.index</code>, <code>view:pages.beneficiaries.general.indexDelete</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $beneficiary)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cpf</code>, <code>excel_file</code>, <code>excel_file.file</code>, <code>excel_file.max</code>, <code>excel_file.mimes</code>, <code>excel_file.required</code>, <code>name</code>, <code>plan_id</code>, <code>plan_id.required</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.general.index</code>, <code>view:pages.beneficiaries.general.indexDelete</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>softDelete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>softDelete($beneficiary)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cpf</code>, <code>excel_file</code>, <code>excel_file.file</code>, <code>excel_file.max</code>, <code>excel_file.mimes</code>, <code>excel_file.required</code>, <code>name</code>, <code>plan_id</code>, <code>plan_id.required</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.general.index</code>, <code>view:pages.beneficiaries.general.indexDelete</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>importExcel</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>importExcel(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cpf</code>, <code>excel_file</code>, <code>excel_file.file</code>, <code>excel_file.max</code>, <code>excel_file.mimes</code>, <code>excel_file.required</code>, <code>name</code>, <code>plan_id</code>, <code>plan_id.required</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.general.index</code>, <code>view:pages.beneficiaries.general.indexDelete</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>generalIndex</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>generalIndex(Request $request, PlanStatusService $planStatusService)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cpf</code>, <code>name</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.general.index</code>, <code>view:pages.beneficiaries.general.indexDelete</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>deleteIndex</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>deleteIndex(Request $request, PlanStatusService $planStatusService)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cpf</code>, <code>name</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.beneficiaries.general.indexDelete</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>destroy</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>destroy($beneficiary)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>destroyAll</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>destroyAll()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>BeneficiaryPlanController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/BeneficiaryPlanController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request, $beneficiary)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>plan_id</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>destroy</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>destroy($plan)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>CaixaController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/CaixaController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code>, <code>obs</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.caixas.index</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code>, <code>obs</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $caixa)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code>, <code>obs</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>softDelete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>softDelete($caixa)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>CheckoutController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/CheckoutController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>landingPage</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>landingPage($uuid = null)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.checkout.confirmation</code>, <code>view:pages.checkout.index</code>, <code>view:pages.checkout.landingPage</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>checkout</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>checkout($uuid)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.checkout.confirmation</code>, <code>view:pages.checkout.index</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>checkoutProcess</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>checkoutProcess(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.checkout.confirmation</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>checkoutConfirmation</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>checkoutConfirmation($invoiceUuid)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>view:pages.checkout.confirmation</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>CompanyController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/CompanyController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.companies.create</code>, <code>view:pages.companies.edit</code>, <code>view:pages.companies.index</code>, <code>view:pages.companies.report</code>, <code>view:pages.companies.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>create</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>create()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.companies.create</code>, <code>view:pages.companies.edit</code>, <code>view:pages.companies.report</code>, <code>view:pages.companies.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.companies.edit</code>, <code>view:pages.companies.report</code>, <code>view:pages.companies.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>show</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>show($company)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.companies.edit</code>, <code>view:pages.companies.report</code>, <code>view:pages.companies.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>edit</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>edit($company)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.companies.edit</code>, <code>view:pages.companies.report</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $company)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.companies.report</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>softDelete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>softDelete($company)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.companies.report</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>report</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>report()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>view:pages.companies.report</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ConfirmPasswordController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Auth</code> · <code>app/Http/Controllers/Auth/ConfirmPasswordController.php</code></div>
            <div class='muted'>Nenhum método público encontrado.</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ContaPagarController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/ContaPagarController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>cost_center_id</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.contaspagar.index</code>, <code>view:pages.contaspagar.show</code>, <code>view:pages.contaspagar.view_edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>create</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>create()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>cost_center_id</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.contaspagar.show</code>, <code>view:pages.contaspagar.view_edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>cost_center_id</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.contaspagar.show</code>, <code>view:pages.contaspagar.view_edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>show</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>show($conta)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>cost_center_id</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.contaspagar.show</code>, <code>view:pages.contaspagar.view_edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>view_edit</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>view_edit($conta)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>cost_center_id</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.contaspagar.view_edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $conta)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>cost_center_id</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>softDelete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>softDelete($conta)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>pay</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>pay($conta)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ContaReceberController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/ContaReceberController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>plano_contas_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.contasreceber.index</code>, <code>view:pages.contasreceber.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>create</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>create()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>plano_contas_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.contasreceber.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>plano_contas_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.contasreceber.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>show</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>show($conta)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>plano_contas_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.contasreceber.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>view_edit</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>view_edit($conta)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>plano_contas_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $conta)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo</code>, <code>documento</code>, <code>emissao</code>, <code>juros</code>, <code>multa</code>, <code>obs</code>, <code>pagamento</code>, <code>partner_id</code>, <code>plano_contas_id</code>, <code>status_autorizacao</code>, <code>tipo_baixa</code>, <code>tipo_juros</code>, <code>valor</code>, <code>valor_desconto</code>, <code>valor_pago</code>, <code>valor_pago_juros_multa</code>, <code>vencimento</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>softDelete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>softDelete($conta)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>pay</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>pay($conta)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>Controller</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers</code> · <code>app/Http/Controllers/Controller.php</code></div>
            <div class='muted'>Nenhum método público encontrado.</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ConvenioController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/ConvenioController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>categoria_id</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.convenios.create</code>, <code>view:pages.convenios.index</code>, <code>view:pages.convenios.show</code>, <code>view:pages.convenios.view_edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>create</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>create()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.convenios.create</code>, <code>view:pages.convenios.show</code>, <code>view:pages.convenios.view_edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.convenios.show</code>, <code>view:pages.convenios.view_edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>view_edit</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>view_edit($convenio)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.convenios.show</code>, <code>view:pages.convenios.view_edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $convenio)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.convenios.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>show</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>show($convenio)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.convenios.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>delete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>delete($convenio)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ConvenioTypeController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/ConvenioTypeController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>name</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code>, <code>redirect</code>, <code>view:pages.convenios_tipos.index</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>name</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code>, <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>destroy</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>destroy($type)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>name</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code>, <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>storeAjax</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>storeAjax(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>name</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ConveniosCategoriaController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/ConveniosCategoriaController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code>, <code>nome</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code>, <code>redirect</code>, <code>view:pages.convenios_categorias.index</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code>, <code>nome</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code>, <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>softDelete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>softDelete($categoria)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>nome</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code>, <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>storeAjax</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>storeAjax(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>nome</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>CostCenterController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/CostCenterController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>codigo_conta</code>, <code>codigo_reduzido</code>, <code>descricao</code>, <code>tipo</code>, <code>usuario_id</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.costcenters.index</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>codigo_conta</code>, <code>codigo_reduzido</code>, <code>descricao</code>, <code>tipo</code>, <code>usuario_id</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $costCenter)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>codigo_conta</code>, <code>codigo_reduzido</code>, <code>descricao</code>, <code>tipo</code>, <code>usuario_id</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>delete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>delete(Request $request, $costCenter)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>DependentAreaController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Dependent</code> · <code>app/Http/Controllers/Dependent/DependentAreaController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>hour</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.dependents.area.edit</code>, <code>view:pages.dependents.area.index</code>, <code>view:pages.dependents.area.schedules</code>, <code>view:pages.dependents.area.telemedicine</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>telemedicine</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>telemedicine(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>hour</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.dependents.area.edit</code>, <code>view:pages.dependents.area.schedules</code>, <code>view:pages.dependents.area.telemedicine</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>redirectToTelemedicine</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>redirectToTelemedicine(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>hour</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.dependents.area.edit</code>, <code>view:pages.dependents.area.schedules</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>schedules</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>schedules()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>birth_date</code>, <code>email</code>, <code>password</code>, <code>phone</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.dependents.area.edit</code>, <code>view:pages.dependents.area.schedules</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>profileEdit</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>profileEdit()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>birth_date</code>, <code>email</code>, <code>password</code>, <code>phone</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.dependents.area.edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>profileUpdate</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>profileUpdate(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>birth_date</code>, <code>email</code>, <code>password</code>, <code>phone</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>DependentAuthController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Auth</code> · <code>app/Http/Controllers/Auth/DependentAuthController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>showLoginForm</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>showLoginForm()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>email</code>, <code>password</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.dependents.auth.login</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>login</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>login(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>email</code>, <code>password</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>logout</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>logout(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>DependentController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/DependentController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index($beneficiaryId)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>beneficiary_id</code>, <code>birth_date</code>, <code>cpf</code>, <code>email</code>, <code>gender</code>, <code>name</code>, <code>password</code>, <code>phone</code>, <code>relationship</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:emails.dependent-access</code>, <code>view:pages.dependents.create</code>, <code>view:pages.dependents.edit</code>, <code>view:pages.dependents.index</code>, <code>view:pages.dependents.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>create</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>create($beneficiaryId)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>beneficiary_id</code>, <code>birth_date</code>, <code>cpf</code>, <code>email</code>, <code>gender</code>, <code>name</code>, <code>password</code>, <code>phone</code>, <code>relationship</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:emails.dependent-access</code>, <code>view:pages.dependents.create</code>, <code>view:pages.dependents.edit</code>, <code>view:pages.dependents.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>beneficiary_id</code>, <code>birth_date</code>, <code>cpf</code>, <code>email</code>, <code>gender</code>, <code>name</code>, <code>password</code>, <code>phone</code>, <code>relationship</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:emails.dependent-access</code>, <code>view:pages.dependents.edit</code>, <code>view:pages.dependents.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>show</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>show($dependent)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>birth_date</code>, <code>cpf</code>, <code>cpf.unique</code>, <code>email</code>, <code>email.unique</code>, <code>gender</code>, <code>name</code>, <code>password</code>, <code>phone</code>, <code>relationship</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.dependents.edit</code>, <code>view:pages.dependents.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>edit</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>edit($dependent)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>birth_date</code>, <code>cpf</code>, <code>cpf.unique</code>, <code>email</code>, <code>email.unique</code>, <code>gender</code>, <code>name</code>, <code>password</code>, <code>phone</code>, <code>relationship</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.dependents.edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $dependent)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>birth_date</code>, <code>cpf</code>, <code>cpf.unique</code>, <code>email</code>, <code>email.unique</code>, <code>gender</code>, <code>name</code>, <code>password</code>, <code>phone</code>, <code>relationship</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>softDelete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>softDelete($dependent)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>FinancialController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/FinancialController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo_id</code>, <code>data_fim</code>, <code>data_hora_evento</code>, <code>data_inicio</code>, <code>descricao</code>, <code>tipo</code>, <code>valor</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.financeiro.index</code>, <code>view:pages.financeiro.print</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo_id</code>, <code>data_fim</code>, <code>data_hora_evento</code>, <code>data_inicio</code>, <code>descricao</code>, <code>tipo</code>, <code>valor</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.financeiro.print</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, int $id)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>caixa_id</code>, <code>centro_custo_id</code>, <code>data_fim</code>, <code>data_hora_evento</code>, <code>data_inicio</code>, <code>descricao</code>, <code>tipo</code>, <code>valor</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>view:pages.financeiro.print</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>destroy</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>destroy(int $id)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>centro_custo_id</code>, <code>data_fim</code>, <code>data_inicio</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>view:pages.financeiro.print</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>print</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>print(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>centro_custo_id</code>, <code>data_fim</code>, <code>data_inicio</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>view:pages.financeiro.print</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ForgotPasswordController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Auth</code> · <code>app/Http/Controllers/Auth/ForgotPasswordController.php</code></div>
            <div class='muted'>Nenhum método público encontrado.</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>HomeController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/HomeController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>view:pages.dashboard</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>LoginController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Auth</code> · <code>app/Http/Controllers/Auth/LoginController.php</code></div>
            <div class='muted'>Nenhum método público encontrado.</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>PartnerCompanyController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/PartnerCompanyController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request, $partner)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>company_id</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>destroy</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>destroy($indication)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>PartnerController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/PartnerController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cnpj</code>, <code>cost_center_id</code>, <code>description</code>, <code>email</code>, <code>name</code>, <code>phone</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.partners.create</code>, <code>view:pages.partners.edit</code>, <code>view:pages.partners.index</code>, <code>view:pages.partners.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>create</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>create()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cnpj</code>, <code>cost_center_id</code>, <code>description</code>, <code>email</code>, <code>name</code>, <code>phone</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.partners.create</code>, <code>view:pages.partners.edit</code>, <code>view:pages.partners.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cnpj</code>, <code>cost_center_id</code>, <code>description</code>, <code>email</code>, <code>name</code>, <code>phone</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.partners.edit</code>, <code>view:pages.partners.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>edit</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>edit($partner)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cnpj</code>, <code>cost_center_id</code>, <code>description</code>, <code>email</code>, <code>name</code>, <code>phone</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.partners.edit</code>, <code>view:pages.partners.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $partner)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>cnpj</code>, <code>cost_center_id</code>, <code>description</code>, <code>email</code>, <code>name</code>, <code>phone</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.partners.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>show</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>show($partner)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.partners.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>softDelete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>softDelete($partner)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>PlanController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/PlanController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index($company)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>company_id</code>, <code>description</code>, <code>is_telemedicine</code>, <code>name</code>, <code>value</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.plans.create</code>, <code>view:pages.plans.edit</code>, <code>view:pages.plans.index</code>, <code>view:pages.plans.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>create</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>create($company)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>company_id</code>, <code>description</code>, <code>is_telemedicine</code>, <code>name</code>, <code>value</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.plans.create</code>, <code>view:pages.plans.edit</code>, <code>view:pages.plans.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>company_id</code>, <code>description</code>, <code>is_telemedicine</code>, <code>name</code>, <code>value</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.plans.edit</code>, <code>view:pages.plans.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>show</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>show($plan)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>description</code>, <code>is_telemedicine</code>, <code>name</code>, <code>value</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.plans.edit</code>, <code>view:pages.plans.show</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>edit</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>edit($plan)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>description</code>, <code>is_telemedicine</code>, <code>name</code>, <code>value</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.plans.edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $plan)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>description</code>, <code>is_telemedicine</code>, <code>name</code>, <code>value</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>destroy</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>destroy($plan)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>PlanConvenioController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/PlanConvenioController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index($plan)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>convenio_id</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.plans.conveniences</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request, $plan)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>convenio_id</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>destroy</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>destroy($plan_convenience)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ProdutoCategoriasController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/ProdutoCategoriasController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code>, <code>redirect</code>, <code>view:pages.produtos.categorias.index</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code>, <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>softDelete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>softDelete($categoria)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>nome</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code>, <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>storeAjax</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>storeAjax(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>nome</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>json</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ProdutoController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/ProdutoController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>view:pages.produtos.create</code>, <code>view:pages.produtos.index</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>create</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>create()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>view:pages.produtos.create</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ProdutoGrupoController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/ProdutoGrupoController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.produtos.grupos.index</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $grupo)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>softDelete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>softDelete($grupo)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ProdutoUnidadeController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/ProdutoUnidadeController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code>, <code>sigla</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.produtos.unidades.index</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>store</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>store(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code>, <code>sigla</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request, $unidade)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>descricao</code>, <code>sigla</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>softDelete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>softDelete($unidade)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ProfileController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/ProfileController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>edit</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>edit()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>password</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>view:pages.profile.edit</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(ProfileRequest $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>password</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> —</div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>password</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>password(PasswordRequest $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> <code>password</code></div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> —</div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>PublicConvenioController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers</code> · <code>app/Http/Controllers/PublicConvenioController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>view:public.convenios</code>, <code>view:public.convenios-iframe</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>iframe</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>iframe()</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>view:public.convenios-iframe</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>RegisterController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Auth</code> · <code>app/Http/Controllers/Auth/RegisterController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>validator</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>validator(array $data)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> —</div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>create</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>create(array $data)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> —</div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>ResetPasswordController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Auth</code> · <code>app/Http/Controllers/Auth/ResetPasswordController.php</code></div>
            <div class='muted'>Nenhum método público encontrado.</div>
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>UserController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Admin</code> · <code>app/Http/Controllers/Admin/UserController.php</code></div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>index</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>index(User $model)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code>, <code>view:pages.users.index</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>delete</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>delete($id)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>storeAdmin</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>storeAdmin(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>storeApp</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>storeApp(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
              <div class="card" style="margin:10px 0 0">
                <div class="card-title"><strong>update</strong> <span class="pill"></span></div>
                <div class="card-body">
                  <div><strong>Assinatura:</strong> <code>update(Request $request)</code></div>
                  <div style="margin-top:6px"><strong>Entradas (inferidas):</strong> —</div>
                  <div style="margin-top:6px"><strong>Saídas (inferidas):</strong> <code>redirect</code></div>
                </div>
              </div>
            
          </div>
        </div>
        
        <div class="card">
          <div class="card-title"><strong>VerificationController</strong></div>
          <div class="card-body">
            <div class="muted"><code>App\Http\Controllers\Auth</code> · <code>app/Http/Controllers/Auth/VerificationController.php</code></div>
            <div class='muted'>Nenhum método público encontrado.</div>
          </div>
        </div>
        
    <div class="hint"><strong>Ágil Desenvolvimento de Sistemas</strong> — responsável pelo desenvolvimento, arquitetura, integrações, manutenção e evolução contínua deste sistema.</div>
  </section>

  <section class="page" data-title="Views (páginas) — variáveis">
    <h2>Views (páginas) — variáveis</h2>
    <div class="table-wrap"><table><thead><tr><th>View</th><th>Variáveis usadas (detectadas)</th><th>Includes/Extends</th></tr></thead><tbody><tr><td><strong>auth.login</strong><div class='muted'><code>resources/views/auth/login.blade.php</code></div></td><td><code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>auth.passwords.confirm</strong><div class='muted'><code>resources/views/auth/passwords/confirm.blade.php</code></div></td><td><code>message</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>auth.passwords.email</strong><div class='muted'><code>resources/views/auth/passwords/email.blade.php</code></div></td><td><code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>auth.passwords.reset</strong><div class='muted'><code>resources/views/auth/passwords/reset.blade.php</code></div></td><td><code>errors</code>, <code>token</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>auth.register</strong><div class='muted'><code>resources/views/auth/register.blade.php</code></div></td><td><code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>auth.verify</strong><div class='muted'><code>resources/views/auth/verify.blade.php</code></div></td><td>—</td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>emails.cancelService</strong><div class='muted'><code>resources/views/emails/cancelService.blade.php</code></div></td><td><code>logo</code>, <code>name</code></td><td>—</td></tr><tr><td><strong>emails.dependent-access</strong><div class='muted'><code>resources/views/emails/dependent-access.blade.php</code></div></td><td><code>email</code>, <code>loginUrl</code>, <code>logo</code>, <code>name</code>, <code>password</code></td><td>—</td></tr><tr><td><strong>emails.new_password</strong><div class='muted'><code>resources/views/emails/new_password.blade.php</code></div></td><td><code>logo</code>, <code>name</code>, <code>password</code>, <code>type</code></td><td>—</td></tr><tr><td><strong>layouts.app</strong><div class='muted'><code>resources/views/layouts/app.blade.php</code></div></td><td><code>class</code></td><td><code>layouts.page_templates.auth</code>, <code>layouts.page_templates.guest</code></td></tr><tr><td><strong>layouts.footers.auth</strong><div class='muted'><code>resources/views/layouts/footers/auth.blade.php</code></div></td><td>—</td><td>—</td></tr><tr><td><strong>layouts.footers.guest</strong><div class='muted'><code>resources/views/layouts/footers/guest.blade.php</code></div></td><td>—</td><td>—</td></tr><tr><td><strong>layouts.navbars.navs.auth</strong><div class='muted'><code>resources/views/layouts/navbars/navs/auth.blade.php</code></div></td><td>—</td><td>—</td></tr><tr><td><strong>layouts.navbars.navs.guest</strong><div class='muted'><code>resources/views/layouts/navbars/navs/guest.blade.php</code></div></td><td><code>activePage</code>, <code>title</code></td><td>—</td></tr><tr><td><strong>layouts.navbars.sidebar</strong><div class='muted'><code>resources/views/layouts/navbars/sidebar.blade.php</code></div></td><td><code>activePage</code>, <code>isBeneficiary</code></td><td>—</td></tr><tr><td><strong>layouts.page_templates.auth</strong><div class='muted'><code>resources/views/layouts/page_templates/auth.blade.php</code></div></td><td>—</td><td><code>layouts.footers.auth</code>, <code>layouts.navbars.navs.auth</code>, <code>layouts.navbars.sidebar</code></td></tr><tr><td><strong>layouts.page_templates.guest</strong><div class='muted'><code>resources/views/layouts/page_templates/guest.blade.php</code></div></td><td>—</td><td><code>layouts.footers.guest</code>, <code>layouts.navbars.navs.guest</code></td></tr><tr><td><strong>pages.auth.confirm</strong><div class='muted'><code>resources/views/pages/auth/confirm.blade.php</code></div></td><td>—</td><td>—</td></tr><tr><td><strong>pages.auth.forgot</strong><div class='muted'><code>resources/views/pages/auth/forgot.blade.php</code></div></td><td><code>errors</code></td><td>—</td></tr><tr><td><strong>pages.auth.forgotBeneficiary</strong><div class='muted'><code>resources/views/pages/auth/forgotBeneficiary.blade.php</code></div></td><td><code>errors</code></td><td>—</td></tr><tr><td><strong>pages.beneficiaries.area.dependents</strong><div class='muted'><code>resources/views/pages/beneficiaries/area/dependents.blade.php</code></div></td><td><code>dep</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.beneficiaries.area.edit</strong><div class='muted'><code>resources/views/pages/beneficiaries/area/edit.blade.php</code></div></td><td><code>error</code>, <code>errors</code>, <code>message</code>, <code>profile</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.beneficiaries.area.index</strong><div class='muted'><code>resources/views/pages/beneficiaries/area/index.blade.php</code></div></td><td><code>beneficiary</code>, <code>plan</code></td><td><code>extends:layouts.app</code>, <code>pages.beneficiaries.area.tutorial</code></td></tr><tr><td><strong>pages.beneficiaries.area.planDetails</strong><div class='muted'><code>resources/views/pages/beneficiaries/area/planDetails.blade.php</code></div></td><td><code>conv</code>, <code>plan</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.beneficiaries.area.schedules</strong><div class='muted'><code>resources/views/pages/beneficiaries/area/schedules.blade.php</code></div></td><td><code>dateFormat</code>, <code>doctorName</code>, <code>id</code>, <code>specialty</code>, <code>statusColor</code>, <code>timeFormat</code>, <code>videoRoom</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.beneficiaries.area.telemedicine</strong><div class='muted'><code>resources/views/pages/beneficiaries/area/telemedicine.blade.php</code></div></td><td><code>error</code>, <code>errors</code>, <code>label</code>, <code>value</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.beneficiaries.area.tutorial</strong><div class='muted'><code>resources/views/pages/beneficiaries/area/tutorial.blade.php</code></div></td><td>—</td><td>—</td></tr><tr><td><strong>pages.beneficiaries.auth.login</strong><div class='muted'><code>resources/views/pages/beneficiaries/auth/login.blade.php</code></div></td><td><code>errors</code></td><td>—</td></tr><tr><td><strong>pages.beneficiaries.create</strong><div class='muted'><code>resources/views/pages/beneficiaries/create.blade.php</code></div></td><td><code>company</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.beneficiaries.edit</strong><div class='muted'><code>resources/views/pages/beneficiaries/edit.blade.php</code></div></td><td><code>beneficiary</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.beneficiaries.general.index</strong><div class='muted'><code>resources/views/pages/beneficiaries/general/index.blade.php</code></div></td><td><code>beneficiaries</code>, <code>beneficiary</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.beneficiaries.general.indexDelete</strong><div class='muted'><code>resources/views/pages/beneficiaries/general/indexDelete.blade.php</code></div></td><td><code>beneficiaries</code>, <code>beneficiary</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.beneficiaries.index</strong><div class='muted'><code>resources/views/pages/beneficiaries/index.blade.php</code></div></td><td><code>beneficiaries</code>, <code>beneficiary</code>, <code>company</code>, <code>error</code>, <code>errors</code>, <code>plan</code>, <code>plans</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.beneficiaries.show</strong><div class='muted'><code>resources/views/pages/beneficiaries/show.blade.php</code></div></td><td><code>actionMap</code>, <code>beneficiary</code>, <code>bp</code>, <code>error</code>, <code>errors</code>, <code>genderMap</code>, <code>plan</code>, <code>plans</code>, <code>sucesso</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.caixas.index</strong><div class='muted'><code>resources/views/pages/caixas/index.blade.php</code></div></td><td><code>caixa</code>, <code>caixas</code></td><td><code>extends:layouts.app</code>, <code>pages.caixas.modals</code></td></tr><tr><td><strong>pages.caixas.lancamentos.index</strong><div class='muted'><code>resources/views/pages/caixas/lancamentos/index.blade.php</code></div></td><td><code>centro</code>, <code>centrosDeCusto</code>, <code>lancamento</code>, <code>lancamentos</code></td><td><code>extends:layouts.app</code>, <code>pages.financeiro.modals</code></td></tr><tr><td><strong>pages.caixas.lancamentos.modals</strong><div class='muted'><code>resources/views/pages/caixas/lancamentos/modals.blade.php</code></div></td><td><code>centro</code>, <code>centrosDeCusto</code></td><td>—</td></tr><tr><td><strong>pages.caixas.modals</strong><div class='muted'><code>resources/views/pages/caixas/modals.blade.php</code></div></td><td>—</td><td>—</td></tr><tr><td><strong>pages.checkout.confirmation</strong><div class='muted'><code>resources/views/pages/checkout/confirmation.blade.php</code></div></td><td><code>invoice</code></td><td>—</td></tr><tr><td><strong>pages.checkout.index</strong><div class='muted'><code>resources/views/pages/checkout/index.blade.php</code></div></td><td><code>company</code>, <code>error</code>, <code>errors</code>, <code>plan</code>, <code>plans</code></td><td>—</td></tr><tr><td><strong>pages.checkout.landingPage</strong><div class='muted'><code>resources/views/pages/checkout/landingPage.blade.php</code></div></td><td><code>company</code></td><td>—</td></tr><tr><td><strong>pages.companies.create</strong><div class='muted'><code>resources/views/pages/companies/create.blade.php</code></div></td><td><code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.companies.edit</strong><div class='muted'><code>resources/views/pages/companies/edit.blade.php</code></div></td><td><code>company</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.companies.index</strong><div class='muted'><code>resources/views/pages/companies/index.blade.php</code></div></td><td><code>companies</code>, <code>company</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.companies.report</strong><div class='muted'><code>resources/views/pages/companies/report.blade.php</code></div></td><td><code>plan</code></td><td>—</td></tr><tr><td><strong>pages.companies.show</strong><div class='muted'><code>resources/views/pages/companies/show.blade.php</code></div></td><td><code>company</code>, <code>companyConvenio</code>, <code>companyConvenios</code>, <code>error</code>, <code>errors</code>, <code>sucesso</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.contaspagar.create</strong><div class='muted'><code>resources/views/pages/contaspagar/create.blade.php</code></div></td><td><code>caixa</code>, <code>caixas</code>, <code>costCenter</code>, <code>costCenters</code>, <code>partner</code>, <code>partners</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.contaspagar.index</strong><div class='muted'><code>resources/views/pages/contaspagar/index.blade.php</code></div></td><td><code>conta</code>, <code>contas</code>, <code>cores</code>, <code>status</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.contaspagar.show</strong><div class='muted'><code>resources/views/pages/contaspagar/show.blade.php</code></div></td><td><code>contaPagar</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.contaspagar.view_edit</strong><div class='muted'><code>resources/views/pages/contaspagar/view_edit.blade.php</code></div></td><td><code>caixa</code>, <code>caixas</code>, <code>conta</code>, <code>costCenter</code>, <code>costCenters</code>, <code>partner</code>, <code>partners</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.contasreceber.create</strong><div class='muted'><code>resources/views/pages/contasreceber/create.blade.php</code></div></td><td><code>caixa</code>, <code>caixas</code>, <code>costCenter</code>, <code>costCenters</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.contasreceber.index</strong><div class='muted'><code>resources/views/pages/contasreceber/index.blade.php</code></div></td><td><code>conta</code>, <code>contas</code>, <code>cores</code>, <code>status</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.contasreceber.show</strong><div class='muted'><code>resources/views/pages/contasreceber/show.blade.php</code></div></td><td><code>contaReceber</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.contasreceber.view_edit</strong><div class='muted'><code>resources/views/pages/contasreceber/view_edit.blade.php</code></div></td><td><code>caixa</code>, <code>caixas</code>, <code>contaReceber</code>, <code>costCenter</code>, <code>costCenters</code>, <code>status</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.convenios.create</strong><div class='muted'><code>resources/views/pages/convenios/create.blade.php</code></div></td><td><code>categoria</code>, <code>categorias</code>, <code>error</code>, <code>errors</code>, <code>partner</code>, <code>partners</code>, <code>statusOption</code>, <code>type</code>, <code>types</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.convenios.index</strong><div class='muted'><code>resources/views/pages/convenios/index.blade.php</code></div></td><td><code>categoria</code>, <code>categorias</code>, <code>convenio</code>, <code>convenios</code>, <code>cores</code>, <code>status</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.convenios.show</strong><div class='muted'><code>resources/views/pages/convenios/show.blade.php</code></div></td><td><code>convenio</code>, <code>error</code>, <code>errors</code>, <code>sucesso</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.convenios.view_edit</strong><div class='muted'><code>resources/views/pages/convenios/view_edit.blade.php</code></div></td><td><code>categoria</code>, <code>categorias</code>, <code>convenio</code>, <code>error</code>, <code>errors</code>, <code>partner</code>, <code>partners</code>, <code>statusOption</code>, <code>type</code>, <code>types</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.convenios_categorias.index</strong><div class='muted'><code>resources/views/pages/convenios_categorias/index.blade.php</code></div></td><td><code>categoria</code>, <code>categorias</code></td><td><code>extends:layouts.app</code>, <code>pages.convenios_categorias.modals</code></td></tr><tr><td><strong>pages.convenios_categorias.modals</strong><div class='muted'><code>resources/views/pages/convenios_categorias/modals.blade.php</code></div></td><td>—</td><td>—</td></tr><tr><td><strong>pages.convenios_tipos.index</strong><div class='muted'><code>resources/views/pages/convenios_tipos/index.blade.php</code></div></td><td><code>error</code>, <code>errors</code>, <code>type</code>, <code>types</code></td><td><code>extends:layouts.app</code>, <code>pages.convenios_tipos.modals</code></td></tr><tr><td><strong>pages.convenios_tipos.modals</strong><div class='muted'><code>resources/views/pages/convenios_tipos/modals.blade.php</code></div></td><td>—</td><td>—</td></tr><tr><td><strong>pages.costcenters.index</strong><div class='muted'><code>resources/views/pages/costcenters/index.blade.php</code></div></td><td><code>costCenter</code>, <code>costCenters</code></td><td><code>extends:layouts.app</code>, <code>pages.costcenters.modals</code></td></tr><tr><td><strong>pages.costcenters.modals</strong><div class='muted'><code>resources/views/pages/costcenters/modals.blade.php</code></div></td><td><code>user</code>, <code>users</code></td><td>—</td></tr><tr><td><strong>pages.dashboard</strong><div class='muted'><code>resources/views/pages/dashboard.blade.php</code></div></td><td><code>beneficiaries</code>, <code>companies</code>, <code>company</code>, <code>convenios</code>, <code>partners</code>, <code>plans</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.dependents.area.edit</strong><div class='muted'><code>resources/views/pages/dependents/area/edit.blade.php</code></div></td><td><code>error</code>, <code>errors</code>, <code>message</code>, <code>profile</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.dependents.area.index</strong><div class='muted'><code>resources/views/pages/dependents/area/index.blade.php</code></div></td><td><code>dependent</code>, <code>plan</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.dependents.area.planDetails</strong><div class='muted'><code>resources/views/pages/dependents/area/planDetails.blade.php</code></div></td><td><code>conv</code>, <code>plan</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.dependents.area.schedules</strong><div class='muted'><code>resources/views/pages/dependents/area/schedules.blade.php</code></div></td><td><code>dateFormat</code>, <code>doctorName</code>, <code>id</code>, <code>specialty</code>, <code>statusColor</code>, <code>timeFormat</code>, <code>videoRoom</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.dependents.area.telemedicine</strong><div class='muted'><code>resources/views/pages/dependents/area/telemedicine.blade.php</code></div></td><td><code>error</code>, <code>errors</code>, <code>label</code>, <code>value</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.dependents.auth.login</strong><div class='muted'><code>resources/views/pages/dependents/auth/login.blade.php</code></div></td><td><code>errors</code></td><td>—</td></tr><tr><td><strong>pages.dependents.create</strong><div class='muted'><code>resources/views/pages/dependents/create.blade.php</code></div></td><td><code>beneficiary</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.dependents.edit</strong><div class='muted'><code>resources/views/pages/dependents/edit.blade.php</code></div></td><td><code>dependent</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.dependents.index</strong><div class='muted'><code>resources/views/pages/dependents/index.blade.php</code></div></td><td><code>beneficiary</code>, <code>dependent</code>, <code>dependents</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.dependents.show</strong><div class='muted'><code>resources/views/pages/dependents/show.blade.php</code></div></td><td><code>dependent</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.financeiro.index</strong><div class='muted'><code>resources/views/pages/financeiro/index.blade.php</code></div></td><td><code>caixa</code>, <code>caixas</code>, <code>centro</code>, <code>centrosDeCusto</code>, <code>entradas</code>, <code>lancamento</code>, <code>lancamentos</code>, <code>saidas</code>, <code>saldo</code></td><td><code>extends:layouts.app</code>, <code>pages.financeiro.modals</code></td></tr><tr><td><strong>pages.financeiro.modals</strong><div class='muted'><code>resources/views/pages/financeiro/modals.blade.php</code></div></td><td><code>caixa</code>, <code>caixas</code>, <code>centro</code>, <code>centrosDeCusto</code></td><td>—</td></tr><tr><td><strong>pages.financeiro.print</strong><div class='muted'><code>resources/views/pages/financeiro/print.blade.php</code></div></td><td><code>centroSelecionado</code>, <code>l</code>, <code>lancamentos</code>, <code>periodo</code></td><td>—</td></tr><tr><td><strong>pages.partners.create</strong><div class='muted'><code>resources/views/pages/partners/create.blade.php</code></div></td><td><code>costCenter</code>, <code>costCenters</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.partners.edit</strong><div class='muted'><code>resources/views/pages/partners/edit.blade.php</code></div></td><td><code>costCenter</code>, <code>costCenters</code>, <code>error</code>, <code>errors</code>, <code>partner</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.partners.index</strong><div class='muted'><code>resources/views/pages/partners/index.blade.php</code></div></td><td><code>partner</code>, <code>partners</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.partners.show</strong><div class='muted'><code>resources/views/pages/partners/show.blade.php</code></div></td><td><code>companies</code>, <code>company</code>, <code>error</code>, <code>errors</code>, <code>indication</code>, <code>partner</code>, <code>sucesso</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.plans.conveniences</strong><div class='muted'><code>resources/views/pages/plans/conveniences.blade.php</code></div></td><td><code>convenience</code>, <code>error</code>, <code>errors</code>, <code>plan</code>, <code>planConvenience</code>, <code>planConveniences</code>, <code>sucesso</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.plans.create</strong><div class='muted'><code>resources/views/pages/plans/create.blade.php</code></div></td><td><code>company</code>, <code>error</code>, <code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.plans.edit</strong><div class='muted'><code>resources/views/pages/plans/edit.blade.php</code></div></td><td><code>error</code>, <code>errors</code>, <code>plan</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.plans.index</strong><div class='muted'><code>resources/views/pages/plans/index.blade.php</code></div></td><td><code>company</code>, <code>plan</code>, <code>plans</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.plans.show</strong><div class='muted'><code>resources/views/pages/plans/show.blade.php</code></div></td><td><code>error</code>, <code>errors</code>, <code>plan</code>, <code>sucesso</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.produtos.categorias.index</strong><div class='muted'><code>resources/views/pages/produtos/categorias/index.blade.php</code></div></td><td><code>categoria</code>, <code>categorias</code></td><td><code>extends:layouts.app</code>, <code>pages.produtos.categorias.modals</code></td></tr><tr><td><strong>pages.produtos.categorias.modals</strong><div class='muted'><code>resources/views/pages/produtos/categorias/modals.blade.php</code></div></td><td>—</td><td>—</td></tr><tr><td><strong>pages.produtos.create</strong><div class='muted'><code>resources/views/pages/produtos/create.blade.php</code></div></td><td>—</td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.produtos.grupos.index</strong><div class='muted'><code>resources/views/pages/produtos/grupos/index.blade.php</code></div></td><td><code>grupo</code>, <code>grupos</code></td><td><code>extends:layouts.app</code>, <code>pages.produtos.grupos.modals</code></td></tr><tr><td><strong>pages.produtos.grupos.modals</strong><div class='muted'><code>resources/views/pages/produtos/grupos/modals.blade.php</code></div></td><td>—</td><td>—</td></tr><tr><td><strong>pages.produtos.index</strong><div class='muted'><code>resources/views/pages/produtos/index.blade.php</code></div></td><td><code>produto</code>, <code>produtos</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.produtos.unidades.index</strong><div class='muted'><code>resources/views/pages/produtos/unidades/index.blade.php</code></div></td><td><code>unidade</code>, <code>unidades</code></td><td><code>extends:layouts.app</code>, <code>pages.produtos.unidades.modals</code></td></tr><tr><td><strong>pages.produtos.unidades.modals</strong><div class='muted'><code>resources/views/pages/produtos/unidades/modals.blade.php</code></div></td><td>—</td><td>—</td></tr><tr><td><strong>pages.profile.edit</strong><div class='muted'><code>resources/views/pages/profile/edit.blade.php</code></div></td><td><code>errors</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>pages.users.index</strong><div class='muted'><code>resources/views/pages/users/index.blade.php</code></div></td><td><code>user</code></td><td><code>extends:layouts.app</code></td></tr><tr><td><strong>welcome</strong><div class='muted'><code>resources/views/welcome.blade.php</code></div></td><td>—</td><td><code>extends:layouts.app</code></td></tr></tbody></table></div>
    <div class="hint"><strong>Ágil Desenvolvimento de Sistemas</strong> — responsável pelo desenvolvimento, arquitetura, integrações, manutenção e evolução contínua deste sistema.</div>
  </section>
</main></div>

<script>
(function(){
  const pages=[...document.querySelectorAll('.page')];
  const toc=document.getElementById('toc');
  const prev=document.getElementById('prevBtn');
  const next=document.getElementById('nextBtn');
  const all=document.getElementById('allBtn');
  let allMode=false, idx=0;

  function setActive(i){
    idx=Math.max(0,Math.min(pages.length-1,i));
    if(!allMode) pages.forEach((p,k)=>p.classList.toggle('active',k===idx));
    [...toc.querySelectorAll('.item')].forEach((el,k)=>el.classList.toggle('active',k===idx));
    document.getElementById('pages').scrollIntoView({behavior:'smooth',block:'start'});
  }

  function build(){
    toc.innerHTML='';
    pages.forEach((p,i)=>{
      const title=p.getAttribute('data-title')||('Seção '+(i+1));
      const a=document.createElement('a');
      a.href='javascript:void(0)';
      a.className='item';
      a.innerHTML=`<span>${title}</span><span class="badge">${(i+1)}/${pages.length}</span>`;
      a.addEventListener('click',()=>{allMode=false; all.textContent='Ver tudo'; pages.forEach(pg=>pg.classList.remove('active')); setActive(i);});
      toc.appendChild(a);
    });
  }

  prev.addEventListener('click',()=>setActive(idx-1));
  next.addEventListener('click',()=>setActive(idx+1));
  all.addEventListener('click',()=>{
    allMode=!allMode;
    if(allMode){pages.forEach(p=>p.classList.add('active')); all.textContent='Modo páginas';}
    else {all.textContent='Ver tudo'; setActive(idx);}
  });
  document.addEventListener('keydown',(e)=>{if(e.key==='ArrowLeft') setActive(idx-1); if(e.key==='ArrowRight') setActive(idx+1);});

  build(); setActive(0);
})();
</script></body></html>
