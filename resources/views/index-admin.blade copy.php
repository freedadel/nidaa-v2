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
				</div>
				<form class="login100-form validate-form" action="/">
					
					<br>
					<div class="row">
						<h6 style="margin: auto">مرحبا بك {{auth()->user()->name}}</h6>
					</div>
					<div class="row mt-3 mb-3">
						<h6 style="margin: auto"><a href="{{route('ads.searchCase')}}">اضغط هنا للبحث عن حالة</a></h6>
					</div>
					@if(count($ads) > 0)
						@foreach ($ads as $index => $ad)
						<a href="#" onclick='sw({{$ad->id}})'>
							@if(!empty($ad->state_id))
							<input type="hidden" name="state{{$ad->id}}" id="state{{$ad->id}}" value="{{$ad->state->name}}">
							@else
							<input type="hidden" name="state{{$ad->id}}" id="state{{$ad->id}}" value="">
							@endif
							<input type="hidden" name="area{{$ad->id}}" id="area{{$ad->id}}" value="{{$ad->area}}">
							@if(!empty($ad->htype))
							<input type="hidden" name="htype{{$ad->id}}" id="htype{{$ad->id}}" value="{{$ad->htype->name}}">
							@else
							<input type="hidden" name="htype{{$ad->id}}" id="htype{{$ad->id}}" value="-">
							@endif
							<input type="hidden" name="sec_status{{$ad->id}}" id="sec_status{{$ad->id}}" value="{{$ad->sec_status}}">
							<input type="hidden" name="address{{$ad->id}}" id="address{{$ad->id}}" value="{{$ad->address}}">
							<input type="hidden" name="details{{$ad->id}}" id="details{{$ad->id}}" value="{{$ad->details}}">
							<input type="hidden" name="type{{$ad->id}}" id="type{{$ad->id}}" value="{{$ad->type}}">
							<input type="hidden" name="phone{{$ad->id}}" id="phone{{$ad->id}}" value="{{$ad->phone}}">
						<div class="card mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 @if($ad->type==1)border-danger @else border-success @endif border-3 shadow" style="height: 70px">
							<div class="row mr-1 ml-1">
								
							<div class="col-9" style="display: inline-block">
								
								<h6 style="font-size: small;color:#333333 !important;margin-top:2px">
									{{$ad->id}}. @if(!empty($ad->state_id)){{\Illuminate\Support\Str::limit($ad->state->name, 30, $end='...')}} - @endif{{\Illuminate\Support\Str::limit($ad->area, 50, $end='...')}}
									<br><span style="font-size: x-small;color:#1e7a16 !important">{{$ad->created_at->diffForHumans()}}</span><br>
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
			var state = document.getElementById('state'+id).value;
			var htype = document.getElementById('htype'+id).value;
			var sec_status = document.getElementById('sec_status'+id).value;
			var area = document.getElementById('area'+id).value;
			var address = document.getElementById('address'+id).value;
			var details = document.getElementById('details'+id).value;
			var type = document.getElementById('type'+id).value;
			var phone = document.getElementById('phone'+id).value;
			if(type==1)
			msg = "warning"
			else
			msg = "success"
			swal(phone, state+" - "+area+" - "+address+" - التصنيف: "+htype+" - "+details+" - الوضع الأمني: "+sec_status, msg);
		}
	
		function clos() {
			var details = document.getElementById('container');
			details.style.display = "none";
		}
	</script>	
	@endsection
	