<?php
namespace App\Http\Controllers\Item;
use App\Http\Models\Item;
use \Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Exception;
use \Config;
class ItemsController extends Controller
{
    public function getItem(){
        $items = Item::all();
        return response()->json([
                'status'=>'SUCCESS',
                'items'=> $items->all(),
            ],200);
    }

    
    public function index(){
        $items = Item::all();
        return view('item.index')->with('items',$items);
    }
    public function addItem(){
        return view('item.add_items');
    }
    public function viewItem($id){
    	//$items = Item::all();
        //$items = Item::all()->sortBy("title");
        $items = Item::all()->where('id', $id);
	
	
	return view('item.view_item')->with('items',$items);
	}
	    public function saveItem(Request $request){
        if(!$request->has('title')){
            return response()->json([
                'status'=>'FAILED',
                'error'=> Config::get('custom_messages.ITEM_TITLE_REQUIRED')
            ],200);
        }


        try{
            $item = new Item();
            $item->title            = $request->title;
            $item->description      = $request->description;
            $item->category_id      = $request->category_id;
            $item->unit_price       = $request->unit_price;
            $item->max_retail_price = $request->max_retail_price;
            $item->quantity         = $request->quantity;
            $item->reorder_level    = $request->reorder_level;
            $item->supplier_id      = $request->supplier_id;
            $item->status           = Item::ACTIVE;

            if($item->save()){
                return response()->json([
                    'status'=>'SUCCESS',
                    'message'=> Config::get('custom_messages.NEW_ITEM_ADDED')
                ],200);
            }



        }catch(Exception $e){


            Log::error($e->getMessage());

            return response()->json([
                'status'=>'FAILED',
                'error'=> Config::get('custom_messages.ERROR_WHILE_ITEM_ADDING')
            ],200);
        }
    }
}