<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 会員一覧ページ
    public function index(Request $request)
    {
        // 検索ボックスに入力されたキーワードを取得
        $keyword = $request->input('keyword');

        // ユーザーを検索・ページネート
        $users = User::when($keyword, function ($query) use ($keyword){
        return $query->where('name', 'like', "%{$keyword}%")
            ->orWhere('kana', 'like', "%{$keyword}%");
        })
        ->paginate(10);

        // 総数を取得
        $total = $users->total();

        // ビューに渡す
        return view('users.index', compact('users', 'keyword', 'total'));
    }

    // 会員詳細ページ
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }
}
