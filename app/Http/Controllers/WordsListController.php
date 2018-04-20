<?php

namespace App\Http\Controllers;

use App\User;
use App\Word;
use App\WordsList;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WordsListController extends Controller
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
        $words_lists = WordsList::all();
        $subcategories = Subcategory::all();
        $users = User::all();


        return view('words_lists.index',compact('words_lists','subcategories','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = DB::select('select * from subcategories where id IN (SELECT subcategory_id FROM subcategory_user where user_id='.Auth::user()->id.')');
        $subcategories = Subcategory::all();

        if(Auth::user()->roles()->first()->name != 'admin'){
            if($permissions == null){
                return view('words_lists.create',compact('subcategories','permissions'))
                    ->with('success','Możesz tworzyć tylko prywatne zestawy');
            }
        }

        return view('words_lists.create',compact('subcategories','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);

        dd($request->all());

        $newWordsList = WordsList::create($request->all());

        // add words
        $rows = $request->input('word_name');
        foreach ($rows as $row)
        {
            $word = new Word();
            $word->word = $row;
            $word->words_list_id = $newWordsList->id;
            $word->save();
        }

        return redirect()->route('words_lists.index')
            ->with('success','Zestaw słówek został utworzony');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WordsList  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(WordsList $words_list)
    {
        $subcategories = Subcategory::all();
        return view('words_lists.show',compact('words_list'),compact('subcategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WordsList  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(WordsList $words_list)
    {
        $permissions = DB::select('select * from subcategories where id IN (SELECT subcategory_id FROM subcategory_user where user_id='.Auth::user()->id.')');
        $subcategories = Subcategory::all();

        if(Auth::user()->roles()->first()->name != 'admin'){
            if($permissions == null){
                return redirect()->route('words_lists.index')
                    ->with('success','Nie masz dostępu do żadnej podkategorii');
            }
        }

        return view('words_lists.edit',compact('words_list','subcategories','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WordsList  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WordsList $words_list)
    {
        request()->validate([
            'name' => 'required',
        ]);


        $words_list->update($request->all());


        return redirect()->route('words_lists.index')
            ->with('success','Zestaw słówek został zaktualizowany');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WordsList  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(WordsList $words_list)
    {
        $words_list->delete();


        return redirect()->route('words_lists.index')
            ->with('success','Zestaw słówek został usunięty');
    }
}
