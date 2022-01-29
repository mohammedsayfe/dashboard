<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Bank;
use App\Models\Member;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BankController extends Controller
{
    public function index(){
        $banks = Bank::all();
       // return $banks;
        return view('admin.banks.index', compact('banks'));
    }

    public function create()
    {

        return view('admin.banks.create');
    }

    public function store(Request $request){
         //return $request;
        try{
            Bank::create([
                'name' => $request->name,
                'address' => $request->address,
                'description' => $request->description,
                'user_id' => $request->user_id,
              ]);

            notify()->success('تم حفظ بيانات البنك  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.bank');
        }catch (\Exception $e){
             //return $e ;
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء حفظ بيانات البنك','حدث خطأ');
        }
    }


//    public function edit($id){
//
//    }

//Product $product
    public function edit($id){
        $bank = Bank::find($id);
        //return $assets;
        return view('admin.banks.edit', compact('bank'));
    }

    public function update(bank $bank, Request $request){
        //return $request;
        try{
            $bank->update([
                'name' => $request->name,
                'address' => $request->address,
                'description' => $request->description,
                'user_id' => $request->user_id,
            ]);

            notify()->success('تم تحديث بيانات الاصل  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.bank');
        }catch (\Exception $e){
            return $e;
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء حفظ بيانات الاصل','حدث خطأ');
        }
    }

    public function delete($id){

        $banks = Bank::find($id);

        if($banks)
            $banks->delete();

        notify()->success('تم حذف بيانات الاصل  بنجاح','عملية ناجحة');
        return redirect()->route('admin.all.bank');



    }



}
