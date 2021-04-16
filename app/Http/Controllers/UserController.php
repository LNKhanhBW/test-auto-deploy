<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Login screen
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login(Request $request) {
        Auth::logout();
        if ($request->isMethod('POST')) {
            $data = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            if (Auth::attempt($data)) {
                return redirect(route('home'));
            }

        }
       return view('user.login');
    }

    /**
     * Register Screen
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register() {
        return view('user.register');
    }
    /**
     * Register Screen
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(UserRequest $request) {
        if ($request->isMethod('post')) {
            $data = [
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'password'  => $request->input('password')
            ];
            $user = new User();
            if ($user->createUser($data)) {
                return redirect(route('user.login'));
            }

        }
    }

    /**
     * Logout
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout() {
        Auth::logout();
        return redirect(route('user.login'));
    }
}
