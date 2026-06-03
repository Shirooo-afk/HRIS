@echo off
setlocal
set "PHPRC="
set "LARAGON83=C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64"
set "WINGET83=C:\Users\Laurence\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe"
if exist "%LARAGON83%\php.exe" ("%LARAGON83%\php.exe" %*) & exit /b %ERRORLEVEL%
if exist "%WINGET83%\php.exe" ("%WINGET83%\php.exe" %*) & exit /b %ERRORLEVEL%
echo PHP 8.3 not found.
exit /b 1
