<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function search(Request $request){
        return User::where('email', 'LIKE', '%'.$request->searchTerm.'%')
                ->whereNotIn('email', [User::find(Auth::id())->email])
                ->get();
    }
}
