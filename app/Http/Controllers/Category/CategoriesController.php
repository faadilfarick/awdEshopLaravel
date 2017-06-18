<?php
namespace App\Http\Controllers\Category;
use App\Http\Models\Category;
use \Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Exception;
use \Config;
class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('category.index')->with('categories',$categories);
    }
    public function addCategory(){
        return view('category.add_categories');
    }
    public function saveCategory(Request $request){
        if(!$request->has('title')){
            return response()->json([
                'status'=>'FAILED',
                'error'=> Config::get('custom_messages.CAT_TITLE_REQUIRED')
            ],200);
        }


        try{
            $category = new Category();
            $category->title            = $request->title;
            $category->description      = $request->description;
            $category->parent_id        = $request->parent_id;
            $category->status           = Category::ACTIVE;

            if($category->save()){
                return response()->json([
                    'status'=>'SUCCESS',
                    'message'=> Config::get('custom_messages.NEW_CAT_ADDED')
                ],200);
            }



        }catch(Exception $e){


            Log::error($e->getMessage());

            return response()->json([
                'status'=>'FAILED',
                'error'=> Config::get('custom_messages.ERROR_WHILE_CAT_ADDING')
            ],200);
        }

    }
}