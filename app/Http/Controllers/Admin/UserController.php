<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'users' => User::paginate(10)
        ]);
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect('dashboard');
    }
}
