# Deploy production by downloading the release on YOUR PC, then uploading
# to the server. The server never talks to GitHub (avoids Hiox timeout/blocks).
#
# Usage:
#   .\scripts\trigger-deploy.ps1
#   .\scripts\trigger-deploy.ps1 -Tag deploy-123456789
#   .\scripts\trigger-deploy.ps1 -DeployToken "your-token"

param(
    [string]$Tag = "",
    [string]$DeployUrl = "https://idaikatturshs.in/ci-deploy",
    [string]$DeployToken = "",
    [string]$Repo = "Deepak2568/idaikattur_shrine",
    [string]$GitHubToken = ""
)

$ErrorActionPreference = "Stop"

if (-not $DeployToken) {
    $DeployToken = $env:DEPLOY_TOKEN
}
if (-not $DeployToken) {
    $DeployToken = Read-Host "Enter DEPLOY_TOKEN (same as server .env)"
}

if (-not $GitHubToken) {
    $GitHubToken = $env:GITHUB_TOKEN
    if (-not $GitHubToken) { $GitHubToken = $env:GH_TOKEN }
}

$apiHeaders = @{
    "User-Agent" = "IdaikatturShrine-Deploy/1.0"
    "Accept"     = "application/vnd.github+json"
}
if ($GitHubToken) {
    $apiHeaders["Authorization"] = "Bearer $GitHubToken"
    $apiHeaders["X-GitHub-Api-Version"] = "2022-11-28"
}

function Invoke-GitHubApi([string]$Uri) {
    try {
        return Invoke-RestMethod -Uri $Uri -Headers $apiHeaders -Method Get
    } catch {
        $msg = $_.Exception.Message
        if ($_.ErrorDetails.Message) { $msg = $_.ErrorDetails.Message }
        Write-Error "GitHub API failed ($Uri): $msg"
    }
}

if (-not $Tag) {
    Write-Host "Finding latest deploy-* release..."
    $releases = Invoke-GitHubApi "https://api.github.com/repos/$Repo/releases?per_page=20"
    $match = $releases | Where-Object { $_.tag_name -like "deploy-*" } | Select-Object -First 1
    if (-not $match) {
        Write-Error "No deploy-* release found. Wait for the GitHub Action to finish, then retry."
    }
    $Tag = $match.tag_name
}

Write-Host "Using release tag: $Tag"
$release = Invoke-GitHubApi "https://api.github.com/repos/$Repo/releases/tags/$Tag"
if (-not $release.assets -or $release.assets.Count -lt 1) {
    Write-Error "No asset on release $Tag"
}

$asset = $release.assets[0]
$downloadUrl = $asset.browser_download_url
Write-Host "Asset: $($asset.name) ($([math]::Round($asset.size / 1KB, 1)) KB)"

$zipPath = Join-Path $env:TEMP "shrine-$Tag-release.zip"
Write-Host "Downloading release to your PC..."
$dlHeaders = @{ "User-Agent" = "IdaikatturShrine-Deploy/1.0" }
Invoke-WebRequest -Uri $downloadUrl -OutFile $zipPath -Headers $dlHeaders
if (-not (Test-Path $zipPath) -or (Get-Item $zipPath).Length -lt 100) {
    Write-Error "Download failed or empty zip."
}
Write-Host "Downloaded $([math]::Round((Get-Item $zipPath).Length / 1KB, 1)) KB"

Write-Host "Uploading zip to server (server does not call GitHub)..."
$responseFile = [System.IO.Path]::GetTempFileName()
try {
    $httpCode = curl.exe -sS -o $responseFile -w "%{http_code}" `
        -X POST `
        -H "X-Deploy-Token: $DeployToken" `
        -H "Accept: text/plain" `
        -F "release=@$zipPath" `
        --connect-timeout 30 `
        --max-time 300 `
        $DeployUrl

    $body = Get-Content -Raw $responseFile
    Write-Host "HTTP $httpCode"
    Write-Host $body

    if ($httpCode -ne "200" -or $body -notmatch "^OK deployed") {
        if ($body -match "One moment|being verified|Imunify") {
            Write-Error "Bot protection still active. Whitelist /ci-deploy in cPanel Imunify360."
        }
        if ($httpCode -eq "403") {
            Write-Error "Forbidden — check DEPLOY_TOKEN matches server .env"
        }
        Write-Error "Deploy failed."
    }

    Write-Host "Deploy succeeded."
}
finally {
    Remove-Item -Force $responseFile -ErrorAction SilentlyContinue
    Remove-Item -Force $zipPath -ErrorAction SilentlyContinue
}
