<?php

namespace App\Http\Controllers;

use App\Word;
use App\WordsList;
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

//        dd($user);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Word::all();
        $words_lists = WordsList::all();

        return view('words.index',compact('words'),compact('words_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $words_lists = WordsList::all();

        return view('words.create',compact('words_lists'));
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
            'word' => 'required',
        ]);


        Word::create($request->all());

        return redirect()->route('words.index')
            ->with('success','Słówko zostało dodane');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        $words_lists = WordsList::all();
        return view('words.show',compact('word'),compact('words_lists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {
        $words_lists = WordsList::all();
        return view('words.edit',compact('word'),compact('words_lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        request()->validate([
            'word' => 'required',
        ]);


        $word->update($request->all());


        return redirect()->route('words.index')
            ->with('success','Słówko zostało zaktualizowane');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        $word->delete();


        return redirect()->route('words.index')
            ->with('success','Słówko zostało usunięte');
    }
}
