<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use App\Models\Member;
use App\Models\Product;
use App\Models\Purchases;
use App\Models\PurchasesDetail;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Salse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function index(){
        $purchases = Purchases::all();
//       return $sales;
        return view('admin.purchases.index', compact('purchases'));
    }

    public function create()
    {
       // $accounts = Account::select('id','account_number','member_id')->get();
        $products = Product::select('id','name','price_sale')->get();
       return view('admin.purchases.create',compact('products'));
    }


   public function show(purchases $purchases, Request $request){
       $purchases->update($request->all());
   }
//
////
// public function store(Request $request){
//       try{
//           //return $request;
//           DB::beginTransaction();
//           $account = Account::findOrFail($request->account_id);
//           $sale = Sale::create([
//               'user_id' => auth()->user()->id,
//               'member_id' => $account->member->id,
//               'account_id' => $request->account_id,
//               'statement' => $request->statement,
//           ]);
//
//           if($request->products){
//               foreach($request->products as $product){
//                   SaleDetail::create([
//                       'sale_id' => $sale->id,
//                       'product_id' => $product['product_id'],
//                       'number' => $product['qte'],
//                   ]);
//               }
//           }
//
//           DB::commit();
         //  return $sale->total();


    public function store(Request $request){
        try{
            DB::beginTransaction();
         //   $account = Account::findOrFail($request->account_id);
            $purchase = Purchases::create([
                'user_id' => auth()->user()->id,
              //  'member_id' => $account->member->id,
              //  'account_id' => $request->account_id,
                'statement' => $request->statement,
            ]);

            if($request->products){
                foreach($request->products as $product){
                    purchasesDetail::create([
                        'purchases_id' =>  $purchase->id,
                        'product_id' => $product['product_id'],

                        'number' => $product['qte'],
                    ]);
                }
            }

            DB::commit();

            notify()->success('تم حفظ بيانات المبيعات  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.purchase');
        }catch (\Exception $e){
            DB::rollBack();
            return $e ;
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء ادخال الحساب ','حدث خطأ');
        }
    }

    public function edit(purchases $purchases){
       // $accounts = Account::select('id','account_number','member_id')->get();
        $products = Product::select('id','name','price_sale')->get();
        return view('admin.purchases.edit', compact('products', 'purchases'));
    }

    public function update(purchases $purchases, Request $request){
        try{
            DB::beginTransaction();
           // $account = Account::findOrFail($request->account_id);
            $purchases->update([
                'user_id' => auth()->user()->id,
              //  'member_id' => $account->member->id,
              //  'account_id' => $request->account_id,
                'statement' => $request->statement,
            ]);

            if($request->products){
                foreach($request->products as $product){
                    if(isset($product['purchasesDetail_detail_id'])){
                        $saleDetail = PurchasesDetail::find($product['purchasesDetail_detail_id']);

                        $saleDetail->update([
                            'purchases_id' => $purchases->id,
                            'product_id' => $product['product_id'],
                            'number' => $product['qte'],
                        ]);
                    }else{
                        SaleDetail::create([
                            'purchases_id' => $purchases->id,
                            'product_id' => $product['product_id'],
                            'number' => $product['qte'],
                        ]);
                    }

                }
            }

            DB::commit();

            notify()->success('تم تعديل بيانات المبيعات  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.purchase');
        }catch (\Exception $e){
            DB::rollBack();
            return $e ;
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء تعديل بيانات المبيعات ','حدث خطأ');
        }
        }

        public function delete($id){

            $purchase = Purchases::find($id);

            if($purchase)
                $purchase->delete();

            notify()->success('تم حذف بيانات الحساب  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.purchase');

        }

        public function destroy(Request $request){
            SaleDetail::findOrFail($request->id)->delete();
            return response()->json([
                'message' => 'detail deleted successfully'
            ]);
        }



}
