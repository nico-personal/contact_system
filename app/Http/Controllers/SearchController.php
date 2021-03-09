<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index()
    {
        return view('contacts.index');
    }

     public function search( Request $request )
    {
        // return $request;
        
            $output="";
            $contacts=DB::table('contacts')->where('name','LIKE','%'.$request->search."%")
            ->orWhere('mobile','LIKE','%'.$request->search."%")
            ->orWhere('company','LIKE','%'.$request->search."%")
            ->orWhere('email','LIKE','%'.$request->search."%")
            ->get();
            return $contacts;
        // 
    }
}
