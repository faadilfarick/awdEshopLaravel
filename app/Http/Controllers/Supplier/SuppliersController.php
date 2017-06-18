<?php
namespace App\Http\Controllers\Supplier;
use App\Http\Models\Supplier;
use \Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Exception;
use \Config;
class SuppliersController extends Controller
{
    public function index(){

        $suppliers = Supplier::all();
        return view('supplier.index')->with('suppliers',$suppliers);
    }

    public function addSupplier(){
        return view('supplier.add_suppliers');
    }
    public function saveSupplier(Request $request){

        if(!$request->has('supplier_code')){
            return response()->json([
                'status'=>'FAILED',
                'error'=> Config::get('custom_messages.SUPPLIER_CODE_REQUIRED')
            ],200);
        }


        try{
            $supplier = new Supplier();
            $supplier->supplier_code      = $request->supplier_code;
            $supplier->supplier_name      = $request->supplier_name;
            $supplier->supplier_telephone = $request->supplier_telephone;
            $supplier->supplier_address   = $request->supplier_address;

            if($supplier->save()){
                return response()->json([
                    'status'=>'SUCCESS',
                    'message'=> Config::get('custom_messages.NEW_SUPPLIER_ADDED')
                ],200);
            }



        }catch(Exception $e){


            Log::error($e->getMessage());

            return response()->json([
                'status'=>'FAILED',
                'error'=> Config::get('custom_messages.ERROR_WHILE_SUPPLIER_ADDING')
            ],200);
        }
    }
}