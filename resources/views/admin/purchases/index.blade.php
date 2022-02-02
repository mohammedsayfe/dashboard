

@extends('layouts.admin')

@section('content')
    <div class="col-12 py-2 px-3 row">
        <h1 class="m-2 px-2 bold">
            قائمة المشتريات
            <a href="{{ route('admin.purchase.create') }}" class="btn btn-info text-white" style="float: left" >إضافة امر شراء جديد</a>
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم موظف الشراء</th>
                        <th>التاريخ</th>
                        <th>الاجمالي</th>
                        <th>البيان</th>
                        <th> العمليات</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->user->name }}</td>
                        <td>{{ $purchase->created_at }}</td>
                        <td>{{ number_format($purchase->total(),2) }}</td>
                        <td>{{ $purchase-> statement}}
                        <td>

                            <div class="btn-group">
                                <a href=" {{ route('admin.purchase.delete',$purchase->id) }}" class="btn btn-danger"> حذف</a>
                                <a href=" {{ route('admin.purchase.edit',$purchase->id) }}" class="btn btn-success">تعديل</a>
                            </div>
{{--                           --}}
                        </td>
                    </tr>
                @endforeach
                    <tr>
                        <th colspan="4" style="text-align: left">إجمالي المشتريات</th>
                        <th colspan="3">{{ number_format($purchases->map( function($purchase){ return $purchase->total(); })->sum(),2) }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
