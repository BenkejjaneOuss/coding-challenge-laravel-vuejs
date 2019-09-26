<?php
namespace App\Services;
 
use \App\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;


class ItemsService
{
    public function getAll(int $skip)
    {
        $items = Item::where('user_id', Auth::user()->id)->skip($skip-1)->take(10)->get();
        return $items;
    }

    public function addItem(Object $request)
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
        if (file_put_contents($pathName, $data)) {
            $item->image = $name;
        }
        /*** End Upload Image ***/
        if ($item->save()) {
            $result = true;
        }

        return $result;
    }
}
