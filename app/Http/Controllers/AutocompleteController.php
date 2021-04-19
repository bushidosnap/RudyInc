<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class AutocompleteController extends Controller
{
    //for create controller - php artisan make:controller AutocompleteController

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
     return view('autocomplete');
    }

    public function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('users')
        ->where('email', 'LIKE', "%{$query}%")
        ->Where('type','=', 'customer')
        ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li><a href="#">'.$row->email.', '.$row->name.'</a></li>';
      }
      $output .= '</ul>';
      echo $output;
     }
    }
}
