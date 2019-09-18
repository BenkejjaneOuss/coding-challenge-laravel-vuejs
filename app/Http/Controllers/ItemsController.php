<?php

namespace App\Http\Controllers;


use App\Item;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;


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

        $result = false;

        $item = new Item();
        $item->title = $request->title;
        $item->description = $request->description;
        $item->user_id 	= Auth::user()->id;

        /*** Upload Image ***/
        $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        $data =  $request->image;
        // RETRIEVE TYPE
        list($type, $data)  = explode(";", $data);

        // RETRIEVE IMG BASE64
        list(, $data)   = explode(",", $data);
        $data           = base64_decode($data);


        $pathName       = storage_path('app/public/images/'.$name);

        // CREATE AND MOVE NEW IMAGE IN DIRECTORY
        if(file_put_contents($pathName, $data)){
            $item->image = $name;
        }
        /*** End Upload Image ***/

        if($item->save()){
            $result = true;
        }

        return Response()->json(compact('result'));   
    }
}
