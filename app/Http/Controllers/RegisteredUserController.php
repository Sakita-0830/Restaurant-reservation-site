<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller{
    public function index(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function thanks(){
        return view('thanks');
    }

    public function mypage(){
        return view('mypage');
    }
}
