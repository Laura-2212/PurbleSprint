param([switch]$Instalar)

$ErrorActionPreference = 'Stop'
$raiz = $PSScriptRoot
Set-Location $raiz
$pythonVenv = Join-Path $raiz '.venv\Scripts\python.exe'

if ($Instalar) {
    $pythonInstalado = Join-Path $env:LOCALAPPDATA 'Programs\Python\Python312\python.exe'
    if (!(Test-Path $pythonInstalado)) { throw 'Python 3.12 não encontrado. Instale-o e rode novamente.' }
    & $pythonInstalado -m venv .venv
    & $pythonVenv -m pip install --upgrade pip
    & $pythonVenv -m pip install -r requirements-integrations.txt
    npm install --cache .npm-cache
}

if (!(Test-Path $pythonVenv)) { throw 'Para instalar as dependências, rode .\iniciar-integracoes.ps1 -Instalar.' }

function Servico-Ativo([string]$url) {
    try { Invoke-RestMethod $url -TimeoutSec 2 | Out-Null; return $true } catch { return $false }
}

if (!(Servico-Ativo 'http://127.0.0.1:8765/health')) {
    Start-Process -FilePath (Get-Command node).Source -ArgumentList @('integrations\stitch.mjs') -WorkingDirectory $raiz -WindowStyle Hidden
}
if (!(Servico-Ativo 'http://127.0.0.1:8766/health')) {
    Start-Process -FilePath $pythonVenv -ArgumentList @('integrations\antigravity.py') -WorkingDirectory $raiz -WindowStyle Hidden
}

Start-Sleep -Seconds 2
Invoke-RestMethod 'http://127.0.0.1:8765/health' -TimeoutSec 5 | Out-Null
Invoke-RestMethod 'http://127.0.0.1:8766/health' -TimeoutSec 5 | Out-Null
Write-Host 'Integrações Stitch e Antigravity iniciadas.'
