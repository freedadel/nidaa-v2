@extends('layout.app')
<style>
	#container {
  width: 100px;
  height: max-content;
  position: absolute;
  top: 0;
  right: auto;

  z-index: 10;
}
p{
	font-size: x-small !important;
	text-align: justify;
}
a{
	color:#262626 !important;
}
.border-3 {
    border-width:4px !important;
	box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
</style>
@section('content')
    	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('img/flag.jpg')}}" alt="IMG">
				</div>
				<form class="login100-form validate-form" action="/">
					<!--<div class="row" style="text-align: center">
						<div class="col-6" style="margin:auto"><img src="{{asset('img/logo2.png')}}" alt="نداء" style="width:100%"></div> 
					</div>-->
					<div class="row mr-1 ml-1">
						@if(count($ads->where('type',1)) > 0)
						<a href="{{route('type1')}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-danger border-3 shadow" style="height: 30px">
						<div class="col-12" style="display: inline-block">
							
							 حوجة {{count($ads->where('type',1))}}
						</div>
						</a>
						@else
						<a href="{{route('public.index')}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block">
								 الكل 
							</div>
						</a>
						@endif
						@if(count($ads->where('type',2)) > 0)
						<a href="{{route('type2')}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-success border-3 shadow" style="height: 30px">
						<div class="col-12" style="display: inline-block">
							 وفرة {{count($ads->where('type',2))}}
						</div>
						</a>
						@else
						<a href="{{route('public.index')}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block">
								 الكل 
							</div>
						</a>
						@endif
					</div>
					<br>
					<div class="row">
						<a href="{{route('login')}}" style="margin: auto">تسجيل الدخول</a>
					</div>
					<a href="{{route('ads.create')}}"
					class="login100-form-btn" style="font-family: Poppins-Regular;color:white !important;margin-top:5px">
						+ اضافة نداء					</a>
					@if(count($ads) > 0)
						@foreach ($ads as $index => $ad)
						<a href="#" onclick='sw({{$ad->id}})'>
							<input type="hidden" name="address{{$ad->id}}" id="address{{$ad->id}}" value="{{$ad->address}}">
							<input type="hidden" name="details{{$ad->id}}" id="details{{$ad->id}}" value="{{$ad->details}}">
							<input type="hidden" name="type{{$ad->id}}" id="type{{$ad->id}}" value="{{$ad->type}}">
							<input type="hidden" name="phone{{$ad->id}}" id="phone{{$ad->id}}" value="{{$ad->phone}}">
						<div class="card mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 @if($ad->type==1)border-danger @else border-success @endif border-3 shadow" style="height: 70px">
							<div class="row mr-1 ml-1">
								
							<div class="col-9" style="display: inline-block">
								
								<h6>
									{{$ad->id}}. {{\Illuminate\Support\Str::limit($ad->area, 50, $end='...')}}
									<br>
									<span style="font-size: x-small;color:#333333 !important">{{\Illuminate\Support\Str::limit($ad->created_at, 50, $end='...')}}</span>
								</h6>
								<h6 class="mt-1">
									<span style="font-size: x-small;color:#3b3c3d !important">{{\Illuminate\Support\Str::limit($ad->details, 50, $end='...')}}</span>
								</h6>
								
							</div>
						
							<div class="col-3 text-center" style="display: inline-block;margin:auto;height:65">
								<h6 class="text-dark mt-4" style="margin: auto">{{$ad->type==1?"حوجة":"وفرة"}}</h6>
							</div>
							</div>
						</div>
					</a>
						@endforeach	
					@else
						<h4 class="text-center">عذراً لا يوجد نداءات</h4>
					@endif

				
					
					
					<div class="card" id="container" style="width: 18rem;display:none">
					<img id="newimg" src="..." class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title" id="university">المنطقة</h5>
						<h5 class="card-title" id="phone">الهاتف</h5>
						<p class="card-text" style="position: inherit;font-size:11px !important" id="data">حول </p>
						
						<a href="#" onclick="clos()" class="btn btn-danger" style="width: 100%;margin-top:10px">اغلاق</a>
					</div>
					</div>
				</form>


			</div>
		</div>
	</div>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	
	function about(desc,newdata,phone1,newimg) {
	
    var details = document.getElementById('container');
	var university = document.getElementById('university');
	var phone = document.getElementById('phone');
	var data = document.getElementById('data');
	var img = document.getElementById('newimg');
		
		details.style.display = "block";
		university.innerText = desc;
		phone.innerText = phone1;
		data.innerHTML = newdata;
		data.style.fontSize = '11px !important';

		img.src='img/ads/'+newimg;

	}
	
	function sw(id){
		var address = document.getElementById('address'+id).value;
		var details = document.getElementById('details'+id).value;
		var type = document.getElementById('type'+id).value;
		var phone = document.getElementById('phone'+id).value;
		if(type==1)
		msg = "warning"
		else
		msg = "success"
		swal(phone, address+" - "+details, msg);
	}

	function clos() {
		var details = document.getElementById('container');
		details.style.display = "none";
	}
</script>	
@endsection
