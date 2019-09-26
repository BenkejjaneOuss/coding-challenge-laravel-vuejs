<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ItemsService;

class ItemsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ItemsService $items)
    {
        $this->middleware('auth');
        $this->items = $items;
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
    public function getItems($skip)
    {
        $items = $this->items->getAll($skip);
        return Response()->json(compact('items')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.addItem');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->items->addItem($request);
        return Response()->json(compact('result'));   
    }
}
