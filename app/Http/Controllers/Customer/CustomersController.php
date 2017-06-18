<?php
namespace App\Http\Controllers\Customer;
use App\Http\Models\Customer;
use \Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Exception;
use \Config;
class CustomersController extends Controller
{
    public function index(){

        $customers = Customer::all();
        return view('customer.index')->with('customers',$customers);
    }

    public function addCustomer(){
        return view('customer.add_customers');
    }
    public function saveCustomer(Request $request){

        if(!$request->has('customer_code')){
            return response()->json([
                'status'=>'FAILED',
                'error'=> Config::get('custom_messages.CUSTOMER_CODE_REQUIRED')
            ],200);
        }


        try{
                $customer = new Customer();
                $customer->customer_code      = $request->customer_code;
                $customer->customer_name      = $request->customer_name;
                $customer->customer_email     = $request->customer_email;
                $customer->customer_telephone = $request->customer_telephone;
                $customer->customer_address   = $request->customer_address;

                if($customer->save()){
                    return response()->json([
                    'status'=>'SUCCESS',
                    'message'=> Config::get('custom_messages.NEW_CUSTOMER_ADDED')
                    ],200);
                }

            }catch(Exception $e){


                Log::error($e->getMessage());

                return response()->json([
                'status'=>'FAILED',
                'error'=> Config::get('custom_messages.ERROR_WHILE_CUSTOMER_ADDING')
                ],200);
            }
    }
}