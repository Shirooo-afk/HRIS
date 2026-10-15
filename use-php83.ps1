# Same as fix-php-path.ps1. If scripts are blocked, run:  fix-php-path.cmd
& "$PSScriptRoot\fix-php-path.ps1"

# Set PHPRC to use the project's php.ini
$env:PHPRC = "$PSScriptRoot\php.ini"
