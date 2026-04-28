<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>一週間Menu</title>
</head>
<body>
    <form method="POST" action="/weekly-menus">
        @csrf
        <div class="days-list">
            <label>週の開始日指定</label>
            <input type="date" name="start_date" required>
            <button type="submit">日付入力</button>
        </div>
    </form>
    <form method="POST" action="/daily-menus/update">
        @csrf
        <div class="menu-list">
            @foreach ($dailyMenus as $dailyMenu)
                <div class="menu-item">
                    <span class="menu-date">
                        {{ $dailyMenu->date->isoFormat('MM/DD (ddd)') }}
                    </span>

                    <input class="menu-input" type="text" name="menus[{{ $dailyMenu->id }}]" value="{{ $dailyMenu->menu }}">
                </div>
            @endforeach

            <button type="submit">献立決定！</button>
        </div>
    </form>
    <div class="shopping-list">

    </div>
</body>
</html>
