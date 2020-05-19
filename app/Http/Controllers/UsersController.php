<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\User;

class UsersController extends Controller
{
    public function edit($id) {
      $user = User::find($id);

      return view('/users/edit', compact('user') );
    }
    public function update(UpdateUserRequest $request, $id) {
      $user = User::find($id);
      $user->fill($request->all())->save();

      return redirect('/home');
    }
}
