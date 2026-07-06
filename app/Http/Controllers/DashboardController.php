<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('users.index');
        }

        $userPermissions = $user->getAllPermissions();

        return view('users.dashboard', compact('userPermissions'));
    }
}
