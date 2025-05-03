#include common_scripts\utility;
#include maps\mp\_utility;

init()
{
	level thread onPlayerConnect();
}

onPlayerConnect()
{
    for(;;)
    {
        level waittill("connected", player);
        player thread onPlayerSpawned();
    }
}

onPlayerSpawned()
{
    self endon("disconnect");
	level endon("game_ended");
	level endon("end_game");
	for(;;)
	{
		self waittill("spawned_player");
	}
}
