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
.px-4{
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
				<div class="row col-12 mr-1 ml-1">
				<h6 style="color:brown">الحوجة والوفرة</h6>
				</div>
				
				<div class="row col-12 mr-1 ml-1">
					<a href="{{route('type1')}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-danger border-3 shadow" style="height: 30px">
						<div class="col-12" style="display: inline-block">
							 {{count($ads->where('type',1))}} حوجة 
						</div>
					</a>
					<a href="{{route('type2')}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-success border-3 shadow" style="height: 30px">
						<div class="col-12" style="display: inline-block">
							 {{count($ads->where('type',2))}} وفرة 
						</div>
					</a>
				</div>
				<div class="row col-12 mr-1 ml-1 mt-3">
					<h6 style="color:brown">نوع الحوجة</h6>
				</div>
				<div class="row col-12 mr-1 ml-1">
					@foreach ($htypes as $htype)
					<a href="{{route('public.byHtype',$htype->id)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-warning border-3 shadow" style="height: 30px">
						<div class="col-12" style="display: inline-block;font-size:x-small">
							 {{count($ads->where('htype_id',$htype->id))}} {{$htype->name}} 
						</div>
					</a>
					@endforeach
					<a href="{{route('public.byHtype',0)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-warning border-3 shadow" style="height: 30px">
						<div class="col-12" style="display: inline-block;font-size:x-small">
							 {{count($ads->where('htype_id',null))}} غير محدد 
						</div>
					</a>
					</div>

					<div class="row col-12 mr-1 ml-1 mt-3">
					<h6 style="color:brown">الحوجات المكتملة</h6>
					</div>
					<div class="row col-12 mr-1 ml-1">
					
					<a href="{{route('public.byStatus',2)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-success border-3 shadow" style="height: 30px">
						<div class="col-12" style="display: inline-block;font-size:x-small">
								{{count($ads->where('status',2))}} حوجات مكتملة
						</div>
					</a>

					<a href="{{route('public.byStatus',1)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-danger border-3 shadow" style="height: 30px">
						<div class="col-12" style="display: inline-block;font-size:x-small">
							{{count($ads->where('status',1))}} قيد الانتظار
						</div>
					</a>
					
					</div>

				<div class="row col-12 mr-1 ml-1 mt-3">
				<h6 style="color:brown">الولايات</h6>
				</div>
				<div class="row col-12 mr-1 ml-1">
				@foreach ($states as $state)
				<a href="{{route('public.byState',$state->id)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
					<div class="col-12" style="display: inline-block;font-size:x-small">
						 {{count($ads->where('state_id',$state->id))}} {{$state->name}} 
					</div>
				</a>
				@endforeach
				</div>
			</div>
		</div>
	</div>	
@endsection
