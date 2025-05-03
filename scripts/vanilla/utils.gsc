#include maps/mp/_utility;
#include common_scripts/utility;

#include scripts/zm/clipstone/utils;
#include scripts/zm/clipstone/account;
#include scripts/zm/clipstone/leaderboards;
#include scripts/zm/clipstone/cmds;
#include scripts/zm/clipstone/staff;

getCurrentMap()
{
    location = getDvar( "ui_zm_mapstartlocation" );
    gamemode = getDvar( "ui_gametype" );

    if( location == "processing" )
        return "Buried";
    else if( location == "rooftop" )
        return "DieRise";
    else if( location == "prison" )
        return "MobOfTheDead";
    else if( location == "nuked" )
        return "Nuketown";
    else if( location == "tomb" )
        return "Origins";
    else if( location == "town" )
        return "Town";
    else if( location == "farm" )
        return "Farm";
    else if( location == "transit" )
        if ( gamemode == "zclassic")
    	    return "Tranzit";
        if ( gamemode == "zstandard")
    	    return "Depot";
    return "NA";
}

kickPlayerWithReason(player, reason)
{
    executeCommand("clientkick_for_reason  " + player GetEntityNumber() + " \"" + reason + "\"");
}
