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
svg{
	height: 10px !important;
}
.relative .inline-flex .items-center .px-4 .py-2 .-ml-px .text-sm .font-medium .text-gray-500 .bg-white .border .border-gray-300 .cursor-default .leading-5{
padding-right: .5rem !important;
padding-left: .5rem !important;
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
						<a href="{{route('public.dashboard')}}" class="card col-12 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block">
								 الرجوع للرئيسية 
							</div>
						</a>
					</div>
					
					<a href="{{route('partners-create')}}"
					class="login100-form-btn mb-2" style="font-family: Poppins-Regular;color:white !important;margin-top:5px">
						+ اضافة مبادرة</a>
					@if(count($partners) > 0)
						@foreach ($partners as $index => $partner)
						<a href="#" onclick='sw({{$partner->id}})'>
							<input type="hidden" name="name{{$partner->id}}" id="name{{$partner->id}}" value="{{$partner->name}}">
							<input type="hidden" name="phone{{$partner->id}}" id="phone{{$partner->id}}" value="{{$partner->phone}}">
							<input type="hidden" name="details{{$partner->id}}" id="details{{$partner->id}}" value="{{$partner->details}}">
							<input type="hidden" name="link{{$partner->id}}" id="link{{$partner->id}}" value="{{$partner->link}}">
						<div class="card mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-success  border-3 shadow" style="height: 70px">
							<div class="row mr-1 ml-1">
								
							<div class="col-9" style="display: inline-block">
								
								<h6 style="font-size: small;color:#333333 !important;margin-top:2px">
									{{$partner->id}}. {{\Illuminate\Support\Str::limit($partner->name, 30, $end='...')}}
								</h6>
								<h6 class="mt-1" style="text-align:justify">
									<span style="font-size: x-small;color:#3b3c3d !important">{{\Illuminate\Support\Str::limit($partner->details, 150, $end='...')}}</span>
								</h6>
								
							</div>
							<div class="col-3" style="display: inline-block">
								<img src="{{asset('img/partners/'.$partner->img)}}" width="100%" style="border-radius:20px;margin-top:10px " alt="">
							</div>
							</div>
						</div>
						</a>
						@endforeach	
						
					@else
						<h4 class="text-center">عذراً لا يوجد مبادرات</h4>
					@endif
				</form>
			</div>
		</div>
	</div>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

	function sw(id){
		var name = document.getElementById('name'+id).value;
		var link = document.getElementById('link'+id).value;
		var details = document.getElementById('details'+id).value;

		swal(name, details, "success", {
		buttons: {
			cancel: "اغلاق",
			catch: {
			text: "انتقال",
			value: "catch",
			}
		},
		})
		.then((value) => {
		switch (value) {

			case "catch":
			window.location.replace(link);
			break;
		
			default:
			
		}
		});
	}
	
</script>	
@endsection
