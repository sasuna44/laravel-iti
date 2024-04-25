<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    function index(){
        $user= User::all();
        return UserResource::collection($users);
    }
}
