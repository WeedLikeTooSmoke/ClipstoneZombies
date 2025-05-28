<div class="container page">
    <div class="homepage-statistics-header">
        Clipstone Zombies Statistics
    </div>
    <div class="homepage-statistics-description">
        Showcasing some statistics collected here at Clipstone Zombies
    </div>

    <div class="homepage-statistics">
        <div>
            Highest Round
            <div class="homepage-statistics-amount">
                {{ $highestRound }}
            </div>
        </div>
        <div>
            Zombies Killed
            <div class="homepage-statistics-amount">
                {{ $zombiesKilled }}
            </div>
        </div>
        <div>
            Money Accumulated
            <div class="homepage-statistics-amount">
                £{{ Number::forHumans($moneyAccumulated) }}
            </div>
        </div>
        <div>
            Missions Completed
            <div class="homepage-statistics-amount">
                {{ $missionsCompleted }}
            </div>
        </div>

        <div>
            Money Gambled
            <div class="homepage-statistics-amount">
                {{ $moneyGambled }}
            </div>
        </div>
        <div>
            Bosses Killed
            <div class="homepage-statistics-amount">
                {{ $bossesKilled }}
            </div>
        </div>
        <div>
            Distance Traveled
            <div class="homepage-statistics-amount">
                {{ $distanceTraveled }}
            </div>
        </div>
        <div>
            Players Banned
            <div class="homepage-statistics-amount">
                {{ $playersBanned }}
            </div>
        </div>
    </div>
</div>
