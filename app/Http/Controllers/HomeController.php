<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Word;
use App\WordsList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('home',compact('categories'));
    }

    /**
     * Show subcategories.
     */
    public function showSubcategories(Request $request){
        $category = $request->input('category');
        $subcategories = Subcategory::whereRaw('category_id = '. intval($category))->get();

//        dd($subcategories);

        return view('choose_subcategory',compact('subcategories'));
    }

    /**
     * Show subcategories.
     */
    public function showWordsLists(Request $request){
        $subcategory = $request->input('subcategory');
        $category = Subcategory::all()->find($subcategory)->category_id;
        $words_lists = WordsList::whereRaw('subcategory_id = '. intval($subcategory))->get();

//        dd($subcategories);

        return view('choose_wordslist',compact('words_lists'),compact('category'));
    }

    /**
     * Show subcategories.
     */
    public function showLearningModes(Request $request){
        $words_list = $request->input('words_list');
        $subcategory = WordsList::all()->find($words_list)->subcategory_id;

        return view('choose_learning_mode',compact('words_list'),compact('subcategory'));
    }

    /**
     * Show words.
     */
    public function showModes(Request $request){
        $words_list = $request->input('words_list');
        $learning_mode = $request->input('learning_mode');
        $words = Word::whereRaw('words_list_id = '. intval($words_list))->get();

        return view('choose_mode',compact('words','words_list','learning_mode'));
    }

    /**
     * Show words.
     */
    public function learnWords(Request $request){
        $learning_mode = $request->input('learning_mode');
        $mode = $request->input('mode');
        $algorithm = $request->input('algorithm');
        $words_list = $request->input('words_list');
        $words = Word::whereRaw('words_list_id = '. intval($words_list))->get();

        return view('learn',compact('words','learning_mode','words_list','mode','algorithm'));
    }

    /**
     * Save reseults to database
     */
    public function storeResults(Request $request)
    {
        $data = $request->all(); // This will get all the request data.

        if(Auth::check()){
            DB::table('results')->insert(
                ['user_id' => Auth::user()->id, 'words_list_id' => $request->words_list_id, 'result' => $request->result]
            );
        }

        return $data;
    }
}
