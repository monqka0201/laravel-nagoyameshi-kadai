<!-- 会員一覧ページ -->
@extends('layouts.app')

@section('content')
    <h1>会員一覧</h1>

    <!-- 検索フォーム -->
    <form action="{{ route('users.index') }}" method="GET">
        <input type="text" name="keyword" value="{{ old('keyword', $keyword) }}" placeholder="氏名・フリガナで検索">
        <button type="submit">検索</button>
    </form>

    <!-- ユーザー一覧 -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>氏名</th>
                <th>フリガナ</th>
                <th>　　</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->kana }}</td>
                    <td><a href="{{ route('users.show', $user->id) }}">詳細</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    <div>
        {{ $users->appends(['keyword' => $keyword])->links() }}
    </div>

    <!-- 総数 -->
    <p>総件数: {{ $total }}件</p>
@endsection
