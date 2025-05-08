<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Join;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect("login");
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'guid' => 'required|unique:users|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();

        $query = Join::select('name')->where('guid', $data['guid'])->get();
        $json = json_decode($query, true);
        if (isset($json[0]['name'])) {
            $data['name'] = $json[0]['name'];
            $user = $this->createUser($data);
            event(new Registered($user));
            Auth::login($user);
            return redirect("/");
        }

        return redirect("index");
    }

    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'guid' => $data['guid'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
