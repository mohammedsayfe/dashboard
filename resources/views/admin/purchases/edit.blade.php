@extends('layouts.admin')
@section('content')
    <form id="validate-form" method="POST" action="{{ route('admin.purchase.update', $purchases->id) }}" class="row"
        enctype="multipart/form-data">
        <div class="col-12 p-3">
            <div class="col-12 col-lg-12 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fal fa-info-circle"></span> تعديل رقم امر الشراء - {{ $purchases->id }}
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                @csrf

                <div class="col-12 p-2">
                    <div class="col-12">
                        وصف امر الشراء
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="statement" required value="{{ $purchases->statement }}" maxlength="190"
                            class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 py-2 px-3 row main-box mt-1">
            <div class="col-12 px-0">
                <div class="col-12 px-3 py-3">
                    <span class="fal fa-info-circle"></span>
                    تفاصيل مشتريات - المنتجات
                    <button type="button" onclick="add_product()" class="btn btn-info text-white" style="float: left">إضافة
                        منتج</button>
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
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody id="products">
                        @php
                            $index = 1;
                        @endphp
                        @foreach ($purchases->details as $purchasesDetail)
                            <tr>
                                <td>{{ $index }}
                                    <input type="hidden" value="{{ $purchasesDetail->id }}"
                                        name="products[{{ $index }}][purchasesDetail_detail_id]">
                                </td>
                                <td>
                                    <select id="product_id_{{ $index }}"
                                        onchange="update_price(this,{{ $index }})"
                                        name="products[{{ $index }}][product_id]" class="form-control">
                                        <option>---</option>
                                        @foreach ($products as $product)
                                            <option id="{{ $index }}_{{ $product->id }}"
                                                value="{{ $product->id }}" price="{{ $product->price_sale }}"
                                                {{ $purchasesDetail->product_id == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td id="price_{{ $index }}">{{ $purchasesDetail->product->price_sale }}</td>
                                <td><input type="number" id="qte_{{ $index }}" value="{{ $purchasesDetail->number }}"
                                        onchange="calc_total({{ $index }})" required
                                        name="products[{{ $index }}][qte]" class="form-control"
                                        placeholder="أدخل الكمية"></td>
                                <td id="total_{{ $index++ }}">
                                    {{ $purchasesDetail->product->price_sale * $purchasesDetail->number }}</td>
                                <td>
                                    <button type="button" onclick="remove_product(this)"
                                            purchasesDetail_detail_id="{{ $purchasesDetail->id }}" class="btn btn-danger"><i
                                            class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-12 p-3">
            <div class="col-12 col-lg-12 p-0 main-box">

                <div class="col-12 p-3">
                    <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                </div>

            </div>
        </div>
    </form>
@endsection
@section('scripts')

    <script>
        var products_index = Number('{{ $index }}')

        function add_product() {
            let tr = `
                <tr>
                    <td>${products_index}</td>
                    <td>
                        <select id="product_id_${products_index}" onchange="update_price(this,${products_index})" name="products[${products_index}][product_id]" class="form-control">
                            <option>---</option>
                            @foreach ($products as $product)
                                <option id="${products_index}_{{ $product->id }}" value="{{ $product->id }}"
                                    price="{{ $product->price_sale }}">{{ $product->name }}</option>
                            @endforeach
            </select>
        </td>
        <td id="price_${products_index}">-</td>
                    <td><input type="number" id="qte_${products_index}" value="1" onchange="calc_total(${products_index})" required name="products[${products_index}][qte]" class="form-control" placeholder="أدخل الكمية"></td>
                    <td id="total_${products_index}">-</td>
                    <td>
                        <button type="button" onclick="remove_product(this)" class="btn btn-danger"><i class="fa fa-times"></i></button>
                    </td>
                </tr>`

            $('#products').append(tr);
            products_index += 1;
        }

        function remove_product(btn) {
            if (confirm('are sure ?')) {
                if ($(btn).attr('purchasesDetail_detail_id')) {
                    console.log($(btn).attr('purchasesDetail_detail_id'))
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('admin.purchase.delete.detail') }}",
                        type: "POST",
                        data: {
                            id: $(btn).attr('purchasesDetail_detail_id'),
                        },
                        success: function(data) {
                            // after delete the slae detail from database then remove this row .
                            $(btn).parent().parent().remove();
                        },
                    });
                } else {
                    $(btn).parent().parent().remove();
                }
            }
        }

        function update_price(select, index) {
            let price_sale = $('#' + index + '_' + $(select).val()).attr('price')
            $('#price_' + index).html('$' + price_sale)

            calc_total(index)
        }

        function calc_total(index) {
            let qte = Number($('#qte_' + index).val())
            let price = Number($('#' + index + '_' + $('#product_id_' + index).val()).attr('price'))

            $('#total_' + index).html('$' + numberWithCommas(qte * price))
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
