<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'users' => User::paginate(15)
        ]);
    }
}
