<!-- 会員詳細ページ -->
@extends('layouts.app')

@section('content')
    <h1>会員詳細</h1>

    <table>
        <tr>
            <th>氏名</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>フリガナ</th>
            <td>{{ $user->kana }}</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $user->address }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $user->phone_number }}</td>
        </tr>
    </table>
@endsection