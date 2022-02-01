

@extends('layouts.admin')

@section('content')
    <div class="col-12 py-2 px-3 row">
        <h1 class="m-2 px-2 bold">
            قائمة المبيعات
            <a href="{{ route('admin.sales.create') }}" class="btn btn-info text-white" style="float: left" >إضافة حساب جديد</a>
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم العضو</th>
                        <th>اسم موظف البيع</th>
                        <th>التاريخ</th>
                        <th>الاجمالي</th>
                        <th>البيان</th>
                        <th> العمليات</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->member->name }}</td>
                        <td>{{ $sale->user->name }}</td>
                        <td>{{ $sale->created_at }}</td>
                        <td>{{ number_format($sale->total(),2) }}</td>
                        <td>{{ $sale-> statement}}
                        <td>
                            <div class="btn-group">
                                <a href=" {{ route('admin.sales.delete',$sale->id) }}" class="btn btn-danger"> حذف</a>
                                <a href=" {{ route('admin.sales.edit',$sale->id) }}" class="btn btn-success">تعديل</a>
                            </div>
{{--                           --}}
                        </td>
                    </tr>
                @endforeach
                    <tr>
                        <th colspan="4" style="text-align: left">إجمالي المبيعات</th>
                        <th colspan="3">{{ number_format($sales->map( function($sale){ return $sale->total(); })->sum(),2) }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
