<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->exists('name') && $request->exists('email')) {
            $validator = Validator::make($request->all(), [
                'name' => 'string|nullable',
                'email' => 'email|nullable'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->input());
            }

            $validatedParams = $validator->validated();

            $name = Arr::get($validatedParams, 'name');
            $email = Arr::get($validatedParams, 'email');

            $users = User::where('name', 'like', '%' . $name . '%')
                ->where('email', 'like', '%' . $email . '%')
                ->paginate(10);

            session()->flashInput($request->input());
        } else {
            $users = User::paginate(10);
        }

        return view('user')->with('users', $users);
    }
}
