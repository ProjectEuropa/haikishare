<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\User;

//ユーザー情報を扱うクラス
class UsersController extends Controller
{
    public function edit($id) {
      //ユーザープロフィール変更画面表示するためのメソッド
      $user = User::find($id);

      return view('/users/edit', compact('user') );
    }
    public function update(UpdateUserRequest $request, $id) {
      //ユーザープロフィール変更画面からpostされた情報を基にユーザープロフィールを更新するためのメソッド
      $user = User::find($id);
      $user->fill($request->all())->save();

      return redirect('/home');
    }
}
