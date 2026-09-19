# Trigger production deploy from your PC (bypasses Hiox bot check on GitHub IPs).
# Prerequisites:
#   - GitHub CLI: https://cli.github.com/  (gh auth login)
#   - curl.exe (built into Windows 10+)
#
# Usage:
#   .\scripts\trigger-deploy.ps1
#   .\scripts\trigger-deploy.ps1 -Tag deploy-123456789
#   .\scripts\trigger-deploy.ps1 -DeployUrl "https://idaikatturshs.in/ci-deploy" -DeployToken "your-token"

param(
    [string]$Tag = "",
    [string]$DeployUrl = "https://idaikatturshs.in/ci-deploy",
    [string]$DeployToken = "",
    [string]$Repo = "Deepak2568/idaikattur_shrine"
)

$ErrorActionPreference = "Stop"

if (-not $DeployToken) {
    $DeployToken = $env:DEPLOY_TOKEN
}
if (-not $DeployToken) {
    $DeployToken = Read-Host "Enter DEPLOY_TOKEN (same as server .env)"
}

if (-not (Get-Command gh -ErrorAction SilentlyContinue)) {
    Write-Error "GitHub CLI (gh) is required. Install from https://cli.github.com/ then run: gh auth login"
}

if (-not $Tag) {
    Write-Host "Finding latest deploy-* release..."
    $Tag = gh release list --repo $Repo --limit 20 --json tagName `
        --jq '[.[] | select(.tagName | startswith("deploy-"))] | .[0].tagName'
    if (-not $Tag) {
        Write-Error "No deploy-* release found. Run the GitHub Action first (it creates the release even if notify fails)."
    }
}

Write-Host "Using release tag: $Tag"
$assetApiUrl = gh api "repos/$Repo/releases/tags/$Tag" --jq ".assets[0].url"
if (-not $assetApiUrl) {
    Write-Error "No asset on release $Tag"
}

$token = gh auth token
Write-Host "Asking server to pull release (from your IP)..."

$responseFile = [System.IO.Path]::GetTempFileName()
try {
    $httpCode = curl.exe -sS -o $responseFile -w "%{http_code}" `
        -X POST `
        -H "X-Deploy-Token: $DeployToken" `
        -H "Content-Type: application/x-www-form-urlencoded" `
        -H "Accept: text/plain" `
        --data-urlencode "download_url=$assetApiUrl" `
        --data-urlencode "github_token=$token" `
        --connect-timeout 30 `
        --max-time 900 `
        $DeployUrl

    $body = Get-Content -Raw $responseFile
    Write-Host "HTTP $httpCode"
    Write-Host $body

    if ($httpCode -ne "200" -or $body -notmatch "^OK deployed") {
        if ($body -match "One moment|being verified|Imunify") {
            Write-Error "Bot protection still active. Whitelist /ci-deploy in cPanel Imunify360 (see instructions)."
        }
        Write-Error "Deploy failed."
    }

    Write-Host "Deploy succeeded."
}
finally {
    Remove-Item -Force $responseFile -ErrorAction SilentlyContinue
}
