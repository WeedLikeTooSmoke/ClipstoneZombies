#include maps/mp/_utility;
#include common_scripts/utility;

#include scripts/zm/clipstone/utils;
#include scripts/zm/clipstone/account;
#include scripts/zm/clipstone/leaderboards;
#include scripts/zm/clipstone/cmds;
#include scripts/zm/clipstone/staff;

account(player)
{
    headers = [];
    headers["Content-Type"] = "application/json";
    headers["Api_Key"] = level.Clipstone["api_key"];
    headers["Api_Agent"] = level.Clipstone["api_agent"];

    data = [];
    data["guid"] = player getGUID();
    data["name"] = player.name;

    request = httpPost("http://127.0.0.1:8000/api/vanilla/account", jsonSerialize(data, 4), headers);
    request waittill("done", result);

    account = jsonParse(result);

    jsonDump("account", result, 4);

    player.pers["level"] = int(account["account-level"]);
    player.pers["rank"] = int(account["account-rank"]);
    player.pers["money"] = int(account["account-money"]);

    if(isDefined(account["account-guid"]) && account["account-guid"] == 0)
        kickPlayerWithReason(player, "                                                                                                                                                                                                          [^5Clipstone^7] You are not ^5REGISTERED^7                                                                                                                                                            Register at ^5https://zombies.clipst.one^7                                           [^5GUID^7]^5 " + player getGUID() + "^7       [^5Username^7] ^5" + player.name);

    if(isDefined(account["account-verified"]) && account["account-verified"] == 0)
        kickPlayerWithReason(player, "                                                                                                                                                                                                          [^5Clipstone^7] Email is not ^5VERIFIED^7                                                                                                                                                                Verify your email from your email box                                           [^5GUID^7]^5 " + player getGUID() + "^7       [^5Username^7] ^5" + player.name);

    if(isDefined(account["account-banned"]) && account["account-banned"] == 1)
        kickPlayerWithReason(player, "                                                                                                                                                                                                                   [^1Clipstone^7] You are ^1BANNED^7                                                                                                                                                                      Appeal at ^1https://zombies.clipst.one^7");

    player resetName();
    player rename(account["account-name"]);

    foreach(welcome in account["account-welcome"])
        player tell(welcome);
}
