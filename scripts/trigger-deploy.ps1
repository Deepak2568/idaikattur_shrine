# Trigger production deploy from your PC (bypasses Hiox bot check on GitHub IPs).
# Prerequisites:
#   - curl.exe (built into Windows 10+)
#   - Optional: $env:GITHUB_TOKEN if the repo/releases are private
#
# Usage:
#   .\scripts\trigger-deploy.ps1
#   .\scripts\trigger-deploy.ps1 -Tag deploy-123456789
#   .\scripts\trigger-deploy.ps1 -DeployUrl "https://idaikatturshs.in/ci-deploy" -DeployToken "your-token"

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
        Write-Error "No deploy-* release found. Run the GitHub Action first (it creates the release even if notify fails)."
    }
    $Tag = $match.tag_name
}

Write-Host "Using release tag: $Tag"
$release = Invoke-GitHubApi "https://api.github.com/repos/$Repo/releases/tags/$Tag"
if (-not $release.assets -or $release.assets.Count -lt 1) {
    Write-Error "No asset on release $Tag"
}
$assetApiUrl = $release.assets[0].url
Write-Host "Asset: $($release.assets[0].name)"

Write-Host "Asking server to pull release (from your IP)..."

$responseFile = [System.IO.Path]::GetTempFileName()
try {
    $curlArgs = @(
        "-sS", "-o", $responseFile, "-w", "%{http_code}",
        "-X", "POST",
        "-H", "X-Deploy-Token: $DeployToken",
        "-H", "Content-Type: application/x-www-form-urlencoded",
        "-H", "Accept: text/plain",
        "--data-urlencode", "download_url=$assetApiUrl",
        "--connect-timeout", "30",
        "--max-time", "900",
        $DeployUrl
    )
    if ($GitHubToken) {
        $curlArgs = @(
            "-sS", "-o", $responseFile, "-w", "%{http_code}",
            "-X", "POST",
            "-H", "X-Deploy-Token: $DeployToken",
            "-H", "Content-Type: application/x-www-form-urlencoded",
            "-H", "Accept: text/plain",
            "--data-urlencode", "download_url=$assetApiUrl",
            "--data-urlencode", "github_token=$GitHubToken",
            "--connect-timeout", "30",
            "--max-time", "900",
            $DeployUrl
        )
    }

    $httpCode = & curl.exe @curlArgs

    $body = Get-Content -Raw $responseFile
    Write-Host "HTTP $httpCode"
    Write-Host $body

    if ($httpCode -ne "200" -or $body -notmatch "^OK deployed") {
        if ($body -match "One moment|being verified|Imunify") {
            Write-Error "Bot protection still active. Whitelist /ci-deploy in cPanel Imunify360 (see instructions)."
        }
        if ($body -match "Download HTTP 404|Download HTTP 401|Download HTTP 403") {
            Write-Error "Server could not download the release. Set a GitHub PAT: `$env:GITHUB_TOKEN = 'ghp_...' then re-run."
        }
        Write-Error "Deploy failed."
    }

    Write-Host "Deploy succeeded."
}
finally {
    Remove-Item -Force $responseFile -ErrorAction SilentlyContinue
}
