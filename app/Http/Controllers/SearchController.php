<?php

namespace Chatty\Http\Controllers;

use DB;
use Chatty\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getResults(Request $request){
        $query= $request->input('query');
        if (!$query){
            return redirect()->route('home')->with('error', 'No result found for your search. Try another search');
        }
        $users= User::where(DB::raw("CONCAT(first_name,'', last_name)"),'LIKE',"%{$query}%")->orWhere('username','LIKE',"%{$query}%")->get();

        return view('search.results')->with('users', $users);
    }
}
