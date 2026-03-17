@echo off
setlocal

set "FOUND=0"
for /f "tokens=5" %%P in ('netstat -ano ^| findstr /R /C:":8080 .*LISTENING"') do (
  set "FOUND=1"
  taskkill /PID %%P /F >nul 2>&1
)

if "%FOUND%"=="0" (
  echo No process is listening on port 8080.
) else (
  echo Stopped server processes on port 8080.
)

endlocal
