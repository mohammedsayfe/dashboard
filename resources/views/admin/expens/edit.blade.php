@extends('layouts.admin')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 main-box">
            <div class="col-12 px-0">

                <div class="col-12 px-3 py-3">
                    <span class="fal fa-info-circle"></span>	إضافة مصروف جديد
                </div>
                <div class="col-12 divider" style="min-height: 2px;"></div>
            </div>
            <form id="validate-form" method="POST" action="{{ route('admin.expens.update', $expens->id) }}" class="row" enctype="multipart/form-data">
                @csrf
                <div class="col-12 col-lg-12 p-3">
                    <div class="col-12 p-2">
                        <div class="col-12">
                            إسم المصروف
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="name" required value="{{$expens->name}}" maxlength="190" class="form-control"  >
                        </div>
                    </div>

                    <div class="col-12 p-2">
                        <div class="col-12">
                             القيمة
                        </div>
                        <div class="col-12 pt-3">
                            <input type="number" name="value" required value="{{$expens->price}}" maxlength="190" class="form-control"  >
                        </div>
                    </div>
                    <div class="col-12 p-2">

                        <div class="col-12 pt-3">
                            <input hidden type="number" name="user_id" required value="{{auth()->user()->id}}"  maxlength="190" class="form-control"  >
                        </div>
                    </div>

                    <div class="col-12 p-2">

                        <div class="col-12">
                            البيان
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="statement" required value="{{$expens->statement}}" maxlength="190" class="form-control"  >
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <div class="col-12">
                            التاريخ
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="date" required value="{{$expens->date}}" maxlength="190" class="form-control"  >
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


                            {{--                    <div class="col-12 pt-3">--}}
                            {{--                        <input type="text" name="user_name" required minlength="3" maxlength="190" class="form-control"  >--}}
                            {{--                    </div>--}}
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
