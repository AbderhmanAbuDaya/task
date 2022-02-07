<?php

namespace App\Http\Controllers;

use App\Models\SponsorOrphan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=Auth::user();
        $orphan=User::find($request->post('orphan_id'));

        $request->validate([
            'orphan_id'=>'required|exists:users,id',
            'warranty_value'=>'required|numeric',
            'warranty_period'=>'required|numeric'
        ]);
        if ($user->wallet < $request->post('warranty_value'))
            return redirect()->back()->with(['error'=>'Wallet is not enough']);

    $x=    SponsorOrphan::create([
            'sponsor_id'=>$user->id,
            'orphan_id'=>$request->post('orphan_id'),
            'warranty_value'=>$request->post('warranty_value'),
            'warranty_period'=>$request->post('warranty_period'),
            'start_warranty_date'=>now()
        ]);
       if ($x){
           $user->wallet-=$request->post('warranty_value');
           $user->save();
           $orphan->wallet+=$request->post('warranty_value');
           $orphan->save();

           $details = [
               'title' => 'تم كفالتك',
               'body' => 'تم كفالتك ب مبلغ '.$request->post('warranty_value').' لمدة  اشهر' .$request->post('warranty_period')
           ];

           Mail::to($orphan->email)->send(new \App\Mail\SendOrphanMail($details));

       }
        return redirect()->back()->with(['success'=>'successful add to orphan']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ie=SponsorOrphan::where('sponsor_id',Auth::id())->where('orphan_id',$id)->first();

        $ie->delete();

        return redirect()->back()->with(['success'=>'delete successful']);
    }
}
