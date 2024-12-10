<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function getUser($id)
    {
        $user = User::findOrFail($id);

        return response()->json(['user' => $user]);
    }

    public function users()
    {
        $query = request()->get('query');

        if ($query) {

            $users = User::where('id', $query)->orWhere('email', $query)->get();
        } else {

            $users = User::orderBy('id', 'desc')->paginate(10);
        }

        return Inertia::render('Admin/Users/Users', ['users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['banned' => 'required']);

        $user = User::findOrFail($id);

        $user->update(['banned' => $request->banned]);

        return Redirect::route('admin.users')->with('status', 'User Updated!');
    }   

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return Redirect::route('admin.users')->with('status', 'User Deleted');
    }
}
