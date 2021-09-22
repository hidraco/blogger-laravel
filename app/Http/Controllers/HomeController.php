<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_users = 0;

        if (auth()->user()->is_admin)
        {
            $total_blogs = Blog::query()->count();
            $total_users = User::query()->where('id', '<>', auth()->id())->count();
        }
        elseif (auth()->user()->is_supervisor)
        {
            $total_blogs = Blog::query()->where( function ($q) {
                $q->where('created_by', auth()->id())
                    ->orWhereHas('createdBy',  function ($q) {
                        $q->whereIn('id', auth()->user()->assignedBloggers->pluck('id')->toArray());
                    });
            })->count();

            $total_users = auth()->user()->assignedBloggers()->count();
        }
        else
        {
            $total_blogs = Blog::query()->where('created_by' , auth()->id())->count();
        }

        return view('dashboard', compact('total_blogs', 'total_users'));
    }
}
