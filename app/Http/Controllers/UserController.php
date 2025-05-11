<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('user.index', [
            'users' => User::where('role', '=', 'owner')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:users|max:100',
            'password' => 'required|max:20'
        ]);

        $validated['role'] = 'owner';

        User::create($validated);

        return redirect('user')->with('success', 'Berhasil menambahkan owner');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        // if (Auth::user()->role != 'owner') {
        //     return back();
        // }

        
        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:200', 
            'email' => 'required|max:100',
            'password' => 'required|max:20'
        ];

        if ($user->email != $request->email) {
            $rules['email'] = 'required|max:100|unique:users';
        }

        $validated = $request->validate($rules);

        $user->update($validated);

        return redirect('user')->with('success', 'Berhasil mengupdate data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Berhasil menghapus data');
    }
}
