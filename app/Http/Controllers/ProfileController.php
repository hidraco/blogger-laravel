<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __invoke(ProfileRequest $request)
    {
        $user = Auth::user();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if ($request->has('password') && !empty($request->get('password')))
        {
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();

        return redirect()->route('dashboard');
    }
}
