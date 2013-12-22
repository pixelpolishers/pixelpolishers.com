@echo off

call %~dp0\..\vendor\bin\doctrine-module.bat orm:schema-tool:drop --force
