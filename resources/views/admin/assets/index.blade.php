@extends('layouts.admin')

@section('content')
    <div class="col-12 py-2 px-3 row">
        <h1 class="m-2 px-2 bold">
             الاصول
            <a href="{{ route('admin.assest.create') }}" class="btn btn-info text-white" style="float: left" >إضافة اصل جديده</a>
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>إسم الاصل</th>
                        <th>قيمة الاصل </th>
                        <th> العدد</th>
                        <th> الوصف</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($assets as $asset)
                    <tr>
                        <td>{{ $asset->id }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>{{ $asset->value }}</td>
                        <td>{{ $asset->number }}</td>
                        <td>{{ $asset->description }}</td>
                        <td>
                            <div class="btn-group">
                                <a  href="{{ route('admin.assest.delete',$asset->id) }}" class="btn btn-danger">حذف</a>
                                <a href="{{ route('admin.assest.edit',$asset->id) }}" class="btn btn-success">تعديل</a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
