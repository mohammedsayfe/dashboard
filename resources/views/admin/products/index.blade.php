

@extends('layouts.admin')

@section('content')
    <div class="col-12 py-2 px-3 row">
        <h1 class="m-2 px-2 bold">
            لائحة الاعضاء
            <a href="{{ route('admin.product.create') }}" class="btn btn-info text-white" style="float: left" >إضافة منتجات جديده</a>
            <a href="{{ route('admin.product.details') }}" class="btn btn-info text-white" style="float: left" >تفاصيل عن  المنتجات</a>
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>إسم المنتج</th>
                        <th>سعر البيع</th>
                        <th>سعر الشراء</th>
                        <th>وصف المنتج</th>
                        <th>اسم الموظف</th>
                        <th>تارخ الانتهاء</th>
                        <th> العمليات</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($product as $products)
                    <tr>
                        <td>{{ $products->id }}</td>
                        <td>{{ $products->name }}</td>
                        <td>{{ $products->price_sale }}</td>
                        <td>{{ $products->price_buy }}</td>
                        <td>{{ $products->description }}</td>
                        <td>{{ $products->users->name }}</td>
                        <td>{{ $products->expired_date }}</td>
                        <td>
                            <div class="btn-group">
                                <a href=" {{ route('admin.product.delete',$products->id) }}" class="btn btn-danger"> حذف</a>
                                <a href=" {{ route('admin.product.edit',$products->id) }}" class="btn btn-success">تعديل</a>
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
