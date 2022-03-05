<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Product;
use App\Models\Safe;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::whereMemberId(auth('member')->user()->id)->get();
        return view('member.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $account = Account::findOrFail($request->account_id);
            $sale = Sale::create([
                'user_id' => null,
                'member_id' => auth('member')->user()->id,
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

            notify()->success('تم تعديل بيانات المبيعات  بنجاح','عملية ناجحة');
            return redirect()->route('sales.index');
        }catch (\Exception $e){
            DB::rollBack();
            return $e ;
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء تعديل بيانات المبيعات ','حدث خطأ');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::whereMemberId(auth('member')->user()->id)
                    ->select('id','account_number','member_id')->get();
        $products = Product::select('id','name','price_sale')->get();
        return view('member.sales.create', compact('accounts','products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
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

                $safe=Safe::findOrNew(1);
                $safe->balance =$safe->balance + $sale->total();
                $safe->save();


                $sale->update([
                    'is_payed' => true
                ]);

                notify()->success('تم سداد قيم الفاتورة', 'عملية ناجحة');
                return redirect()->route('sales.index');
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
            return view('member.sales.details',compact('sale'));
        }catch(\Exception $e){
            notify()->error('لم يتم العثور علي أمر البيع', 'عملية فاشلة');
            return back();
        }
    }

}
