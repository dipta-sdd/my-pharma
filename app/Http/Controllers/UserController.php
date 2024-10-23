<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static function index(Request $request)
    {
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'manager') {
            $users = User::selectRaw('users.* , branches.name as branch_name , c.name as createdBy , u.name as updatedBy')
                ->leftJoin('branches', 'users.branch_id', '=', 'branches.id')
                ->leftJoin('users as c', 'users.created_by', '=', 'c.id')
                ->leftJoin('users as u', 'users.updated_by', '=', 'u.id')
                ->get();
            dd(json_encode($users));
        }
        //  else if (auth()->user()->role == 'branch_manager') {
        //     $users = User::selectRaw('users.* , branches.name as branch_name')
        //         ->join('branches', 'users.branch_id', '=', 'branches.id')
        //         ->where('users.branch_id', auth()->user()->id)->get();
        // } 
        else {
            redirect('/dashboard');
        }
        return view('users', ['users' => $users]);
    }
}
