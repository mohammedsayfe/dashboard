

@extends('layouts.admin')

@section('content')
    <div class="col-12 py-2 px-3 row">
        <h1 class="m-2 px-2 bold">
                    المخزن
            <a href="{{ route('admin.product.create') }}" class="btn btn-info text-white" style="float: left" >إضافة منتجات جديده</a>
            <a href="{{ route('admin.product.detailss') }}" class="btn btn-info text-white" style="float: left" >تفاصيل عن المخزن</a>
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>إسم المنتج</th>
                        <th>سعر البيع</th>
                        <th>سعر الشراء</th>
                        <th>الكمية المتوفرة</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $prodcut)
                    <tr>
                        <td>{{ $prodcut->id }}</td>
                        <td>{{ $prodcut->name }}</td>
                        <td>{{ $prodcut->price_sale }}</td>
                        <td>{{ $prodcut->price_buy }}</td>
                        <td>{{ $prodcut->quantity }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
