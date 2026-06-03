# Use PHP 8.3 in THIS terminal only. Run: .\fix-php-path.ps1

$laragon83 = "C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64"
$winget83  = "C:\Users\Laurence\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe"

Remove-Item Env:PHPRC -ErrorAction SilentlyContinue

if (Test-Path "$laragon83\php.exe") {
    $phpDir = $laragon83
} elseif (Test-Path "$winget83\php.exe") {
    $phpDir = $winget83
} else {
    Write-Host "PHP 8.3 not found. In Laragon: Menu -> PHP -> Version -> 8.3.30" -ForegroundColor Red
    exit 1
}

$cleanPath = ($env:Path -split ';' | Where-Object {
    $_ -and $_ -notmatch '\\laragon\\bin\\php\\' -and $_ -notmatch 'PHP\.PHP\.'
})
$env:Path = "$phpDir;" + ($cleanPath -join ';')

Write-Host "Active PHP:" -ForegroundColor Green
& "$phpDir\php.exe" -v
