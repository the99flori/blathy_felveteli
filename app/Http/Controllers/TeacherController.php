<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    //TODO:: under construction!
    public function index(){

        $user = Auth::user();

        $meetings = $user->panels->first() != null ? $user->panels->first()->meetings:null;
        if($user->role = 'admin'){
            $meetings = Meeting::all();
        }

        return view('private.index',[
            "meetings" => $meetings,
        ]);
    }
}
