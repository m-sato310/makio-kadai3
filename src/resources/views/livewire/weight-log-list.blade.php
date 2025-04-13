<table class="weight-log-table">
    <thead>
        <tr>
            <th>日付</th>
            <th>体重</th>
            <th>食事摂取カロリー</th>
            <th>運動時間</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logs as $log)
        <tr class="weight-log-item">
            <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
            <td>{{ $log->weight }}kg</td>
            <td>{{ $log->calories ?? '-' }}cal</td>
            <td>
                {{ $log->exercise_time ? \Carbon\Carbon::createFromFormat('H:i:s', $log->exercise_time)->format('H:i') : '-' }}
            </td>
            <td>
                <a href="/weight_logs/{{ $log->id }}">
                    <img src="{{ asset('images/pencil.png') }}" alt="編集" width="24" height="24">
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination">
    {{ $logs->links('vendor.pagination.custom') }}
</div>