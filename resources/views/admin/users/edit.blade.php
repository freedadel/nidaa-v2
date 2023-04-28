@extends('layout.admin')

@section('content')
    	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('img/flag.jpg')}}" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('users.update',$user->id) }}"  enctype = "multipart/form-data">
					@csrf
					@method('PUT')
					<span class="login100-form-title mt-3" style="font-size: 0.8em">
						تعديل مستخدم
					</span>
					
					<div class="wrap-input100 validate-input">
						<input type="text" class="input100 @error('name') is-invalid @enderror" name="name" placeholder="اكتب الاسم" value="{{$user->name}}">
						<span class="focus-input100"></span>
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="wrap-input100">
						<input type="text" class="input100 @error('bio') is-invalid @enderror" name="bio" placeholder="نبذة عن المستخدم" value="{{$user->bio}}">
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
							@if(auth()->user()->email == "0921003398" || auth()->user()->email == "0923734194" || 
							auth()->user()->email == "0920996316" || auth()->user()->email == "0110012620" ||
							auth()->user()->email == "0925687117")
							<option value="1" @if($user->admin == 1) selected @endif>مشرف</option>
							<option value="2" @if($user->admin == 2) selected @endif>مشغل</option>
							@elseif(auth()->user()->admin == 1)
							<option value="2" @if($user->admin == 2) selected @endif>مشغل</option>
							@endif
							<option value="3" @if($user->admin == 3) selected @endif>متطوع</option>
						</select>
						<span class="focus-input100"></span>
						@error('admin')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100">
						<input type="tel" class="input100 @error('phone') is-invalid @enderror" name="email" placeholder="رقم الهاتف" value="{{$user->email}}" required>
							<span class="focus-input100"></span>
							@error('phone')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
					</div>
					<div class="wrap-input100">
					<input type="password" class="input100 @error('password') is-invalid @enderror" name="password" placeholder="كلمة المرور الجديدة">
						<span class="focus-input100"></span>
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="font-family: Poppins-Regular;">
							<i class="fa fa-save"></i> تحديث البيانات 
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

