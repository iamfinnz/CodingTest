<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $petugas = User::all();
        return view('petugas.index', compact('petugas'));
    }

    public function getNamaPetugas()
    {
        $users = User::pluck('name', 'id');
        return response()->json($users);
    }

    // Method lainnya bisa ditambahkan sesuai kebutuhan
}
