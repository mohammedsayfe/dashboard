@extends('layouts.admin')

@section('content')
    <div class="col-12 py-2 px-3 row">
        <h1 class="m-2 px-2 bold">
            لائحة المصروفات
            <a href="{{ route('admin.expens.create') }}" class="btn btn-info text-white" style="float: left" >إضافة مصروف جديده</a>
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>إسم المصروف</th>
                        <th> قيمة المصروف</th>
                        <th>البيان</th>
                        <th>اسم الموظف</th>
                        <th>التاريخ </th>
                        <th> العمليات</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($expens as $expen)
                    <tr>
                        <td>{{ $expen->id }}</td>
                        <td>{{ $expen->name }}</td>
                        <td>{{ $expen->price }}</td>
                        <td>{{ $expen->statement }}</td>

                        <td>{{ $expen->users->name }}</td>
                        <td>{{ $expen->date }}</td>
                        <td>
                            <div class="btn-group">
                                <a href=" {{ route('admin.expens.delete',$expen->id) }}" class="btn btn-danger"> حذف</a>
                                <a href=" {{ route('admin.expens.edit',$expen->id) }}" class="btn btn-success">تعديل</a>
                            </div>
{{--                           --}}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
