<?php

namespace App\Http\Controllers;

use App\Subcategory;
use App\User;
use App\Role;
use App\WordsList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        // load the view and pass the nerds
        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->roles()->first()->name != 'administrator'){
            if(Auth::user()->id != $id){
                return redirect('/')->with('success','To nie jest twój profil');
            }
        }

        $words_lists = WordsList::all();
        $subcategories = Subcategory::all();

        $user_id = User::findOrFail($id)->id;
        $results = DB::select('select * from results where user_id='.$user_id);


        return view('users.show', ['user' => User::findOrFail($id)],compact('results','words_lists','subcategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $permissions = DB::select('select * from subcategories where id IN (SELECT subcategory_id FROM subcategory_user where user_id='.$user->id.')');
        $subcategories = Subcategory::all();
        $roles = Role::all();

//        dd($permissions);

        return view('users.edit',compact('user','roles','subcategories','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        request()->validate([
            'name' => 'required',
        ]);

        $role = Role::where('id', request()->role_id)->first();
        DB::delete('delete from role_user where user_id='.$user->id);
        $user->roles()->attach($role);

        if(request()->subcategory_id != 0){
            $subcategory = Subcategory::where('id', request()->subcategory_id)->first();
            $user->subcategories()->attach($subcategory);
        }
        if(request()->remove_subcategory_id != 0){
            DB::delete('delete from subcategory_user where subcategory_id='.request()->remove_subcategory_id.' AND user_id='.$user->id);
        }

        $user->update($request->all());


        return redirect()->route('users.index')
            ->with('success','Uzytkownik zostal zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();


        return redirect()->route('users.index')
            ->with('success','Uzytkownik zostal usuniety');
    }
}