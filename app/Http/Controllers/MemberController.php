<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function index(){
        $data = Member::all();

        return view('admin.members.index', compact('data'));
    }

    public function create()
    {
       return view('admin.members.create');
    }

    public function show($id){
        try{
            $member = Member::findOrFail($id);
            return view('admin.members.details',compact('member'));
        }catch(\Exception $e){
            notify()->error('لم يتم العثور علي أمر البيع', 'عملية فاشلة');
            return back();
        }
    }




    //(Member $member, Request $request){
       // $member->update($request->all());
   // }

    public function edit(Member $member){

        return view('admin.members.edit', compact('member'));
    }

    public function store(Request $request){
        try{
            Member::create([
                'name' => $request->name,
                'id_number' => $request->id_number,
                'email' => $request->name,
                'phone' => $request->phone,
                'number_of_shares' => $request->number_of_shares,
            ]);

            notify()->success('تم حفظ بيانات العضو  بنجاح','عملية ناجحة');
            return redirect()->route('admin.members.index');
        }catch (\Exception $e){
            Log::error($e->getMessage());
            notify()->error('حدث خطأ أثناء حفظ بيانات العضو','حدث خطأ');
        }
    }

    public function update(Member $member, Request $request){
            try{
                $member->update([
                    'name' => $request->name,
                    'id_number' => $request->id_number,
                    'email' => $request->name,
                    'phone' => $request->phone,
                    'number_of_shares' => $request->number_of_shares,
                ]);


                notify()->success('تم تحديث بيانات العضو  بنجاح','عملية ناجحة');
                return redirect()->route('admin.members.index');
            }catch (\Exception $e){
                Log::error($e->getMessage());
                notify()->error('حدث خطأ أثناء حفظ بيانات العضو','حدث خطأ');
            }
            }
  //Member $member
        public function delete($id){

            $member = Member::find($id);

          //  return $member;

            if($member)
                $member->delete();

            notify()->success('تم حذف بيانات العضو  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.member');

           // admin.members.index

        }

    public function details($id){
        try{
            $member = Member::findOrFail($id);
            $data = Member::all();
            return view('admin.members.details',compact('member','data'));
        }catch(\Exception $e){
            notify()->error('لم يتم العثور علي أمر البيع', 'عملية فاشلة');
            return back();
        }
    }
public function LoginMember()
{
    
}



    }
