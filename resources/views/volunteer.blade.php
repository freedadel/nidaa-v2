@extends('layout.app')

@section('content')
    	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('img/flag.jpg')}}" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('storeVolunteer') }}"  enctype = "multipart/form-data">
					@csrf
					<div class="row" style="text-align: center">
					 <div class="col-6" style="margin:auto"><img src="{{asset('img/logo2.png')}}" alt="نداء" style="width:100%"></div> 
					</div>
					
					<span class="login100-form-title mt-1" style="font-size: 0.8em">
						ادخل البيانات بدقة لمساعدة غيرك
					</span>

					<div class="wrap-input100 validate-input" id="path">
						<input type="text" class="input100 @error('name') is-invalid @enderror" name="name" placeholder="اسمك">
						<span class="focus-input100"></span>
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100 validate-input">
						<select class="input100 @error('place') is-invalid @enderror" id="place" name="place">
							<option value="">مكانك</option>
							<option value="1">داخل السودان</option>
							<option value="2">خارج السودان</option>
						</select>
						<span class="focus-input100"></span>
						@error('place')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100" id="country" style="display: none">
						<input type="text" class="input100 @error('country') is-invalid @enderror" name="country" placeholder="الدولة">
						<span class="focus-input100"></span>
						@error('country')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100 validate-input" id="htype">
						<select class="input100 @error('htype') is-invalid @enderror" name="htype" required>
							<option value="">نوع المساعدة التي يمكنك تقديمها</option>
							@foreach ($htypes as $htype)
							<option value="{{$htype->id}}">{{$htype->name}}</option>
							@endforeach
						</select>
						<span class="focus-input100"></span>
						@error('htype')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100" id="state">
						<select class="input100 @error('state') is-invalid @enderror" id="state_id" name="state">
							<option value="">اختر الولاية</option>
							@foreach ($states as $state)
							<option value="{{$state->id}}">{{$state->name}}</option>
							@endforeach
						</select>
						<span class="focus-input100"></span>
						@error('state')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100" id="locality">
						<select class="input100 @error('locality_id') is-invalid @enderror" id="locality_id" name="locality_id">
							<option value="">اختر المحلية</option>
							
						</select>
						<span class="focus-input100"></span>
						@error('locality_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100" id="area">
						<input type="text" class="input100 @error('area') is-invalid @enderror" name="area" placeholder="اكتب الحي">
						<span class="focus-input100"></span>
						@error('area')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100" id="address">
						<input type="text" class="input100 @error('address') is-invalid @enderror" name="address" placeholder="وصف العنوان">
						<span class="focus-input100"></span>
						@error('address')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100" id="path">
					<input type="phone" class="input100 @error('phone') is-invalid @enderror" name="phone" placeholder="رقم الهاتف" required>
						<span class="focus-input100"></span>
						@error('phone')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="wrap-input100" id="path">
						<input type="phone2" class="input100 @error('phone2') is-invalid @enderror" name="phone2" placeholder="رقم هاتف اضافي">
							<span class="focus-input100"></span>
							@error('phone2')
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
							<i class="fa fa-plus"></i> حفظ 
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
	$('#place').on('change', e => {
		var place = document.getElementById('place').value;

		if(place == 1){
			document.getElementById('country').style.display = "none";
			document.getElementById('state').style.display = "block";
			document.getElementById('locality').style.display = "block";
			document.getElementById('address').style.display = "block";
			document.getElementById('area').style.display = "block";
		}else{
			document.getElementById('country').style.display = "block";
			document.getElementById('state').style.display = "none";
			document.getElementById('locality').style.display = "none";
			document.getElementById('address').style.display = "none";
			document.getElementById('area').style.display = "none";
		}
	});
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
