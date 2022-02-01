<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use App\Models\Member;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Salse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalseController extends Controller
{
    public function index(){
        $sales = Sale::all();
//       return $sales;
        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $members = Member::select('id','name')->get();
        $accounts = Account::select('id','account_number','member_id')->get();
        $products = Product::select('id','name','price_sale')->get();
       return view('admin.sales.create', compact('accounts','members','products'));
    }

   public function show(accounts $accounts, Request $request){
       $accounts->update($request->all());
   }

//
 public function store(Request $request){
       try{
           //return $request;
           DB::beginTransaction();
           $account = Account::findOrFail($request->account_id);
           $sale = Sale::create([
               'user_id' => auth()->user()->id,
               'member_id' => $account->member->id,
               'account_id' => $request->account_id,
               'statement' => $request->statement,
           ]);

           if($request->products){
               foreach($request->products as $product){
                   SaleDetail::create([
                       'sale_id' => $sale->id,
                       'product_id' => $product['product_id'],
                       'number' => $product['qte'],
                   ]);
               }
           }

           DB::commit();
         //  return $sale->total();

            notify()->success('تم حفظ بيانات المبيعات  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.sales');
     }catch (\Exception $e){
           DB::rollBack();
        return $e ;
         Log::error($e->getMessage());
          notify()->error('حدث خطأ أثناء ادخال الحساب ','حدث خطأ');
       }
    }


//Product $product
    public function edit($id){
        $sale = Sale::find($id);
        $members = Member::select('id','name')->get();
        $accounts = Account::select('id','account_number','member_id')->get();
        $products = Product::select('id','name','price_sale')->get();
        return view('admin.sales.edit', compact('accounts','members','products', 'sale'));
       // return $account;
       // return view('admin.accounts.edit', compact('account','member', 'bank'));
    }

    public function update(sale $sale, Request $request){
          // return $request;
        try{
            //return $request;
            DB::beginTransaction();
            $account = Account::findOrFail($request->account_id);
            $sale ->update([
                'user_id' => auth()->user()->id,
                'member_id' => $account->member->id,
                'account_id' => $request->account_id,
                'statement' => $request->statement,
            ]);

            if($request->products){
                foreach($request->products as $product){
                    $SaleDetail->update([
                        'sale_id' => $sale->id,
                        'product_id' => $product['product_id'],
                        'number' => $product['qte'],
                    ]);
                }
            }

            DB::commit();

            notify()->success('تم تعديل بيانات المبيعات  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.sales');
        }catch (\Exception $e){
            DB::rollBack();
            return $e ;
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء تعديل بيانات المبيعات ','حدث خطأ');
        }
        }

        public function delete($id){

            $sale = Sale::find($id);

        if($sale)
            $sale->delete();

            notify()->success('تم حذف بيانات الحساب  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.sales');



        }



}
