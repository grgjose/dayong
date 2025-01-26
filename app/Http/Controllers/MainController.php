<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class MainController extends Controller
{
    //
    public function index(){
        if(auth()->check()){
            return redirect('/dashboard');
        } else {
            return view('forms.login');
        }
    }

    public function dashboard(){
        if(auth()->check()){

            $today = date('Y-m-d');
            $my_user = auth()->user();

            $collections = DB::table('entries')
            ->where('created_at', '>', $today.' 00:00:00')
            ->where('created_at', '<', $today.' 23:59:59')->get();

            $active_agents = DB::table('users')
            ->where('status', '=', 'active')
            ->count();

            $collections_today = $collections->count();
            $total_col_this_month = 0;

            foreach($collections as $col){
                if($col->remarks != "REGISTRATION"){
                    $total_col_this_month = $total_col_this_month + $col->amount;
                }
            }

            $members_today = DB::table('members')
            ->where('created_at', '>', $today.' 00:00:00')
            ->where('created_at', '<', $today.' 23:59:59')
            ->count();

            $entries = DB::table('entries')
            ->where('created_at', '>', $today.' 00:00:00')
            ->where('created_at', '<', $today.' 23:59:59')
            ->get();

            $profit_today = 0;
            foreach($entries as $entry){
                $profit_today = $profit_today + (int)$entry->amount;
            }

            return view('main', [
                'my_user' => $my_user,
                'active_agents' => $active_agents,
                'collections_today' => $collections_today,
                'total_col_this_month' => $total_col_this_month,
                'members_today' => $members_today,
                'profit_today' => $profit_today,
            ])
            ->with('header_title', 'Dashboard')
            ->with('subview', 'dashboard-contents.modules.dashboard')
            ->with('greet_icon', 'yes');
            
        } else {
            return view('forms.login');
        }
    }

    public function login(Request $request){
        $validated = $request->validate([
            "username" => ['required', 'min:2'],
            "password" => ['required', 'min:2']
        ]);
        
        $remember = $request->input("remember_me");

        if(auth()->attempt($validated, $remember) || auth()->viaRemember()){
            $request->session()->regenerate();
            return redirect('/');
        } else {
            return redirect('/')->with('error_msg', 'Invalid Credentials!');
        }
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile(){
        if(auth()->check()){

            $my_user = auth()->user();
            $members = DB::table('members')->orderBy('id')->get();
            $programs = DB::table('programs')->orderBy('id')->get();
            $branches = DB::table('branches')->orderBy('id')->get();
            $entries = DB::table('entries')->orderBy('id')->get();
            $users = DB::table('users')->orderBy('id')->get();

            return view('main', [
                'my_user' => $my_user,
                'members' => $members,
                'programs' => $programs,
                'branches' => $branches,
                'entries' => $entries,
                'users' => $users
            ])
            ->with('header_title', 'My Profile')
            ->with('subview', 'dashboard-contents.modules.profile');

        } else {
            return redirect('/');
        }
    }

}
