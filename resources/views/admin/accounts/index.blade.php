

@extends('layouts.admin')

@section('content')
    <div class="col-12 py-2 px-3 row">
        <h1 class="m-2 px-2 bold">
            قائمة الحسابات
            <a href="{{ route('admin.account.create') }}" class="btn btn-info text-white" style="float: left" >إضافة حساب جديد</a>
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الحساب</th>
                        <th>اسم البنك</th>
                        <th>صاحب الحساب</th>
                        <th>الرصيد</th>
                        <th>الفرع</th>
                        <th>البيان</th>
                        <th> العمليات</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($account as $accounts)
                    <tr>
                        <td>{{ $accounts->id }}</td>
                        <td>{{ $accounts->account_number }}</td>
                        <td>{{ $accounts->banks->name }}</td>
                        <td>{{ $accounts->member->name }}</td>
                        <td>{{ $accounts->balance }}</td>
                        <td>{{ $accounts->branch }}</td>
                        <td>{{ $accounts-> statement}}
                        <td>
                            <div class="btn-group">
                                <a href=" {{ route('admin.account.delete',$accounts->id) }}" class="btn btn-danger"> حذف</a>
                                <a href=" {{ route('admin.account.edit',$accounts->id) }}" class="btn btn-success">تعديل</a>
                            </div>
{{--                           --}}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
