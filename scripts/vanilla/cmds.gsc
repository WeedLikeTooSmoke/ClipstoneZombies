// Include Base Game Scripts
#include maps/mp/_utility;
#include common_scripts/utility;

// Include Custom Utility Scripts
#include scripts/zm/ClipstoneZombies5/utils;

onPlayerSay()
{
    // Endon Endgame Or Disconnect
    level endon("end_game");
	self endon("disconnect");

    // Assign Prefix To A Variable
    prefix = ".";

    // Loop For Every Message
    for (;;)
    {
        // Waittill Player Sends A Message
        level waittill("say", message, player);

        // Set The Message To Lowercase
        message = toLower(message);

        // Check If Player Is Not In Intermission & Check If Correct Prefix
		if (!level.intermission && message[0] == prefix)
		{

            // Split Message
            args = strtok(message, " ");

            // Get Rid Of The . From The Command
            command = getSubStr(args[0], 1);

            // Switch Case For Running Commands On Different Cases
            switch(command)
            {
                // case "commandname":
                // player tell(); functionname(args);
                // break;
            }
        }
    }
}
