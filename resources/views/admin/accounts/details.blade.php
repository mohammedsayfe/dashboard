

@extends('layouts.admin')

@section('content')
    <div class="col-12 py-2 px-3 row">
        <h1 class="m-2 px-2 bold">
                        <<center>تقرير عن حسابات الاعضاء</center>
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الحساب</th>
                        <th>اسم البنك</th>
                        <th>صاحب الحساب</th>
                        <th>الرصيد</th>
                        <th>الفرع</th>
                        <th>البيان</th>

                    </tr>
                </thead>
                <tbody>
                @foreach($account as $accounts)
                    <tr>
                        <td>{{ $accounts->id }}</td>
                        <td>{{ $accounts->account_number }}</td>
                        <td>{{ $accounts->banks->name }}</td>
                        <td>{{ $accounts->member->name }}</td>
                        <td>{{ $accounts->balance }}</td>
                        <td>{{ $accounts->branch }}</td>
                        <td>{{ $accounts-> statement}}
                        <td>

                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <a href="{{ route('admin.account.create') }}" class="btn btn-info text-white" style="float: left" >رجوع</a>
        </div>
    </div>
@endsection
