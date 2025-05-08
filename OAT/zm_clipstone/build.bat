echo off
set GAME_FOLDER=C:\Program Files (x86)\Steam\steamapps\common\Call of Duty Black Ops II
set OAT_BASE=C:\OAT
set MOD_BASE=%cd%
set MOD_NAME=zm_clipstone
"%OAT_BASE%\Linker.exe" ^
-v ^
--load "%GAME_FOLDER%\zone\all\so_zsurvival_zm_transit.ff" ^
--load "%GAME_FOLDER%\zone\all\so_zclassic_zm_transit.ff" ^
--base-folder "%OAT_BASE%" ^
--asset-search-path "%MOD_BASE%" ^
--source-search-path "%MOD_BASE%\zone_source" ^
--output-folder "%MOD_BASE%\zone" mod

set err=%ERRORLEVEL%

if %err% EQU 0 (
    XCOPY "%MOD_BASE%\zone\mod.ff" "%LOCALAPPDATA%\Plutonium\storage\t6\mods\%MOD_NAME%\mod.ff" /Y
    XCOPY "%MOD_BASE%\zone\mod.iwd" "%LOCALAPPDATA%\Plutonium\storage\t6\mods\%MOD_NAME%\mod.iwd" /Y
    XCOPY "%MOD_BASE%\mod.json" "%LOCALAPPDATA%\Plutonium\storage\t6\mods\%MOD_NAME%\mod.json" /Y
) ELSE (
    COLOR C
    echo FAIL!
)
pause