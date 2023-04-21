@extends('layout.app')

@section('content')
    	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('img/flag.jpg')}}" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('ads.searchResultPublic') }}">
					@csrf
					
					<p>البحث حسب:</p>
					<p style="font-size: x-small;display:inline-block;margin-right:5px"><input type="radio" id="word_id" onclick="tword()" name="chk" value="chk0" checked> الكلمة</p>
					<p style="font-size: x-small;display:inline-block;margin-right:5px"><input type="radio" id="hope_id" onclick="hope()" name="chk" value="chk1"> الحوجة</p>
					<p style="font-size: x-small;display:inline-block;margin-right:5px"><input type="radio" id="path_id" onclick="path()" name="chk" value="chk2"> المنطقة</p>
					<p style="font-size: x-small;display:inline-block;margin-right:5px"><input type="radio" id="state_id" onclick="state()" name="chk" value="chk3"> الولاية</p>
					<div class="wrap-input100" id="hword">
						<input class="input100 @error('word') is-invalid @enderror" type="text"  id="word" name="word" placeholder="الكلمة">
						<span class="focus-input100"></span>
						@error('word')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="wrap-input100" id="htype" style="display: none">
						<select class="input100 @error('htype_id') is-invalid @enderror" name="htype_id">
							<option>اختر نوع الحوجة</option>
							@foreach($htypes as $htype)
							<option value="{{$htype->id}}">{{$htype->name}}</option>
							@endforeach

						</select>
						<span class="focus-input100"></span>
						@error('htype_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100" id="path" style="display: none">
						<select class="input100 @error('area') is-invalid @enderror" name="area">
							<option>اختر المنطقة</option>
							@foreach($ads as $ad)
							<option value="{{$ad->area}}">{{$ad->area}}</option>
							@endforeach

						</select>
						<span class="focus-input100"></span>
						@error('area')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100" id="state" style="display: none">
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
					<div class="wrap-input100">
						<select class="input100 @error('type') is-invalid @enderror" type="text" name="type">
							<option value="1">الحوجة</option>
							<option value="2">الوفرة</option>
						</select>
						<span class="focus-input100"></span>
						@error('type')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="font-family: Poppins-Regular;">
							ابحث الآن &nbsp;<i class="fa fa-search"></i>
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
	function tword(){
		//document.getElementById('state').style.display = "none";
		//document.getElementById('path').style.display = "none";
		if(document.getElementById('word_id').checked == true){
			document.getElementById('hword').style.display = "block";
			document.getElementById('htype').style.display = "none";
			document.getElementById('state').style.display = "none";
			document.getElementById('path').style.display = "none";
		}else{
			document.getElementById('hword').style.display = "none";
		}
		
	}
	function hope(){
		//document.getElementById('state').style.display = "none";
		//document.getElementById('path').style.display = "none";
		if(document.getElementById('hope_id').checked == true){
			document.getElementById('htype').style.display = "block";
			document.getElementById('hword').style.display = "none";
			document.getElementById('state').style.display = "none";
			document.getElementById('path').style.display = "none";
		}else{
			document.getElementById('htype').style.display = "none";
		}
		
	}function path(){
		//document.getElementById('state').style.display = "none";
		//document.getElementById('htype').style.display = "none";
		if(document.getElementById('path_id').checked == true){
			document.getElementById('path').style.display = "block";
			document.getElementById('hword').style.display = "none";
			document.getElementById('state').style.display = "none";
			document.getElementById('htype').style.display = "none";
		}else{
			document.getElementById('path').style.display = "none";
		}
	}function state(){
		//document.getElementById('path').style.display = "none";
		//document.getElementById('htype').style.display = "none";
		if(document.getElementById('state_id').checked == true){
			document.getElementById('state').style.display = "block";
			document.getElementById('hword').style.display = "none";
			document.getElementById('htype').style.display = "none";
			document.getElementById('path').style.display = "none";
		}else{
			document.getElementById('state').style.display = "none";
		}
	}
</script>
