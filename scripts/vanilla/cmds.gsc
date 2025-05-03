#include maps/mp/_utility;
#include common_scripts/utility;

#include scripts/zm/clipstone/utils;
#include scripts/zm/clipstone/account;
#include scripts/zm/clipstone/leaderboards;
#include scripts/zm/clipstone/cmds;
#include scripts/zm/clipstone/staff;

onPlayerSay()
{
    level endon("end_game");
	self endon("disconnect");

    prefix = ".";

    for (;;)
    {
        level waittill("say", message, player);

        message = toLower(message);

		if (!level.intermission && message[0] == prefix)
		{
            args = strtok(message, " ");
            command = getSubStr(args[0], 1);
            switch(command)
            {
                // case "commandname":
                // player tell(); functionname(args);
                // break;
            }
        }
    }
}
