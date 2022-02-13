<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use App\Models\Member;
use App\Models\Product;
use App\Models\Safe;
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
        $accounts = Account::select('id','account_number','member_id')->get();
        $products = Product::select('id','name','price_sale')->get();
       return view('admin.sales.create', compact('accounts','products'));
    }


   public function show(accounts $accounts, Request $request){
       $accounts->update($request->all());
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

            notify()->success('تم حفظ بيانات المبيعات  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.sales');
        }catch (\Exception $e){
            DB::rollBack();
            return $e ;
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء ادخال الحساب ','حدث خطأ');
        }
    }

    public function edit(Sale $sale){
        $accounts = Account::select('id','account_number','member_id')->get();
        $products = Product::select('id','name','price_sale')->get();
        return view('admin.sales.edit', compact('accounts','products', 'sale'));
    }

    public function update(Sale $sale, Request $request){
        try{
            DB::beginTransaction();
            $account = Account::findOrFail($request->account_id);
            $sale->update([
                'user_id' => auth()->user()->id,
                'member_id' => $account->member->id,
                'account_id' => $request->account_id,
                'statement' => $request->statement,
            ]);

            if($request->products){
                foreach($request->products as $product){
                    if(isset($product['sale_detail_id'])){
                        $saleDetail = SaleDetail::find($product['sale_detail_id']);

                        $saleDetail->update([
                            'sale_id' => $sale->id,
                            'product_id' => $product['product_id'],
                            'number' => $product['qte'],
                        ]);
                    }else{
                        SaleDetail::create([
                            'sale_id' => $sale->id,
                            'product_id' => $product['product_id'],
                            'number' => $product['qte'],
                        ]);
                    }

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

    public function destroy(Request $request){
        SaleDetail::findOrFail($request->id)->delete();
        return response()->json([
            'message' => 'detail deleted successfully'
        ]);
    }


    public function pay($id){
        try{
            $sale = Sale::findOrFail($id);

            $account = $sale->account;

            if($account->balance >= $sale->total()){
                $account->update([
                    'balance' => $account->balance - $sale->total()
                ]);

                foreach($sale->details as $detail){
                    $product = Product::find($detail->product_id);
                    $product->update([
                        'quantity' => $product->quantity - $detail->number
                    ]);
                }

                $safe=safe::findOrNew(1);
                $safe->balance =$safe->balance + $sale->total();
                $safe->save();


                $sale->update([
                    'is_payed' => true
                ]);

                notify()->success('تم سداد قيم الفاتورة', 'عملية ناجحة');
                return redirect()->route('admin.all.sales');
            }else{
                notify()->error('عفواً, رصيد الحساب غير كافي', 'عملية فاشلة');
                return back();
            }

        }catch(\Exception $e)

        {return $e->getMessage()
            ;
            notify()->error('لم يتم العثور علي أمر البيع', 'عملية فاشلة');
            return back();
        }
    }

    public function details($id){
        try{
            $sale = Sale::findOrFail($id);
            return view('admin.sales.details',compact('sale'));
        }catch(\Exception $e){
            notify()->error('لم يتم العثور علي أمر البيع', 'عملية فاشلة');
            return back();
        }
    }
}
