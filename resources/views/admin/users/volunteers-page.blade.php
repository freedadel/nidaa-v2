@extends('layout.admin')
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
					<div class="row">
						<h6 style="margin: auto">طلبات التطوع</h6>
					</div>
					<hr>
					<div class="row">
						<h6 style="margin: auto">مرحبا بك {{auth()->user()->name}}</h6>
					</div>

					@if(count($volunteers) > 0)
						@foreach ($volunteers as $index => $volunteer)
						<a href="#" onclick="volunteer({{$volunteer->id}});">
							
							<input type="hidden" name="name{{$volunteer->id}}" id="name{{$volunteer->id}}" value="{{$volunteer->name}}">
							<input type="hidden" name="phone{{$volunteer->id}}" id="phone{{$volunteer->id}}" value="{{$volunteer->phone}}">
							<input type="hidden" name="phone2{{$volunteer->id}}" id="phone2{{$volunteer->id}}" value="{{$volunteer->phone2}}">
							<input type="hidden" name="area{{$volunteer->id}}" id="area{{$volunteer->id}}" value="{{$volunteer->area}}">
							<input type="hidden" name="address{{$volunteer->id}}" id="address{{$volunteer->id}}" value="{{$volunteer->address}}">
							<input type="hidden" name="country{{$volunteer->id}}" id="country{{$volunteer->id}}" value="{{!empty($volunteer->country)?$volunteer->country:'السودان'}}">
							<input type="hidden" name="htype{{$volunteer->id}}" id="htype{{$volunteer->id}}" value="{{$volunteer->htype->name}}">
							<input type="hidden" name="state{{$volunteer->id}}" id="state{{$volunteer->id}}" value="{{!empty($volunteer->state_id)?$volunteer->state->name:''}}">
							<input type="hidden" name="locality{{$volunteer->id}}" id="locality{{$volunteer->id}}" value="{{!empty($volunteer->locality_id)?$volunteer->locality->name:''}}">
						<div class="card mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 @if($volunteer->type==1)border-danger @else border-success @endif border-3 shadow" style="height: 70px">
							<div class="row mr-1 ml-1">
								
							<div class="col-9" style="display: inline-block">
								<h6 style="font-size: small;color:#333333 !important;margin-top:2px">
									{{$index+1}}. {{\Illuminate\Support\Str::limit($volunteer->name, 50, $end='...')}}
									<br><span style="font-size: x-small;color:#1e7a16 !important">{{!empty($volunteer->country)?$volunteer->country:'السودان'}}</span><br>
									<span style="font-size: x-small;color:#333333 !important">{{\Illuminate\Support\Str::limit($volunteer->created_at, 30, $end='...')}}</span>
								</h6>
								<h6 class="mt-1">
									<span style="font-size: small;color:#3b3c3d !important">{{\Illuminate\Support\Str::limit($volunteer->phone, 30, $end='...')}}</span>
								</h6>
								
							</div>
							<div class="col-3">
								<span style="font-size: small;color:#3b3c3d !important">{{\Illuminate\Support\Str::limit($volunteer->htype->name, 30, $end='...')}}</span>
							</div>
							</div>
						</div>
					</a>
						@endforeach	
						
					@else
						<h4 class="text-center">عذراً لا يوجد طلبات تطوع</h4>
					@endif
				</form>


			</div>
		</div>
	</div>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	function volunteer(id){
		
		var name = document.getElementById('name'+id).value;
		var phone = document.getElementById('phone'+id).value;
		var phone2 = document.getElementById('phone2'+id).value;
		var country = document.getElementById('country'+id).value;
		var htype = document.getElementById('htype'+id).value;
		var state = document.getElementById('state'+id).value;
		var locality = document.getElementById('locality'+id).value;
		var area = document.getElementById('area'+id).value;
		var address = document.getElementById('address'+id).value;
		
		if(phone.length <= 10){
			if(country == 'السودان'){
				phone = '249'+parseInt(phone);
			}
		}
		
		//swal(phone, address+" - "+details, msg);

		
		swal(name+" - "+htype+" - "+country+" - "+state+" - "+locality+" - "+area+" - "+address+" - "+phone+" - "+phone2, {
		buttons: {
			cancel: "اغلاق",
			catch: {
			text: "تم التأكد",
			value: "catch",
			},
			defeat: {
			text: "مراسلة",
			value: "defeat",
			}
		},
		})
		.then((value) => {
		switch (value) {

			case "catch":
			window.open("/archive-volunteer/"+id);
			break;
		
			case "defeat":
			window.open("https://wa.me/"+phone, '_blank');
			break;
		
		
			default:
			
		}
		});
	}
</script>
@endsection
