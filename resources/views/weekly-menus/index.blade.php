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
    <div class="header">
        <h2>始まりの日選択</h2>
        <form method="POST" action="/logout">
            @csrf
            <button class="logout" type="submit">ログアウト</button>
        </form>
    </div>
    <form method="POST" action="/weekly-menus">
        @csrf
        <div class="days-list">
            <input type="date" name="start_date">
            <button type="submit">日付登録</button>
            @error('start_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </form>

    <h2>メニュー</h2>
    <form method="POST" action="{{ route('daily-menus.update') }}">
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

            <button type="submit">メニュー登録</button>
        </div>
    </form>

    <h2>買い物メモ</h2>
    <form method="POST" action="{{ route('shopping-items.store') }}">
        @csrf
        <div class="shopping-list">
            <div class="shopping-items">
                <select name="category">
                    <option value="" disabled selected>選択してください</option>
                        <option class="shopping-category" value="食料品" {{ old('category') == '食料品' ? 'selected' : ''}}>食料品</option>
                        <option class="shopping-category" value="日用品" {{ old('category') == '日用品' ? 'selected' : ''}}>日用品</option>
                        <option class="shopping-category" value="その他" {{ old('category') == 'その他' ? 'selected' : ''}}>その他</option>
                </select>
                @error('category')
                    <div class="error">{{ $message }}</div>
                @enderror

                <input class="shopping-item" type="text" name="item_name">
                <button type="submit">追加</button>
                @error('item_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

        </div>
    </form>

    <div class="shopping-list-display">
        <h3>【食料品】</h3>
        @foreach ($foodItems as $item)
            <div class="shopping-list-row">
                <form method="POST" action="{{ route('shopping-items.toggle', $item->id) }}">
                    @csrf
                    <label>
                        <input class="shopping-list-input"
                            type="checkbox"
                            {{ $item->is_checked ? 'checked' : '' }}
                            onchange="this.form.submit()"
                        >
                        <span class="{{ $item->is_checked ? 'checked-item' : '' }}">{{ $item->item_name }}</span>
                    </label>
                </form>
                <form method="POST" action="{{ route('shopping-items.destroy', $item->id) }}">
                @csrf
                    @method('DELETE')
                    <button type="submit">
                        削除
                    </button>
                </form>
            </div>
        @endforeach

        <h3>【日用品】</h3>
        @foreach ($dailyItems as $item)
            <div class="shopping-list-row">
                <form method="POST" action="{{ route('shopping-items.toggle', $item->id) }}">
                @csrf
                    <label>
                        <input class="shopping-list-input"
                            type="checkbox"
                            {{ $item->is_checked ? 'checked' : '' }}
                            onchange="this.form.submit()"
                        >
                        <span class="{{ $item->is_checked ? 'checked-item' : '' }}">{{ $item->item_name }}</span>
                    </label>
                </form>
                <form method="POST" action="{{ route('shopping-items.destroy', $item->id) }}">
                @csrf
                    @method('DELETE')
                    <button type="submit">
                        削除
                    </button>
                </form>
            </div>
        @endforeach

        <h3>【その他】</h3>
        @foreach ($otherItems as $item)
            <div class="shopping-list-row">
                <form method="POST" action="{{ route('shopping-items.toggle', $item->id) }}">
                @csrf
                    <label>
                        <input class="shopping-list-input"
                            type="checkbox"
                            {{ $item->is_checked ? 'checked' : '' }}
                            onchange="this.form.submit()"
                        >
                        <span class="{{ $item->is_checked ? 'checked-item' : '' }}">{{ $item->item_name }}</span>
                    </label>
                </form>
                <form method="POST" action="{{ route('shopping-items.destroy', $item->id) }}">
                @csrf
                    @method('DELETE')
                    <button type="submit">
                        削除
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>
