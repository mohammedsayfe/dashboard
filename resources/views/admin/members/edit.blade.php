@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">

		<div class="col-12 px-0">
			<div class="col-12 px-3 py-3">
			 	<span class="fal fa-info-circle"></span>   تعديل بيانات العضو - {{ $member->name }}
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>
		<form id="validate-form" method="post" action="{{ route('admin.members.update', $member) }}" class="row" enctype="multipart/form-data">
		    @csrf
            @method('PATCH')
            <div class="col-12 col-lg-12 p-3">
                <div class="col-12 p-2">
                    <div class="col-12">
                        إسم العضو
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="name" value="{{ $member->name }}" required minlength="3" maxlength="190" class="form-control"  >
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        رقم الهوية
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="id_number" value="{{ $member->id_number }}" required minlength="3" maxlength="190" class="form-control"  >
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        البريد الالكتروني
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="email" value="{{ $member->email }}" required minlength="3" maxlength="190" class="form-control"  >
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        رقم الهاتف
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="phone" value="{{ $member->phone }}" required minlength="3" maxlength="190" class="form-control"  >
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="col-12">
                        عدد الاسهم
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="number_of_shares" value="{{ $member->number_of_shares }}" required minlength="3" maxlength="190" class="form-control"  >
                    </div>
                </div>
            </div>
            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">حفظ</button>
            </div>
		</form>
	</div>
</div>
@endsection
