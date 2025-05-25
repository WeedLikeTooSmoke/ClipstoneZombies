<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Server;

class Serverlist extends Component
{
    public function render()
    {
        foreach (config('plutonium.servers') as $server)
        {
            $address = explode(':', $server);
            $servers = file_get_contents('https://getserve.rs/server/'.$address[0].'/'.$address[1].'/json');
            $servers = json_decode($servers, true);

            $updateOrCreate = Server::updateOrCreate([
                'address' => $address[0].":".$address[1],
            ],[
                'name' => $servers['hostname'] ?? 'Offline',
                'address' => $address[0].":".$address[1],
                'players_max_count' => $servers['maxplayers'] ?? 0,
                'players_count' => $servers['realClients'] ?? 0,
            ]);
        }

        return view('livewire.serverlist', [
            'servers' => Server::all(),
        ]);
    }
}
