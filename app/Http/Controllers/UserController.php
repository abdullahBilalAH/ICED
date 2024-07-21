<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('error', 'Unauthorized action.');
    }
    public function index()
    {
        $user = User::all();
        return view('Admin.customersTable', ['DB' => $user]);
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);

        //user or admin
        if ($user['user_type'] == "user")
            $user->user_type = 'admin';
        else
            $user->user_type = 'user';

        // Update the user's usertype to "admin"
        $user->save();

        return redirect()->route('customerTable');
    }
    public function destroy($id)
    {
        // Find the item by its ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('customerTable')->with('error', 'Item not found.');
        }

        // Delete the item
        $user->delete();

        // Optionally, you can return a response or redirect
        return redirect()->route('customerTable')->with('success', 'user deleted successfully.');
    }
}
