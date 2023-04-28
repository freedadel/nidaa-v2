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
					
					<!-- <p>البحث حسب:</p> -->
					<!-- <p style="font-size: x-small;display:inline-block;margin-right:5px"><input type="radio" id="word_id" onclick="tword()" name="chk" value="chk0" checked> الكلمة</p>
					<p style="font-size: x-small;display:inline-block;margin-right:5px"><input type="radio" id="hope_id" onclick="hope()" name="chk" value="chk1"> الحوجة</p>
					<p style="font-size: x-small;display:inline-block;margin-right:5px"><input type="radio" id="path_id" onclick="path()" name="chk" value="chk2"> المنطقة</p>
					<p style="font-size: x-small;display:inline-block;margin-right:5px"><input type="radio" id="state_id" onclick="state()" name="chk" value="chk3"> الولاية</p> -->
					<div class="wrap-input100" id="hword">
						<input class="input100 @error('word') is-invalid @enderror" type="text"  id="word" name="word" placeholder="بحث..">
						<span class="focus-input100"></span>
						@error('word')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="wrap-input100">
						<select class="input100 @error('type') is-invalid @enderror" type="text" name="type">
						<option value="null">اختر حوجة او وفرة  </option>
	
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

					<div class="wrap-input100" id="htype" style="">
						<select class="input100 @error('htype_id') is-invalid @enderror" name="htype_id">
							<option value="null">اختر نوع الحوجة او الوفرة</option>
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
					<div class="wrap-input100" id="state" style="">
						<select class="input100 @error('state_id') is-invalid @enderror" id="state_id" type="text" name="state_id">
							<option value="null">اختر الولاية</option>
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
					<div class="wrap-input100 validate-input">
						<select class="input100 @error('locality_id') is-invalid @enderror" id="locality_id" name="area" required>
							<option value="">اختر المحلية</option>
							
						</select>
						<span class="focus-input100"></span>
						@error('locality_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					
					<!--<div id="html_element"></div>-->
				

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
