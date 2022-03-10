@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">

		<div class="col-12 px-0">
			<div class="col-12 px-3 py-3">
			 	<span class="fal fa-info-circle"></span>	إضافة منتج جديد
            </div>

			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>
		<form id="validate-form" method="POST" action="{{ route('admin.products.store') }}" class="row" enctype="multipart/form-data">
		    @csrf
            <div class="col-12 col-lg-12 p-3">
                <div class="col-12 p-2">
                    <div class="col-12">
                        إسم المنتج
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="name" required  maxlength="190" class="form-control"  >
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        سعر البيع
                    </div>
                    <div class="col-12 pt-3">
                        <input type="number" name="price_sale" required  maxlength="190" class="form-control"  >
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        سعر الشراء
                    </div>
                    <div class="col-12 pt-3">
                        <input type="number" name="price_puy" required  maxlength="190" class="form-control"  >
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        وصف المنتج
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="description" required  maxlength="190" class="form-control"  >
                    </div>
                </div>

{{--                <div class="col-12 p-2">--
{{--                    <div class="col-12">--}}
{{--                        صورة المنتج--}}
{{--                    </div>--}}
{{--                    <div class="col-12 pt-3">--}}
{{--                        <input type="image" name="image" required minlength="3" maxlength="190" class="form-control"  >--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-12 p-2">
                    <div class="col-12">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">  اسم الموظف </label>
                            <select name="user_name" class="select2 form-control">
                                <optgroup label=" اسم الموظف">
                            @if($data && $data -> count() >0)
                                @foreach($data as $clearance)
                                    <option
                                        value="{{$clearance -> id}}">{{$clearance ->name}}</option>
                                        @endforeach
                                        @endif
                                </optgroup>
                            </select>
                        </div>

{{--                    <div class="col-12 pt-3">--}}
{{--                        <input type="text" name="user_name" required minlength="3" maxlength="190" class="form-control"  >--}}
{{--                    </div>--}}
                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        تاريخ الانتهاء
                    </div>
                    <div class="col-12 pt-3">
                        <input type="date" name="expire_date" required maxlength="190" class="form-control"  >
                    </div>
                </div>

            </div>
            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">حفظ</button>
            </div>

	</div>
</div>
<a href="{{ route('admin.product.index') }}" class="btn btn-info text-white" style="float: left" >رجوع</a>
@endsection
@section('scripts')
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

