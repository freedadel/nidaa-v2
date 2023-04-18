@extends('layout.app')

@section('content')
    	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('img/flag.jpg')}}" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('Public.result') }}">
					@csrf
					<div class="row" style="text-align: center">
					 <div class="col-6" style="margin:auto"><img src="{{asset('img/logo2.png')}}" alt="مقبول" style="width:100%"></div> 
					</div>
					<span class="login100-form-title mt-3" style="font-size: 0.8em">
						اختار مسارك وبإذن الله مقبول
					</span>
					<span class="login100-form-title mt-1" style="font-size: 0.8em">
						تطبيق للمساعدة في اختيار التخصص الجامعي والكليات المناسبة لرغبات الطالب ونتيجته في امتحان الشهادة
					</span>

					<p>الترشيح حسب:</p>
					<p style="font-size: x-small;display:inline-block;margin-right:5px"><input type="checkbox" id="hope_id" onclick="hope()" name="chk1" value="chk1" checked> الرغبة</p>
					<p style="font-size: x-small;display:inline-block;margin-right:5px"><input type="checkbox" id="path_id" onclick="path()" name="chk2" value="chk2"> المساق</p>
					<p style="font-size: x-small;display:inline-block;margin-right:5px"><input type="checkbox" id="state_id" onclick="state()" name="chk3" value="chk3"> السكن</p>
					<div class="wrap-input100 validate-input">
						<input class="input100 @error('percent') is-invalid @enderror" type="number" step="0.01" lang="en" min="49.00" max="100.00" name="percent" placeholder="النسبة" oninvalid="this.setCustomValidity('الرجاء ادخال ارقام بين 50 و 100 فقط، استخدم النقطة (.) بدلاً من الفاصلة العشرية')" oninput="this.setCustomValidity('')" required>
						<span class="focus-input100"></span>
						@error('percent')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="wrap-input100 validate-input" id="category">
						<select class="input100 @error('category_id') is-invalid @enderror" type="text" name="category_id">
							<option>اختر الرغبة</option>
							@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
							@endforeach

						</select>
						<span class="focus-input100"></span>
						@error('category_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100 validate-input" id="path" style="display: none">
						<select class="input100 @error('department_id') is-invalid @enderror" type="text" name="department_id">
							<option>اختر المساق</option>
							@foreach($departments as $department)
							<option value="{{$department->id}}">{{$department->name}}</option>
							@endforeach

						</select>
						<span class="focus-input100"></span>
						@error('department_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100 validate-input" id="state" style="display: none">
						<select class="input100 @error('state_id') is-invalid @enderror" type="text" name="state_id">
							<option>اختر الولاية</option>
							@foreach($states as $state)
							<option value="{{$state->id}}">{{$state->name}}</option>
							@endforeach

						</select>
						<span class="focus-input100"></span>
						@error('state_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<!--<div id="html_element"></div>-->


					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="font-family: Poppins-Regular;">
							الترشيحات
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
<script type="text/javascript">
  var onloadCallback = function() {
    alert("grecaptcha is ready!");
  };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>

<script type="text/javascript">
	var onloadCallback = function() {
	grecaptcha.render('html_element', {
		'sitekey' : '6LeL-EgaAAAAAILWjtBQtk5lAv-AMeA575Cep8DZ'
	});
	};
</script>
<script>
	function hope(){
		//document.getElementById('state').style.display = "none";
		//document.getElementById('path').style.display = "none";
		if(document.getElementById('hope_id').checked == true){
			document.getElementById('category').style.display = "block";
		}else{
			document.getElementById('category').style.display = "none";
		}
		
	}function path(){
		//document.getElementById('state').style.display = "none";
		//document.getElementById('category').style.display = "none";
		if(document.getElementById('path_id').checked == true){
			document.getElementById('path').style.display = "block";
		}else{
			document.getElementById('path').style.display = "none";
		}
	}function state(){
		//document.getElementById('path').style.display = "none";
		//document.getElementById('category').style.display = "none";
		if(document.getElementById('state_id').checked == true){
			document.getElementById('state').style.display = "block";
		}else{
			document.getElementById('state').style.display = "none";
		}
	}
</script>
