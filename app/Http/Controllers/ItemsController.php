<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
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
        return view('home');
    }

    /**
     * Get all items.
     *
     */
    public function getItems($page)
    {
        $skip = $page-1;
        $items = Item::where('user_id', Auth::user()->id)->skip($skip)->take(10)->get();
        return Response()->json(compact('items')); 
    }
}
