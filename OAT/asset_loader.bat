:: Load the original zone from the game folder.
:: Change this if you have installed your game somewhere else. 
set GAME_FOLDER=C:\game\folder\path\goes\here

set /p FAST_FILE=Which file should be dumped? (full path)

set OAT_PATH=%cd%

:: Verbose mode logs more details which can be useful to find errors
set ARGS=--verbose

set ARGS=%ARGS% --output-folder "%OAT_PATH%\zone_dump\t6\?zone?"

:: Specify the search-path to include the main folder to automatically load its IWD files for image dumping.
:: For T6 also specify sounds;zone/all;zone/english to load appropriate IPAKs and sound banks.
:: You can skip specifying the search path but it will not dump images then.
set ARGS=%ARGS% --search-path "%GAME_FOLDER%\sound;%GAME_FOLDER%\zone\all;%GAME_FOLDER%\zone\english"


Unlinker %ARGS% %FAST_FILE%
pause