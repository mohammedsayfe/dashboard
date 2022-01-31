@extends('layouts.admin')
@section('content')
    <form id="validate-form" method="POST" action="{{ route('admin.sales.update', $sale->id) }}" class="row" enctype="multipart/form-data">
        <div class="col-12 p-3">
            <div class="col-12 col-lg-12 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fal fa-info-circle"></span>	تعديل رقم امر البيع
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                @csrf
                <div class="col-12 p-2">
                    <div class="col-12">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">
                                رقم الحساب
                            </label>
                            <select name="account_id" class="select2 form-control">
                                <optgroup label=" من فضلك اختررقم الحساب ">
                                    @if($accounts && $accounts -> count() >0)
                                        @foreach($accounts as $account)
                                            <option
                                                value="{{$account -> id}}">{{$account ->account_number  .'-'. $account->member->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-12 p-2">
                    <div class="col-12">
                        البيان
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="statement" required value="{{$sale->statement}}" maxlength="190" class="form-control"  >
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 py-2 px-3 row main-box mt-1">
            <div class="col-12 px-0">
                <div class="col-12 px-3 py-3">
                    <span class="fal fa-info-circle"></span>
                    تفاصيل المبيعات - المنتجات
                    <button type="button" onclick="add_product()" class="btn btn-info text-white" style="float: left" >تعديل منتج</button>
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
        var products_index = 1
        function add_product() {
            let tr = `
                <tr>
                    <td>${products_index}</td>
                    <td>
                        <select id="product_id_${products_index}" onchange="update_price(this,${products_index})" name="products[${products_index}][product_id]" class="form-control">
                            <option>---</option>
                            @foreach($products as $product)
            <option id="${products_index}_{{ $product->id }}" value="{{ $product->id }}" price="{{ $product->price_sale }}">{{ $product->name }}</option>
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
            if(confirm('are sure ?')){
                $(btn).parent().parent().remove();
            }
        }

        function update_price(select,index) {
            let price_sale = $('#'+index+'_'+$(select).val()).attr('price')
            $('#price_'+index).html('$'+price_sale)

            calc_total(index)
        }

        function calc_total(index) {
            let qte = Number($('#qte_'+index).val())
            let price = Number($('#'+index+'_'+$('#product_id_'+index).val()).attr('price'))

            $('#total_'+index).html('$'+ numberWithCommas(qte * price))
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
