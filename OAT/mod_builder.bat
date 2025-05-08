echo off
set MOD_NAME=mp_change_me
set GAME_FOLDER=C:\game\folder\path\goes\here
set OAT_BASE=C:\OAT
set MOD_BASE=%cd%
::Below is an example of assets needed to load in order to build the mod. 
::Each line is seperated by a "^".
"%OAT_BASE%\linker.exe" ^
--load "%GAME_FOLDER%\zone\all\zm_prison.ff" ^
::You can add multiple zone files for your mod
::ex: --load "%GAME_FOLDER%\zone\all\mp_village.ff"
::ex: --load "%GAME_FOLDER%\zone\all\afghanistan.ff"
--base-folder "%OAT_BASE%" ^
--asset-search-path "%MOD_BASE%" ^
--source-search-path "%MOD_BASE%\zone_source" ^
--output-folder "%MOD_BASE%\zone" mod

set err=%ERRORLEVEL%

if %err% EQU 0 (
XCOPY "%MOD_BASE%\zone\mod.ff" "%LOCALAPPDATA%\plutonium\storage\t6\mods\%MOD_NAME%\mod.ff" /Y
) ELSE (
COLOR C
echo FAIL!
)
pause