<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    public function index(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('admin.users.index');
    }
}
