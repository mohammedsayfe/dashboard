<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use App\Models\Member;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function index(){
        $account = Account::all();
       //return $data;
        return view('admin.accounts.index', compact('account'));
    }

    public function create()
    {
        $bank = Bank::all();
        $member = Member ::all();
       return view('admin.accounts.create', compact('bank','member'));
    }

   public function show(accounts $accounts, Request $request){
       $accounts->update($request->all());
   }

//
 public function store(Request $request){
       // return $request;
       try{
            Account::create([
                'account_number' => $request->number,
                'member_id' => $request->member,
               'bank_id' => $request->bank,
              'balance' => $request->balance,
                'statement' => $request->statement,
                'branch' => $request->branch,
            ]);

          notify()->success('تم حفظ بيانات الحساب  بنجاح','عملية ناجحة');
           return redirect()->route('admin.all.account');
     }catch (\Exception $e){
        return $e ;
         Log::error($e->getMessage());
          notify()->error('حدث خطأ أثناء ادخال الحساب ','حدث خطأ');
       }
    }


//Product $product
    public function edit($id){
        $account = Account::find($id);
        $bank =Bank::all();
        $member = Member::all();
       // return $account;
        return view('admin.accounts.edit', compact('account','member', 'bank'));
    }

    public function update(account $account, Request $request){
           //return $request;
            try{
                $account->update([

                    'account_number' => $request->number,
                    'member_id' => $request->member,
                    'bank_id' => $request->bank,
                    'balance' => $request->balance,
                    'statement' => $request->statement,
                    'branch' => $request->branch,
                              ]);

                notify()->success('تم تحديث بيانات الحساب  بنجاح','عملية ناجحة');
                return redirect()->route('admin.all.account');
            }catch (\Exception $e){
                return $e;
                Log::error($e->getMessage());
                notify()->error('حدث خطأ أثناء حفظ بيانات الحساب','حدث خطأ');
            }
        }

        public function delete($id){

            $account = Account::find($id);

        if($account)
            $account->delete();

            notify()->success('تم حذف بيانات الحساب  بنجاح','عملية ناجحة');
            return redirect()->route('admin.all.accounts');



        }

        public function details(){
            try{
                $account = Account::all();
                return view('admin.accounts.details',compact( 'account'));
            }catch(\Exception $e){
                return $e;
                notify()->error('لم يتم العثور علي أمر البيع', 'عملية فاشلة');
                return back();
            }
        }



}
