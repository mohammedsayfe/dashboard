@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">

		<div class="col-12 px-0">
			<div class="col-12 px-3 py-3">
			 	<span class="fal fa-info-circle"></span>	إضافة عضو
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>
		<form id="validate-form" method="POST" action="{{ route('admin.members.store') }}" class="row" enctype="multipart/form-data">
		    @csrf
            <div class="col-12 col-lg-12 p-3">
                <div class="col-12 p-2">
                    <div class="col-12">
                        إسم العضو
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="name" required minlength="3" maxlength="190" class="form-control"  >
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        رقم الهوية
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="id_number" required  maxlength="190" class="form-control"  >
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        البريد الالكتروني
                    </div>
                    <div class="col-12 pt-3">
                        <input type="email" name="email" required minlength="3" maxlength="190" class="form-control"  >
                    </div>

                    <div class="col-12 p-2">
                        <div class="col-12">
                           كلمه المرور
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="email" required minlength="3" maxlength="190" class="form-control"  >
                        </div>

                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        رقم الهاتف
                    </div>
                    <div class="col-12 pt-3">
                        <input type="number" name="phone" required minlength="3" maxlength="190" class="form-control"  >
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        عدد الاسهم
                    </div>
                    <div class="col-12 pt-3">
                        <input type="number" name="number_of_shares" required maxlength="190" class="form-control"  >
                    </div>
                </div>
            </div>
            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">حفظ</button>
            </div>
            <div class="col-12 p-3">
                <div class="col-12 p-3">
                    <a href="{{ route('admin.members.index') }}" class="btn btn-info text-white" style="float: left" >رجوع</a>
                </div>
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
