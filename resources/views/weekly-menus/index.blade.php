<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>一週間Menu</title>
</head>
<body>
    <h2>日付選択</h2>
    <form method="POST" action="/weekly-menus">
        @csrf
        <div class="days-list">
            <label>週の開始日指定</label>
            <input type="date" name="start_date" required>
            <button type="submit">日付入力</button>
        </div>
    </form>

    <h2>メニュー</h2>
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

            <button type="submit">決定！</button>
        </div>
    </form>

    <h2>買い物メモ</h2>
    <form method="POST" action="/shopping-items/store">
        @csrf
        <div class="shopping-list">
            <div class="shopping-items">
                <select name="category">
                        <option class="shopping-category" value="食料品">食料品</option>
                        <option class="shopping-category" value="日用品">日用品</option>
                        <option class="shopping-category" value="その他">その他</option>
                </select>
                <input class="shopping-item" type="text" name="item_name">
            </div>

            <button type="submit">追加</button>
        </div>
    </form>
    <div class="shopping-list-display">
        <h3>【食料品】</h3>
        @foreach ($foodItems as $item)
            <div class="shopping-list-row">
                <span>{{ $item->item_name }}</span>
            </div>
        @endforeach

        <h3>【日用品】</h3>
        @foreach ($dailyItems as $item)
            <div class="shopping-list-row">
                <span>{{ $item->item_name }}</span>
            </div>
        @endforeach

        <h3>【その他】</h3>
        @foreach ($otherItems as $item)
            <div class="shopping-list-row">
                <span>{{ $item->item_name }}</span>
            </div>
        @endforeach
    </div>
</body>
</html>
