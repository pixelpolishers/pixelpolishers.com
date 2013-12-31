@echo off

call %~dp0\..\vendor\bin\doctrine-module.bat orm:generate-proxies
