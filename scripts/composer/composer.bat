@echo off

php composer.phar self-update

IF NOT EXIST ..\..\vendor GOTO :INSTALL

:UPDATE
php composer.phar update
GOTO :DONE

:INSTALL
php composer.phar install
GOTO :DONE

:DONE
pause
