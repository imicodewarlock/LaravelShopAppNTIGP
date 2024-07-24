<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id')->paginate(10);
        return view('dashboard.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = new User();
        $user->name = $request->fullName;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        switch ($request->role) {
            case '2':
                # code...
                $user->role = 'editor';
                break;
            case '3':
                # code...
                $user->role = 'supervisor';
                break;
            case '4':
                # code...
                $user->role = 'admin';
                break;
            default:
                # code...
                $user->role = 'user';
                break;
        }

        // dd($user);

        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'fullName' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);


        $user->name = $request->fullName;
        $user->username = $request->username;
        $user->email = $request->email;

        if (isset($user->password)) {
            # code...
            $user->password = Hash::make($request->password);
        }

        switch ($request->role) {
            case '2':
                # code...
                $user->role = 'editor';
                break;
            case '3':
                # code...
                $user->role = 'supervisor';
                break;
            case '4':
                # code...
                $user->role = 'admin';
                break;
            default:
                # code...
                $user->role = 'user';
                break;
        }

        // dd($user);

        $user->update();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function activate(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('users.index');
    }
}
