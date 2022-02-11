@extends('layouts.admin')
@section('content')
    <div id="invoice" style="background: #fff">
        <div class="col-12 p-3" style="text-align: center; max-width: 100%;">
            <div class="col-12 col-lg-12 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fal fa-info-circle"></span> تعديل رقم امر البيع - {{ $member->id }}
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th style="text-align: left">اسم العضو </th>
                        <td style="text-align: center">{{ $member->id }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">اسم العضو</th>
                        <td style="text-align: center">{{ $member->name }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">رقم الهويه</th>
                        <td style="text-align: center">{{  $member->id_number }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">رقم التلفون</th>
                        <td style="text-align: center">{{ $member->phone }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">عدد الاسهم</th>
                        <td style="text-align: center">{{  $member->number_of_shares}}</td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="col-12 py-2 px-3 row main-box mt-1" style="text-align: center; max-width: 100%;">
            <div class="col-12 px-0">


                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>إسم العضو</th>
                        <th>رقم الهوية</th>
                        <th>رقم الهاتف</th>
                        <th>عدد الاسهم</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $member)
                        <tr>
                            <td>{{ $member->id }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->id_number }}</td>
                            <td>{{ $member->phone }}</td>
                            <td>{{ $member->number_of_shares }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.members.destroy',$member) }}" class="btn btn-danger"><i class="fal fa-trash"></i></a>
                                    <a href="{{ route('admin.members.edit',$member) }}" class="btn btn-success"><i class="fal fa-pen"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button onclick="print_page('#invoice')" class="btn btn-success">طباعة</button>
    </div>
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
