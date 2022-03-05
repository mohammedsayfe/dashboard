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
                <a href="{{ route('admin.members.index') }}" class="btn btn-info text-white" style="float: left" >رجوع</a>

@endsection

