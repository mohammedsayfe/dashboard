@extends('layouts.admin')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 main-box">

            <div class="col-12 px-0">
                <div class="col-12 px-3 py-3">
                    <span class="fal fa-info-circle"></span>	تعديل اصل
                </div>
                <div class="col-12 divider" style="min-height: 2px;"></div>
            </div>
            <form id="validate-form" method="POST" action="{{ route('admin.assest.update', $assets->id) }}" class="row" enctype="multipart/form-data">
                @csrf
                <div class="col-12 col-lg-12 p-3">
                    <div class="col-12 p-2">
                        <div class="col-12">
                            اسم الاصل
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="name" required value="{{$assets->name}}" maxlength="190" class="form-control"  >
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <div class="col-12">
                            قيمة الاصل
                        </div>
                        <div class="col-12 pt-3">
                            <input type="number" name="value" required value="{{$assets->value}}" maxlength="190" class="form-control"  >
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <div class="col-12">
                            العدد
                        </div>
                        <div class="col-12 pt-3">
                            <input type="number" name="number" required value="{{$assets->number}}" maxlength="190" class="form-control"  >
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <div class="col-12">
                            وصف الاصل
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="description" required value="{{$assets->description}}" minlength="3" maxlength="190" class="form-control"  >
                        </div>
                    </div>



                </div>
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
