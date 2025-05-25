<div class="container page" wire:poll.20s>
    <div class="homepage-serverlist-header">
        Clipstone Zombies Serverlist
    </div>
    <div class="homepage-serverlist-description">
        Showcasing some of Clipstone Zombies servers
    </div>

    <div class="homepage-serverlist">
        @foreach($servers as $server)
            <div>
                <div class="header">
                    <i class="fa-solid fa-circle pulse"></i> &nbsp;&nbsp;&nbsp;{{ $server->address }}
                </div>
                <progress max="{{ $server->players_max_count }}" value="{{ $server->players_count }}"></progress>
            </div>
        @endforeach
    </div>
</div>
