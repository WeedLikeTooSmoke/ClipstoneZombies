<div class="container page">
    <div class="leaderboard">
        <table>
            <tr>
                <th>Name</th>
                <th>Money</th>
                <th>Kills</th>
                <th>Downs</th>
                <th>Deaths</th>
                <th>Revives</th>
                <th>Headshots</th>
                <th>Boss Kills</th>
            </tr>
            @foreach($records as $record)
                <tr>
                    <td>{{ $record->name }}</td>
                    <td>£{{ Number::forHumans($record->score) }}</td>
                    <td>{{ Number::format($record->kills) }}</td>
                    <td>{{ Number::format($record->downs) }}</td>
                    <td>{{ Number::format($record->deaths) }}</td>
                    <td>{{ Number::format($record->revives) }}</td>
                    <td>{{ Number::format($record->headshots) }}</td>
                    <td>{{ Number::format($record->bosses_killed) }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
