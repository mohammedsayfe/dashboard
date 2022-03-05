@extends('layouts.admin')
@section('content')
    <div id="invoice" style="background: #fff">
        <div class="col-12 p-3" style="text-align: center; max-width: 100%;">
            <div class="col-12 col-lg-12 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fal fa-info-circle"></span> تعديل رقم امر البيع - {{ $sale->id }}
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>

                <table class="table table-bordered table-striped">
                    <tr>
                        <th style="text-align: left">رقم الفاتورة</th>
                        <td style="text-align: center">{{ $sale->id }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">إسم العضوء</th>
                        <td style="text-align: center">{{ $sale->member->name }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">إسم موظف البيع</th>
                        <td style="text-align: center">{{ $sale->user->name }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">تاريخ البيع</th>
                        <td style="text-align: center">{{ $sale->created_at }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">إجمال الفاتورة</th>
                        <td style="text-align: center">{{ $sale->total() }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-12 py-2 px-3 row main-box mt-1" style="text-align: center; max-width: 100%;">
            <div class="col-12 px-0">
                <div class="col-12 px-3 py-3">
                    <span class="fal fa-info-circle"></span>
                    تفاصيل أمر البيع - المنتجات
                </div>
                <div class="col-12 divider" style="min-height: 2px;"></div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>إسم المنتج</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>الجمالي</th>
                        </tr>
                    </thead>
                    <tbody id="products">
                        @php
                            $index = 1;
                        @endphp
                        @foreach ($sale->details as $saleDetail)
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $saleDetail->product->name }}</td>
                                <td>{{ $saleDetail->product->price_sale }}</td>
                                <td>{{ $saleDetail->number }}</td>
                                <td>{{ $saleDetail->number * $saleDetail->product->price_sale }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" style="text-align: left">إجمالي الفاتورة</th>
                            <td>{{ $sale->total() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button onclick="print_page('#invoice')" class="btn btn-success">طباعة</button>
    </div>
    <a href="{{ route('admin.sales.create') }}" class="btn btn-info text-white" style="float: left" >رجوع</a>
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
    @include('admin.templates.dropzone',[
    'selector'=>'#file-uploader-nafezly-main',
    'url'=> route('admin.upload.file'),
    'method'=>'POST',
    'remove_url'=>route('admin.upload.remove-file'),
    'remove_method'=>'POST',
    'enable_selector_after_upload'=>'#submitEvaluation',
    'max_files'=>1,
    'max_file_size'=>'50',
    'accepted_files'=>"['image/*']"
    ])
    <!--images-->
    @include('admin.templates.dropzone',[
    'selector'=>'#file-uploader-nafezly-second',
    'url'=> route('admin.upload.file'),
    'method'=>'POST',
    'remove_url'=>route('admin.upload.remove-file'),
    'remove_method'=>'POST',
    'enable_selector_after_upload'=>'#submitEvaluation',
    'max_files'=>100,
    'max_file_size'=>'50',
    'accepted_files'=>"['image/*']"
    ])
@endsection
