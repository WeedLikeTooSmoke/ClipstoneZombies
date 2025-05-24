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
                    <td>£{{ $record->score }}</td>
                    <td>{{ $record->kills }}</td>
                    <td>{{ $record->downs }}</td>
                    <td>{{ $record->deaths }}</td>
                    <td>{{ $record->revives }}</td>
                    <td>{{ $record->headshots }}</td>
                    <td>{{ $record->bosses_killed }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
