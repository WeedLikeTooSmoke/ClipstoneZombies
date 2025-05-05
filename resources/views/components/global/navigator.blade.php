<div class="nav">
    <nav class="container">
        <div>
            <img alt="Clipstone Zombies Logo" src="{{ asset('assets/images/coffin.png') }}"/>
            <a style="margin-left: 75px;">Clipstone Zombies</a>
        </div>
        <div>
            <div class="dropdown">
                <a>Homepage <i class="fa-solid fa-chevron-up"></i></a>
                <div class="dropdown-items">
                    <a href="/" wire:navigate><i class="fa-solid fa-house"></i> Homepage</a>
                    <a href="/newspaper" wire:navigate><i class="fa-solid fa-newspaper"></i> Newspaper</a>
                    <div class="divider"></div>
                    <a href="/" target="_blank"><i class="fa-brands fa-square-facebook"></i> Facebook Page</a>
                    <a href="/" target="_blank"><i class="fa-brands fa-youtube"></i> YouTube Channel</a>
                    <a href="/" target="_blank"><i class="fa-brands fa-twitter"></i> Twitter Page</a>
                    <a href="/" target="_blank"><i class="fa-brands fa-reddit-alien"></i> Reddit Page</a>
                </div>
            </div>

            <div class="dropdown">
                <a>Community <i class="fa-solid fa-chevron-up"></i></a>
                <div class="dropdown-items">
                    <a href="/search" wire:navigate><i class="fa-solid fa-magnifying-glass"></i> Search Players</a>
                    <div class="divider"></div>
                    <a href="/leaderboards" wire:navigate><i class="fa-solid fa-chart-simple"></i> Round Leaderboard</a>
                    <a href="/statsleaderboard" wire:navigate><i class="fa-solid fa-chart-simple"></i> Stats Leaderboard</a>
                </div>
            </div>

            <div class="dropdown">
                <a>Store <i class="fa-solid fa-chevron-up"></i></a>
                <div class="dropdown-items">
                    <a href="/usernames" wire:navigate><i class="fa-solid fa-palette"></i> Username Color</a>
                    <a href="/ranks" wire:navigate><i class="fa-solid fa-star"></i> Player Ranks</a>
                    <div class="divider"></div>
                    <a href="/money" wire:navigate><i class="fa-solid fa-money-bill"></i> Bank Money</a>
                </div>
            </div>

            <div class="dropdown">
                <a>Account <i class="fa-solid fa-chevron-up"></i></a>
                <div class="dropdown-items">
                    <a href="/login" wire:navigate><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                    <a href="/register" wire:navigate><i class="fa-solid fa-user-plus"></i> Register</a>
                </div>
            </div>
        </div>
    </nav>
</div>
