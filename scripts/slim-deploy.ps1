# Upload a small code-only zip to production (avoids 150MB release timeout).
# Usage:
#   .\scripts\slim-deploy.ps1
#   .\scripts\slim-deploy.ps1 -DeployToken "your-token"

param(
    [string]$DeployUrl = "https://idaikatturshs.in/ci-deploy",
    [string]$DeployToken = ""
)

$ErrorActionPreference = "Stop"
$Root = Split-Path -Parent (Split-Path -Parent $MyInvocation.MyCommand.Path)

if (-not $DeployToken) {
    $DeployToken = $env:DEPLOY_TOKEN
}
if (-not $DeployToken) {
    $DeployToken = Read-Host "Enter DEPLOY_TOKEN (same as server .env)"
}

$slim = Join-Path $env:TEMP "shrine-slim-deploy.zip"
$stage = Join-Path $env:TEMP "shrine-slim-stage"
if (Test-Path $slim) { Remove-Item $slim -Force }
if (Test-Path $stage) { Remove-Item $stage -Recurse -Force }
New-Item -ItemType Directory -Path $stage | Out-Null

$paths = @(
    "app\Support\helpers.php",
    "app\Providers\AppServiceProvider.php",
    "app\Http\Controllers\ContactController.php",
    "app\Http\Controllers\RegisterController.php",
    "app\Http\Controllers\DeployController.php",
    "app\Http\Controllers\AdminController.php",
    "app\Http\Controllers\DonationController.php",
    "app\Http\Middleware\TrackSiteVisitor.php",
    "app\Services\IpGeolocation.php",
    "app\Mail\ContactFormSubmitted.php",
    "app\Mail\DonationRequestSubmitted.php",
    "app\Mail\MatrimonyRegistrationSubmitted.php",
    "app\Models\Contact.php",
    "app\Models\DonationRequest.php",
    "app\Models\SiteVisitor.php",
    "bootstrap\app.php",
    "config\services.php",
    "database\migrations\2026_03_28_120000_add_phone_to_contacts_table.php",
    "database\migrations\2026_03_28_131500_change_contacts_phone_to_string.php",
    "database\migrations\2026_03_28_180000_create_site_visitors_table.php",
    "database\migrations\2026_03_28_190000_add_location_to_site_visitors_table.php",
    "database\migrations\2026_03_29_100000_create_donation_requests_table.php",
    "database\migrations\2026_03_29_110000_add_address_to_donation_requests_table.php",
    "resources\views\emails\contact-submitted.blade.php",
    "resources\views\emails\donation-submitted.blade.php",
    "resources\views\emails\matrimony-registered.blade.php",
    "resources\views\shrine\contact.blade.php",
    "resources\views\shrine\donate.blade.php",
    "resources\views\shrine\admin.blade.php",
    "resources\views\shrine\dashboard.blade.php",
    "resources\views\shrine\matrimony.blade.php",
    "resources\views\shrine\mass_offerings.blade.php",
    "resources\views\profile\show.blade.php",
    "resources\views\profile\edit.blade.php",
    "resources\views\layouts\app.blade.php",
    "resources\views\layouts\header.blade.php",
    "resources\views\layouts\footer.blade.php",
    "resources\views\home.blade.php",
    "resources\views\shrine\schedule.blade.php",
    "resources\views\shrine\about.blade.php",
    "resources\views\shrine\gallery.blade.php",
    "resources\views\shrine\priest.blade.php",
    "resources\views\shrine\mass_videos.blade.php",
    "routes\web.php",
    "public\css\shrine-theme.css",
    "public\shrine.js"
)

foreach ($p in $paths) {
    $src = Join-Path $Root $p
    if (-not (Test-Path $src)) {
        Write-Warning "Missing: $p"
        continue
    }
    $dest = Join-Path $stage $p
    New-Item -ItemType Directory -Force -Path (Split-Path $dest -Parent) | Out-Null
    Copy-Item $src $dest -Force
}

# Shared hosting: also place CSS at /css for docroot at app root
New-Item -ItemType Directory -Force -Path (Join-Path $stage "css") | Out-Null
Copy-Item (Join-Path $Root "public\css\shrine-theme.css") (Join-Path $stage "css\shrine-theme.css") -Force

Compress-Archive -Path (Join-Path $stage "*") -DestinationPath $slim -Force
Write-Host "Slim zip: $([math]::Round((Get-Item $slim).Length / 1KB, 1)) KB"

$responseFile = [System.IO.Path]::GetTempFileName()
try {
    $code = curl.exe -sS -o $responseFile -w "%{http_code}" `
        -X POST `
        -H "X-Deploy-Token: $DeployToken" `
        -H "Accept: text/plain" `
        -F "release=@$slim" `
        --connect-timeout 30 `
        --max-time 300 `
        $DeployUrl

    $body = Get-Content -Raw $responseFile
    Write-Host "HTTP $code"
    Write-Host $body

    if ($code -ne "200" -or $body -notmatch "^OK deployed") {
        Write-Error "Slim deploy failed."
    }
    Write-Host "Slim deploy succeeded."
}
finally {
    Remove-Item -Force $responseFile -ErrorAction SilentlyContinue
}
