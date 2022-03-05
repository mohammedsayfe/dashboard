@extends('layouts.admin')
@section('content')
    <div id="invoice" style="background: #fff">
        <div class="col-12 p-3" style="text-align: center; max-width: 100%;">
            <div class="col-12 col-lg-12 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fal fa-info-circle"></span>تقرير عن المنتجات
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
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
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
@endsection

