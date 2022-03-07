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
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
                <button onclick="print_page('#invoice')" class="btn btn-success">طباعة</button>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-info text-white" style="float: left" >رجوع</a>

@endsection

@section('scripts')
    <script>
        function print_page(element){
            var width = document.body.clientWidth;
            var div_width = $(element).width();
            console.log(width);
            console.log(div_width);
            $(element).css('z-index','1000')
                .css('width',width+'px')
                .css('position','absolute')
                .css('top',0)
                .css('right',0)

            print()

            location.reload()
        }
    </script>
