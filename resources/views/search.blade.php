@extends('layout.app')

@section('content')
    	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('ads.searchResult') }}"  enctype = "multipart/form-data">
					@csrf
					
					<span class="login100-form-title mt-3" style="font-size: 0.8em">
						نداء
					</span>
					<span class="login100-form-title mt-1" style="font-size: 0.8em">
						ادخل رقم الحالة
					</span>

					<div class="wrap-input100" id="path">
					<input type="number" class="input100 @error('case_id') is-invalid @enderror" name="case_id" placeholder="رقم الحالة">
						<span class="focus-input100"></span>
						@error('case_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="font-family: Poppins-Regular;">
							 بحث &nbsp;<i class="fa fa-search"></i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
