<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function store(Request $request)
    {
//        return $request;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_number'=>['required','numeric','min:8'],
//            'image'=>['image'],
            'date_birth'=>['required','date'],
//            'id_image'=>['image'],
            'type'=>['required','in:sponsor,orphan'],
        ]);
        $image='';
        if ($request->hasFile('image'))
        {
            $file=$request->file('image');
            $image=$file->store('/users','uploads');
        }
        $id_image='';
        if ($request->hasFile('id_number'))
        {
            $file=$request->file('id_number');
            $id_image=$file->store('/ids','uploads');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'id_number'=>$request->id_number,
            'image'=>$image,
            'date_birth'=>$request->date_birth,
            'id_image'=>$id_image,
            'type'=>$request->type,
            'password' => Hash::make($request->password),


        ]);

        event(new Registered($user));

        Auth::login($user);
       if ($user->type=='sponsor')
        return redirect(RouteServiceProvider::HOME_SPONSOR);

        return redirect(RouteServiceProvider::HOME_ORPHAN);
    }
}
