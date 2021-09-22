<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
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
            ->when(auth()->user()->is_supervisor , function ($q) {
                $q->whereHas('supervisors', function ($q) {
                    $q->where('id', auth()->id());
                });
            })
            ->paginate(20);

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view("user.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->user_type = $request->get('user_type');

        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::find($id);

        $bloggers = User::query()
            ->where('user_type', User::USER_BLOGGER_TYPE)
            ->get()
            ->pluck('name', 'id')
            ->toArray();

        $assigned_bloggers = $user->assignedBloggers()->pluck('id')->toArray();

        return view('user.show', compact('user', 'bloggers', 'assigned_bloggers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);

        $bloggers = User::query()
            ->where('user_type', User::USER_BLOGGER_TYPE)
            ->get()
            ->pluck('name', 'id')
            ->toArray();

        $assigned_bloggers = $user->assignedBloggers()->pluck('id')->toArray();

        return view('user.edit', compact('user', 'bloggers', 'assigned_bloggers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);

        if ($request->has('password') && !empty($request->get('password')))
        {
            $user->password = bcrypt($request->get('password'));
        }

        $user->user_type = $request->user_type;

        $user->save();

        if ($user->user_type == User::USER_SUPERVISOR_TYPE)
        {
            $user->assignedBloggers()->sync($request->get('assign_bloggers', []));
        }
        else
        {
            $user->assignedBloggers()->sync([]);
        }

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('user.index');
    }
}
