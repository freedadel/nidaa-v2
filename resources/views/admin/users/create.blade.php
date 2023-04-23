@extends('layout.admin')

@section('content')
    	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('img/flag.jpg')}}" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('users.store') }}"  enctype = "multipart/form-data">
					@csrf
					<span class="login100-form-title mt-3" style="font-size: 0.8em">
						اضافة مستخدم
					</span>

					<div class="wrap-input100 validate-input">
						<input type="text" class="input100 @error('name') is-invalid @enderror" name="name" placeholder="اكتب الاسم">
						<span class="focus-input100"></span>
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="wrap-input100">
						<input type="text" class="input100 @error('bio') is-invalid @enderror" name="bio" placeholder="نبذة عن المستخدم">
						<span class="focus-input100"></span>
						@error('bio')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					
					<div class="wrap-input100 validate-input" id="admin">
						<select class="input100 @error('admin') is-invalid @enderror" name="admin">
							<option value="">اختر الصلاحيات</option>
							@if(auth()->user()->admin ==1)
							<option value="1">مشرف</option>
							<option value="2">مشغل</option>
							@endif
							<option value="3">متطوع</option>
						</select>
						<span class="focus-input100"></span>
						@error('admin')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100">
						<input type="tel" class="input100 @error('phone') is-invalid @enderror" name="email" placeholder="رقم الهاتف" required>
							<span class="focus-input100"></span>
							@error('phone')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
					</div>
					<div class="wrap-input100">
					<input type="password" class="input100 @error('password') is-invalid @enderror" name="password" placeholder="كلمة المرور" required>
						<span class="focus-input100"></span>
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="font-family: Poppins-Regular;">
							<i class="fa fa-save"></i> حفظ المستخدم 
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
	$(document).ready(function(){
		$('#state_id').on('change', e => {
    	$('#locality_id').empty()
          $.ajax({
              url: `/state/${document.getElementById('state_id').value}/localities`,
              success: data => {
                  data.localities.forEach(locality =>
                      $('#locality_id').append(`<option value="${locality.id}">${locality.name}</option>`)
                  )
              }
          })
          });
	});
	</script>
