<div class="container page">
    <div class="search">
        <input wire:model.live="search" placeholder="Search for another player..."/>
        <div class="search-players">
            @foreach($results as $result)
                <div class="search-placeholder">
                    <img src="{{ Avatar::create($result->name)->toBase64() }}" />
                    <div class="username">{{ $result->name }}</div>
                    <div class="description">Level {{ $result->level }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
