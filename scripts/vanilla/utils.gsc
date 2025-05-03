// Include Base Game Scripts
#include maps/mp/_utility;
#include common_scripts/utility;

getCurrentMap()
{
    // Assign map dvars to variable
    location = getDvar( "ui_zm_mapstartlocation" );
    gamemode = getDvar( "ui_gametype" );

    // Check and then return the current map of the server
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
    // Kicks player with a given reason
    executeCommand("clientkick_for_reason  " + player GetEntityNumber() + " \"" + reason + "\"");
}
