<div class="container page">
    <div class="leaderboard">
        <table>
            <tr>
                <th>Map</th>
                <th>Round</th>
                <th>Players</th>
                <th>Game Type</th>
                <th>Gamemode</th>
                <th>Record Made</th>
            </tr>
            @foreach($records as $record)
                <tr>
                    <td>{{ $record->map }}</td>
                    <td>{{ $record->round }}</td>
                    <td>{{ $record->players }}</td>
                    <td>{{ $record->players_count }}</td>
                    <td>{{ $record->gamemode }}</td>
                    <td>{{ $record->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
