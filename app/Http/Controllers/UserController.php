<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class UserController extends Controller
{

    public function index(){
        if(auth()->check()){

            $my_user = auth()->user();
            $users = DB::table('users')->orderBy('id')->get();

            return view('main', [
                'my_user' => $my_user,
                'users' => $users,
            ])
            ->with('header_title', 'Users')
            ->with('subview', 'dashboard-contents.settings.user-accounts');

        } else {
            return redirect('/');
        }
    }

    public function profile(){
        if(auth()->check()){

            $my_user = auth()->user();

            return view('main', [
                'my_user' => $my_user
            ])
            ->with('header_title', 'Users')
            ->with('subview', 'dashboard-contents.settings.profile');

        } else {
            return redirect('/');
        }
    }

    public function store(Request $request){
        if(auth()->check()){

            // Get Request Data
            $validated = $request->validate([
                "username" => ['required'],
                "usertype" => ['required'],
                "fname" => ['required'],
                "mname" => ['required'],
                "lname" => ['required'],
                "email" => ['required'],
                "birthdate" => ['required'],
                "contact_num" => ['required'],
                "password" => ['nullable'],
            ]);

            // Get Next Auto Increment
            $statement = DB::select("SHOW TABLE STATUS LIKE 'users'");
            $nextId = $statement[0]->Auto_increment;

            if($request->hasFile('profile_pic')){
                $ext = $request->file('profile_pic')->extension();
                $request->file('profile_pic')->storeAs('profile_pic', $nextId.".".$ext ,'public');
                $filename = $nextId.".".$ext;
            } else {
                $filename = "default.png";
            }

            // Save Request Data
            $contents = new User();

            $contents->username = $validated['username'];
            $contents->usertype = $validated['usertype'];
            $contents->fname = $validated['fname'];
            $contents->mname = $validated['mname'];
            $contents->lname = $validated['lname'];
            $contents->email = $validated['email'];
            $contents->birthdate = $validated['birthdate'];
            $contents->contact_num = $validated['contact_num'];
            $contents->profile_pic = $filename;
            $contents->password = $validated['password'];

            $contents->save();

            // Back to View
            return redirect('/user-accounts')->with("success_msg", $contents->code." User Created Successfully");

        } else {
            return redirect('/');
        }
    }

    public function update(Request $request, $id){
        if(auth()->check()){

            // Get Request Data
            $validated = $request->validate([
                "username" => ['nullable'],
                "usertype" => ['nullable'],
                "fname" => ['nullable'],
                "mname" => ['nullable'],
                "lname" => ['nullable'],
                "email" => ['nullable'],
                "birthdate" => ['nullable'],
                "contact_num" => ['nullable'],
                "password" => ['nullable'],
            ]);

            // Save Request Data
            $contents = User::find($id);

            if($request->hasFile('profile_pic')){
                $ext = $request->file('profile_pic')->extension();
                $request->file('profile_pic')->storeAs('profile_pic', $id.".".$ext ,'public');
                $filename = $id.".".$ext;
                $contents->profile_pic = $filename;
            }

            $contents->username = $validated['username'];
            
            if(isset($validated['usertype'])){
                $contents->usertype = $validated['usertype'];
            }

            $contents->fname = $validated['fname'];
            $contents->mname = $validated['mname'];
            $contents->lname = $validated['lname'];
            $contents->email = $validated['email'];
            $contents->birthdate = $validated['birthdate'];
            $contents->contact_num = $validated['contact_num'];
            $contents->updated_at = date('Y-m-d G:i:s');

            if($validated['password'] != ""){
                $contents->password = $validated['password'];
            }

            $contents->save();

            // Back to View
            if(isset($validated['usertype'])){
                return redirect('/user-accounts')->with("success_msg", $contents->lname." User Updated Successfully");
            } else {
                return redirect('/profile')->with("success_msg", "Profile Updated Successfully");
            }
            

        } else {
            return redirect('/');
        }
    }

    public function destroy(Request $request){
        if(auth()->check()){

            // Destroy Request Data
            User::where("id", $request->input("id"))->delete();
            return redirect('/user-accounts')->with("success_msg", "Deleted Successfully");

        } else {
            return redirect('/');
        }
    }

    public function change(Request $request){
        if(auth()->check()){
            $my_user = auth()->user();
            if($request->hasFile('profile_pic')){
                $ext = $request->file('profile_pic')->extension();
                $request->file('profile_pic')->storeAs('profile_pic', $my_user->id.".".$ext ,'public');
                $filename = $my_user->id.".".$ext;
            } else {
                $filename = "default.png";
            }

            $contents = User::find($my_user->id);
            $contents->profile_pic = $filename;
            $contents->save();

            // Back to View
            return redirect('/profile')->with("success_msg", $contents->lname." Profile Picture Updated Successfully");

        } else {
            return redirect('/');
        }
    }

}
