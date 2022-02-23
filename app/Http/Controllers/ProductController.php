<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(){
        $product = Product::all();
       //return $data;
        return view('admin.products.index', compact('product'));
    }

    public function stock(){
        $data = Product::select('id','name','quantity','price_sale','price_buy')->get();
        return view('admin.products.stock', compact('data'));
    }

    public function create()
    {
        $data =User::all();
       return view('admin.products.create', compact('data'));
    }

   public function show(Product $member, Request $request){
        $member->update($request->all());
   }


    public function edit($id){
        $user = User::all();
        $product = Product::find($id);
        return view('admin.products.edit', compact('product', 'user'));
    }

    public function store(Request $request){
       try{
            Product::create([
                'name' => $request->name,
                'price_buy' => $request->price_puy,
                'price_sale' => $request->price_sale,
                'description' => $request->description,
                'user_id' => $request->user_name,
                'expired_date' => $request->expire_date,
            ]);

            notify()->success('تم حفظ بيانات العضو  بنجاح','عملية ناجحة');
           return redirect()->route('admin.all.product');
     }catch (\Exception $e){
           return $e ;
            Log::error($e->getMessage());
          notify()->error('حدث خطأ أثناء حفظ بيانات العضو','حدث خطأ');
       }
    }


//    public function edit($id){
//
//    }

    public function update(product $product, Request $request){
           //return $request;
            try{
                $product->update([
                    'name' => $request->name,
                    'price_buy' => $request->price_puy,
                    'price_sale' => $request->price_sale,
                    'description' => $request->description,
//                'product_image' => $request->image,
                    'user_id' => $request->user_name,
                    'expired_date' => $request->expire_date,               ]);

                notify()->success('تم تحديث بيانات المنتج  بنجاح','عملية ناجحة');
                return redirect()->route('admin.all.product');
            }catch (\Exception $e){
                Log::error($e->getMessage());
                notify()->error('حدث خطأ أثناء حفظ بيانات المنتج','حدث خطأ');
            }
        }

        public function delete($id){

        $product = Product::find($id);

        if($product)
            $product->delete();

            notify()->success('تم حذف بيانات المنتج  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.product');



        }
    public function details(){
        try{
            $data = Product::all();
            return view('admin.product.details',compact('',  'data'));
        }catch(\Exception $e){
            notify()->error('لم يتم العثور علي أمر البيع', 'عملية فاشلة');
            return back();
        }
    }



}
