@extends('layouts.admin')

@section('content')
    <div class="col-12 py-2 px-3 row">
        <h1 class="m-2 px-2 bold">
            لائحة الاعضاء
            <a href="{{ route('admin.members.create') }}" class="btn btn-info text-white" style="float: left" >إضافة عضو</a>
            <a href="{{ route('admin.members.details',3) }}" class="btn btn-info text-white" style="float: left" >تفاصيل عن  الاعضاء</a>
        </h1>
        <div class="table-responsive">
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
@endsection
