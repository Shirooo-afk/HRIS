# One-time fix: stop PHP 8.2 from loading WinGet 8.3 extensions.
# Close ALL terminals after this, then open a new one and run: .\fix-php-path.ps1

$winget83 = "C:\Users\Laurence\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe"
$wingetIni = "$winget83\php.ini"

# Remove PHPRC from Windows user environment (if set).
[Environment]::SetEnvironmentVariable('PHPRC', $null, 'User')
[Environment]::SetEnvironmentVariable('PHPRC', $null, 'Process')
Remove-Item Env:PHPRC -ErrorAction SilentlyContinue

# Disable the WinGet php.ini that breaks PHP 8.2 when PHPRC points here.
if (Test-Path $wingetIni) {
    Rename-Item $wingetIni "$wingetIni.disabled" -Force
    Write-Host "Renamed WinGet php.ini -> php.ini.disabled" -ForegroundColor Green
}

# Put PHP 8.3 first in USER Path (Laragon when ready, else WinGet).
$laragon83 = "C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64"
$phpDir = if (Test-Path "$laragon83\php.exe") { $laragon83 } elseif (Test-Path "$winget83\php.exe") { $winget83 } else { $null }

$userPath = [Environment]::GetEnvironmentVariable('Path', 'User')
$segments = $userPath -split ';' | Where-Object {
    $_ -and
    $_ -notmatch '\\laragon\\bin\\php\\' -and
    $_ -notmatch 'PHP\.PHP\.'
}

if ($phpDir) {
    [Environment]::SetEnvironmentVariable('Path', "$phpDir;" + ($segments -join ';'), 'User')
    Write-Host "User PATH updated: PHP 8.3 is now first." -ForegroundColor Green
} else {
    Write-Host "PHP 8.3 not found. In Laragon: Menu -> PHP -> Version -> 8.3.30" -ForegroundColor Yellow
}

Write-Host ""
Write-Host "Done. Close this terminal, open a NEW one, then:" -ForegroundColor Cyan
Write-Host "  cd c:\Users\Laurence\source\repos\HRIS"
Write-Host "  php -v"
Write-Host "  composer install"
