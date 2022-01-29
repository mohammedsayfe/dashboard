@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">

		<div class="col-12 px-0">
			<div class="col-12 px-3 py-3">
			 	<span class="fal fa-info-circle"></span>	إضافة حساب جديد
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>
		<form id="validate-form" method="POST" action="{{ route('admin.sales.store') }}" class="row" enctype="multipart/form-data">
		    @csrf
            <div class="col-12 col-lg-12 p-3">
                <div class="col-12 p-2">
                    <div class="col-12">
                        السلعه
                    </div>
                    <div class="col-12 pt-3">
                        <input type="number" name="number" required  maxlength="190" class="form-control"  >
                    </div>
                </div>



                <div class="col-12 p-2">
                    <div class="col-12">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">
                                اسم البنك
                            </label>
                            <select name="salse" class="select2 form-control">
                                <optgroup label=" من فضلك اختر اسم البنك ">
                                    @if($bank && $bank -> count() >0)
                                        @foreach($bank as $banks)
                                            <option
                                                value="{{$banks -> id}}">{{$banks ->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                        </div>

                        {{--                    <div class="col-12 pt-3">--}}
                        {{--                        <input type="text" name="user_name" required minlength="3" maxlength="190" class="form-control"  >--}}
                        {{--                    </div>--}}
                    </div>

                </div>

                <div class="col-12 p-2">
                    <div class="col-12">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">  اسم صاحب الحساب </label>
                            <select name="member" class="select2 form-control">
                                <optgroup label=" من فضلك اختر اسم صاحب الحساب ">
                                    @if($member && $member -> count() >0)
                                        @foreach($member as $members)
                                            <option
                                                value="{{$members -> id}}">{{$members ->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                        </div>

                        {{--                    <div class="col-12 pt-3">--}}
                        {{--                        <input type="text" name="user_name" required minlength="3" maxlength="190" class="form-control"  >--}}
                        {{--                    </div>--}}
                    </div>

                </div>



                <div class="col-12 p-2">
                    <div class="col-12">
                        الرصيد الافتتاحي
                    </div>
                    <div class="col-12 pt-3">
                        <input type="number" name="balance" required  maxlength="190" class="form-control"  >
                    </div>
                </div>


                <div class="col-12 p-2">
                    <div class="col-12">
                        الفرع
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="branch" required  maxlength="190" class="form-control"  >
                    </div>
                </div>


                <div class="col-12 p-2">
                    <div class="col-12">
                        البيان
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="statement" required  maxlength="190" class="form-control"  >
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
            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">حفظ</button>
            </div>
		</form>
	</div>
</div>
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
@endsection
