<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Member;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AssetsController extends Controller
{
    public function index(){
        $assets = Assets::all();
        //return $data;
        return view('admin.assets.index', compact('assets'));
    }

    public function create()
    {

        return view('admin.assets.create');
    }

//Product $product
    public function edit($id){
        $assets = Assets::find($id);
        //return $assets;
        return view('admin.assets.edit', compact('assets'));
    }
    public function store(Request $request){
        // return $request;
        try{
            Assets::create([
                'name' => $request->name,
                'value' => $request->value,
                'number' => $request->number,
                'description' => $request->description,
              ]);

            notify()->success('تم حفظ بيانات الاصل  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.assest');
        }catch (\Exception $e){
            // return $e ;
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء حفظ بيانات العضو','حدث خطأ');
        }
    }


//    public function edit($id){
//
//    }

    public function update(assets $assets, Request $request){
        //return $request;
        try{
            $assets->update([
                'name' => $request->name,
                'value' => $request->value,
                'number' => $request->number,
                'description' => $request->description,
            ]);

            notify()->success('تم تحديث بيانات الاصل  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.assest');
        }catch (\Exception $e){
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء حفظ بيانات الاصل','حدث خطأ');
        }
    }

    public function delete($id){

        $assets = Assets::find($id);

        if($assets)
            $assets->delete();

        notify()->success('تم حذف بيانات الاصل  بنجاح','عملية ناجحة');
        return redirect()->route('admin.all.assest');



    }



}
