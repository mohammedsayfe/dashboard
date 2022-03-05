@extends('layouts.memberdata')
@section('content')
<form id="validate-form" method="POST" action="{{ route('checkpassword') }}" class="row" enctype="multipart/form-data">
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
		<div class="col-12 px-0">
			<div class="col-12 px-3 py-3">
			 	<span class="fal fa-info-circle"></span>	  التأكد من الباسورد
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>
        @csrf
        {{-- {{$data->password }} --}}
    <input type="hidden" value="{{ $data->password }}" name="oldpass">
    <input type="hidden" value="{{ $data->id }}" name="memberID">
        <div class="col-12 p-2">
            <div class="col-12">
                ادخل الباسورد
            </div>
            <div class="col-12 pt-3">

                <input type="password" name="password" required class="form-control" placeholder="أدخل الباسورد"  >
            </div>
        </div>
	</div>
</div>


<div class="col-12 p-3">
    <div class="col-12 col-lg-12 p-0 main-box">

            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">فحص</button>
            </div>

    </div>
</div>
</form>
@endsection
