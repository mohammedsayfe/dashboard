<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Expens;
use App\Models\Member;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExpensController extends Controller
{
    public function index(){
        $expens = Expens::all();
        //return $expens;
        return view('admin.expens.index', compact('expens'));
    }

    public function create()
    {
        return view('admin.expens.create');
    }

//Product $product
    public function edit($id){
        $expens = Expens::find($id);
        //return $assets;
        return view('admin.expens.edit', compact('expens'));
    }

    public function store(Request $request){
         //return $request;
        try{
            Expens::create([
                'name' => $request->name,
                'price' => $request->value,
                'statement' => $request->statement,
                'date' => $request->date,
                'user_id' => $request->user_id,

              ]);

            notify()->success('تم حفظ بيانات الاصل  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.expens');
        }catch (\Exception $e){
             return $e ;
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء حفظ بيانات العضو','حدث خطأ');
        }
    }


//    public function edit($id){
//
//    }

    public function update(expens $expens, Request $request){
       // return $request;
        try{
            $expens->update([
                'name' => $request->name,
                'price' => $request->value,
                'statement' => $request->statement,
                'date' => $request->date,
                'user_id' => $request->user_id,
            ]);

            notify()->success('تم تحديث بيانات المصروف  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.expens');
        }catch (\Exception $e){
           // return $e;
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء حفظ بيانات المصروف','حدث خطأ');
        }
    }

    public function delete($id){

        $expens = Expens::find($id);

        if($expens)
            $expens->delete();

        notify()->success('تم حذف بيانات الاصل  بنجاح','عملية ناجحة');
        return redirect()->route('admin.all.expens');



    }



}
