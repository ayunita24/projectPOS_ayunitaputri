<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('user.index',[
            "title"=>"Data Pengguna",
            "data"=>User::all()
        ]);
    }
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            "name"=>"required",
            "email"=>"email:dns",
            "password"=>"required"
        ]);

        $password=Hash::make($request->passwword);
        $request->merge([
            "password"=>$password
        ]);

        User::create($request->all());

        return redirect()->route('pengguna.index')->with('succes','Data User Berhasil Ditambahkan');
    }
}
