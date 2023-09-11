<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersRecordController extends Controller
{
    public function usersRecordTable()
    {
        return view('usersrecord');
    }
    
    public function showUsersRecord() {
        $users = DB::table('users')->get();
        return view('usersrecord', ['users' => $users]);
    }

    public function deleteUsersRecord($id)  
    { 
        $users = User::where('id', $id)->firstorfail()->delete();
        return back()->with('message', 'User record has been deleted');
    }  

    public function editUsersRecord($id)  
    { 
        $users = User::findOrFail($id);
        return view('editusersrecord',compact('users'));
    }  

    public function updateUsersRecord(Request $request, $id)  
    { 
        $credentials = $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250'
        ]);
        $users = User::where('id', $id)->update($credentials);
        return redirect('/usersrecordtable')->with('message', 'User record is successfully updated');
    }  
      
}
