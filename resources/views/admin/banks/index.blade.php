@extends('layouts.admin')

@section('content')
    <div class="col-12 py-2 px-3 row">
        <h1 class="m-2 px-2 bold">
            لائحة البنوك
            <a href="{{ route('admin.bank.create') }}" class="btn btn-info text-white" style="float: left" >إضافة بنك جديده</a>
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>إسم البنك</th>
                        <th> العنوان</th>
                        <th>الوصف</th>
                        <th>اسم الموظف</th>
                        <th> العمليات</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($banks as $bank)
                    <tr>
                        <td>{{ $bank->id }}</td>
                        <td>{{ $bank->name }}</td>
                        <td>{{ $bank->address }}</td>
                        <td>{{ $bank->description }}</td>
                        <td>{{ $bank->users->name }}</td>


                        <td>
                            <div class="btn-group">
                                <a href=" {{ route('admin.bank.delete',$bank->id) }}" class="btn btn-danger"> حذف</a>
                                <a href=" {{ route('admin.bank.edit',$bank->id) }}" class="btn btn-success">تعديل</a>
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
