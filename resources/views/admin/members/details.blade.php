@extends('layouts.admin')
@section('content')
    <div id="invoice" style="background: #fff">
        <div class="col-12 p-3" style="text-align: center; max-width: 100%;">
            <div class="col-12 col-lg-12 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fal fa-info-circle"></span> الاعضاء
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>إسم العضو</th>
                                <th>رقم الهوية</th>
                                <th>رقم الهاتف</th>
                                <th>عدد الاسهم</th>
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

                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="text-center">
                    <button onclick="print_page('#invoice')" class="btn btn-success">طباعة</button>
                </div>
     <a href="{{ route('admin.members.index') }}" class="btn btn-info text-white" style="float: left" >رجوع</a>

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

