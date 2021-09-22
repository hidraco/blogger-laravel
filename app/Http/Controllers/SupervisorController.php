<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function __invoke()
    {
        $users = User::query()
            ->when(\request()->has('search') , function ($q) {
                $q->where( function ($q) {
                    $q->where('first_name' , "LIKE", "%".\request()->get('search')."%")
                        ->orWhere('last_name' , "LIKE", "%".\request()->get('search')."%")
                        ->orWhere('email' , "LIKE", "%".\request()->get('search')."%");
                });
            })
            ->where('id', '<>' , auth()->id())
            ->where('user_type',  User::USER_SUPERVISOR_TYPE)
            ->paginate(20);

        return view('supervisor.index', compact('users'));
    }
}
