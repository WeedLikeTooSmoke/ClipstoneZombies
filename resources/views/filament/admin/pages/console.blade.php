<x-filament-panels::page>
    <?php
        $tool = new q3tool("127.0.0.1", 4977);

        $players = $tool->get_info("playerlist");
        $player_num = $tool->get_info("players");

        var_dump($players);
        var_dump($player_num);
    ?>
</x-filament-panels::page>
