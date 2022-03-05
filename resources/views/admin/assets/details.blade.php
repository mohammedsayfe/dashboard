@extends('layouts.admin')
@section('content')
    <div id="invoice" style="background: #fff">
        <div class="col-12 p-3" style="text-align: center; max-width: 100%;">
            <div class="col-12 col-lg-12 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fal fa-info-circle"></span> فاتوره -
                    </div>

                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>إسم الاصل</th>
                        <th>قيمة الاصل </th>
                        <th> العدد</th>
                        <th> الوصف</th>

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
