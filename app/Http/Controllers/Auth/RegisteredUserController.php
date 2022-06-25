<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ParentStudent;
use App\Models\Student;
use App\Models\User;
use App\Models\StaffMember;
use App\Models\UserTypeList;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeStudent(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'classroom' => ['required'],
        ]);

        $profile_photo = "default-profile-photo.jpg";

        if($request->file('profile_photo')){
            $file= $request->file('profile_photo');
            $filename= date('YmdHi').Str::random(6);
            $file-> move(public_path('public/assers/profile_pictures'), $filename);
            $profile_photo= $filename;
        }


        try{
            $student = Student::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'profile_photo' => $profile_photo,
                'classroom_id' => $request->classroom,
            ]);
        }
        catch(Exception $e){
            dd($e);
            return redirect()->route('admin')->with('error', ' Error! Student could not be added');
        }
        

        // event(new Registered($student));



        return redirect()->route('admin')->with('success', ' Student successfully added');
    }

    public function storeTeacher(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'staff_number' => ['required', 'string', 'min:6', 'unique:staff_members']
        ]);

        $profile_photo = "default-profile-photo.jpg";

        if($request->file('profile_photo')){
            $file= $request->file('profile_photo');
            $filename= date('YmdHi').Str::random(6);
            $file-> move(public_path('public/assers/profile_pictures'), $filename);
            $profile_photo= $filename;
        }

        try{
            $teacher = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'profile_photo' => $profile_photo,
                'email' => $request->email,
                'password' => Hash::make(Str::random(11)),
            ]);

            $staffMember = StaffMember::create([
                'staff_number' => $request->staff_number,
                'user_id' => $teacher->id,
            ]);

            $roles = UserTypeList::create([
                'user_id' => $teacher->id,
                'user_type_id' => $request->role,
            ]);

            if($request->classroom != 0){
                $classroom = Classroom::find($request->classroom);
                $classroom->class_teacher = $teacher->id;
                $classroom->save();
            }
            
        }
        catch(Exception $e){
            return redirect()->route('admin')->with('error', ' Error! Teacher could not be added');
        }
        

        return redirect()->route('admin.teachers')->with('success', ' Teacher successfully added');
    }
    
    public function storeParent(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);


        $profile_photo = "default-profile-photo.jpg";

        try{
            $parent = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'profile_photo' => $profile_photo,
                'email' => $request->email,
                'password' => Hash::make(Str::random(11)),
            ]);

           $userTypeList = UserTypeList::create([
                'user_id' => $parent->id,
                'user_type_id' => 1,
           ]);

        }
        catch(Exception $e){
            dd($e);
            return redirect()->route('admin')->with('error', ' Error! Parent could not be added');
        }
        

        return redirect()->route('admin.parents')->with('success', ' Parent successfully added');
    }
}
