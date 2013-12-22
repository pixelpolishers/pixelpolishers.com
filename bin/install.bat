@echo off

call %~dp0\..\vendor\bin\doctrine-module.bat orm:schema-tool:create
call %~dp0\..\vendor\bin\doctrine-module.bat orm:generate-proxies
call %~dp0\..\vendor\bin\doctrine-module.bat data-fixture:import
