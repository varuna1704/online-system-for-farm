@echo off
setlocal

set "ROOT=%~dp0"
set "PHP_EXE=C:\xampp\php\php.exe"

if not exist "%PHP_EXE%" (
  echo Could not find PHP at "%PHP_EXE%".
  echo Install XAMPP or update this file with your php.exe path.
  exit /b 1
)

echo Starting ONLINE_SYSTEM_FOR_FARM on http://localhost:8080
echo Keep this terminal open. Press Ctrl+C to stop the server.
"%PHP_EXE%" -S localhost:8080 -t "%ROOT%"

endlocal
