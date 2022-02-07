<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('orphans.add-details');
    }

    public function store(Request $request)
    {
        $user=Auth::user();
     $request->validate([
         'death_certificate_mother'=>'required_when:dead,mother',
         'death_certificate_father'=>'required_when:dead,father',
         'dead'=>'required|in:both,father,mother',
         'birth_certificate'=>'required'
     ]);
        $birth_certificate='';
        if ($request->hasFile('birth_certificate'))
        {
            $file=$request->file('birth_certificate');
            $birth_certificate=$file->store('/details','uploads');
        }
        $death_certificate_mother='';
        if ($request->hasFile('death_certificate_mother'))
        {
            $file=$request->file('death_certificate_mother');
            $death_certificate_mother=$file->store('/details','uploads');
        }
        $death_certificate_father='';
        if ($request->hasFile('death_certificate_father'))
        {
            $file=$request->file('death_certificate_father');
            $death_certificate_father=$file->store('/details','uploads');
        }
     $user->details()->create([
         'birth_certificate'=>$birth_certificate,
         'death_certificate_father'=>$death_certificate_father,
         'death_certificate_mother'=>$death_certificate_mother,
         'dead'=>$request->post('dead')
     ]);

        return redirect()->route('orphan.dashboard');

    }

    public function addWallet(Request $request)
    {
        $request->validate([
            'value_pay'=>'required|numeric'
        ]);

        $user=Auth::user();
        $user->wallet=$request->value_pay;
        $user->save();

        return redirect()->back()->with(['success'=>'Pay is successful']);
    }
}
