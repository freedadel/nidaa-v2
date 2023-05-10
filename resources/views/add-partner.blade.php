@extends('layout.app')

@section('content')
    	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('img/flag.jpg')}}" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('store-partners') }}"  enctype = "multipart/form-data">
					@csrf
					<div class="row" style="text-align: center">
					 <div class="col-6" style="margin:auto"><img src="{{asset('img/logo2.png')}}" alt="نداء" style="width:100%"></div> 
					</div>
					
					<span class="login100-form-title mt-1" style="font-size: 0.8em">
						ادخل البيانات بدقة من فضلك
					</span>

					<div class="wrap-input100 validate-input" id="path">
						<input type="text" class="input100 @error('name') is-invalid @enderror" name="name" placeholder="اكتب اسم المبادرة">
						<span class="focus-input100"></span>
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="wrap-input100" id="path">
						<input type="text" class="input100 @error('link') is-invalid @enderror" name="link" placeholder="رابط الموقع او الصفحة" required>
							<span class="focus-input100"></span>
							@error('link')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
					</div>
					
					<div id="path">
					<input type="phone" class="input100 @error('phone') is-invalid @enderror" name="phone" placeholder="رقم الهاتف" required>
						<span class="focus-input100"></span>
						@error('phone')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					
					<div class="wrap-input100 validate-input mt-2" id="path">
						<textarea class="input100 @error('details') is-invalid @enderror" name="details" style="height: 200px" rows="4" placeholder="اكتب التفاصيل"></textarea>
							<span class="focus-input100"></span>
							@error('details')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
					</div>
					<div class="wrap-input100" id="path">
						ادخل الصورة - اختياري
					<input type="file" class="input100 @error('img') is-invalid @enderror" name="img">
						<span class="focus-input100"></span>
						@error('img')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<!--<div id="html_element"></div>-->
					<div class="wrap-input100 validate-input" id="path">
						<?php
							$value1=rand(0,10);
							$value2=rand(0,10);
						?>
						كم حاصل جمع {{$value1}} + {{$value2}}
						<input type="hidden" name="value1" value="{{$value1}}">
						<input type="hidden" name="value2" value="{{$value2}}">
						<input type="number" class="input100 @error('result') is-invalid @enderror" name="result" placeholder="اكتب الناتج" required>
						<span class="focus-input100"></span>
						@error('result')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="font-family: Poppins-Regular;">
							<i class="fa fa-plus"></i> اضافة 
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
