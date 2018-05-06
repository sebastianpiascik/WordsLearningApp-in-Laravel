<?php

namespace App\Http\Middleware;

use App\Subcategory;
use App\WordsList;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Middleware sprawdza czy mozesz edytowac dany zestaw

        // Get all words_lists with user_id eq current user
        $user_id = Auth::user()->id;
        $words_lists_with_id = WordsList::where('user_id',$user_id)->get();

        // Make array
        $words_lists = [];
        foreach ($words_lists_with_id as $w){
            array_push($words_lists, $w->name);
        }

        // Get list to open
        $words_list_id = request()->route('words_list')->id;
        $words_list = WordsList::where('id',$words_list_id)->first();

        $select = DB::table('subcategory_user')
            ->where('subcategory_id', $words_list->subcategory_id)
            ->where('user_id', $user_id)
            ->exists();

//        dd($select);

        if(Auth::user()->roles()->first()->name != 'admin'){
            if($select == true){
                if($words_list->subcategory_id == 1 && $words_list->user_id != Auth::user()->id){
                    return redirect('/words_lists')->with('success','Nie masz pozwolenia na edycję prywatnego zestawu');
                }
                if(Auth::user()->roles()->first()->name == 'redaktor'){
                    if (! in_array($words_list->name, $words_lists)) {
                        return redirect('/words_lists')->with('success','Nie masz pozwolenia na edycję zestawu');
                    }
                }
            } else{
                return redirect('/words_lists')->with('success','Nie masz pozwolenia na edycję podkategorii');
            }
        }


        return $next($request);
    }
}
