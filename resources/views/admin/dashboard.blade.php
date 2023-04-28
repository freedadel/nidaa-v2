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
					
				</div>
					<div class="row col-12 mr-1 ml-1">
						<h6 style="color:brown">المستخدمين</h6>
					</div>
					
					<div class="row col-12 mr-1 ml-1">
						@if(auth()->user()->email == "0921003398" || auth()->user()->email == "0923734194" || 
							auth()->user()->email == "0920996316" || auth()->user()->email == "0110012620" ||
							auth()->user()->email == "0925687117")
							<a href="{{route('admin.users',1)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
								<div class="col-12" style="display: inline-block">
									{{count($users->where('admin',1))}} مشرفين 
								</div>
							</a>
							@endif
						@if(auth()->user()->admin == 1)
						
						<a href="{{route('admin.users',2)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block">
								 {{count($users->where('admin',2)->where('user_id',auth()->user()->id))}} مشغلين 
							</div>
						</a>
						@endif
						<a href="{{route('admin.users',3)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block">
								 {{count($users->where('admin',3))}} متطوعين 
							</div>
						</a>
						@if(auth()->user()->email == "0921003398" || auth()->user()->email == "0923734194" || 
							auth()->user()->email == "0920996316" || auth()->user()->email == "0110012620" ||
							auth()->user()->email == "0925687117")
						<a href="{{route('volunteers')}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block">
								 {{count($volunteers)}} طلبات تطوع 
							</div>
						</a>

						<a href="{{route('admin.list',3)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block">
								 {{count($users->where('admin',2))}} احصائيات المشغلين 
							</div>
						</a>

						<a href="{{route('admin.list',3)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block">
								 {{count($users->where('admin',3))}} احصائيات المتطوعين 
							</div>
						</a>
						@endif
					</div>

					<div class="row col-12 mr-1 ml-1 mt-3">
						<h6 style="color:brown">حالة الحوجات </h6>
						</div>
					<div class="row col-12 mr-1 ml-1">
						
						<a href="{{route('needs',1)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-danger border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block;font-size:x-small">
								{{count($ads->where('status',1))}} جديدة
							</div>
						</a>

						<a href="{{route('needs',3)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-warning border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block;font-size:x-small">
								{{count($ads->where('status',3))}} في انتظار المتطوع
							</div>
						</a>

						<a href="{{route('needs',4)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block;font-size:x-small">
								{{count($ads->where('status',4))}} في انتظار التأكيد
							</div>
						</a>

						<a href="{{route('needs',2)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-success border-3 shadow" style="height: 30px">
							<div class="col-12" style="display: inline-block;font-size:x-small">
									{{count($ads->where('status',2))}} حوجات مكتملة
							</div>
						</a>
					</div>

				<div class="row col-12 mr-1 ml-1 mt-3">
				<h6 style="color:brown">الحوجة والوفرة</h6>
				</div>
				
				<div class="row col-12 mr-1 ml-1">
					<a href="#" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-danger border-3 shadow" style="height: 30px">
						<div class="col-12" style="display: inline-block">
							 {{count($ads->where('type',1))}} حوجة 
						</div>
					</a>
					<a href="#" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-success border-3 shadow" style="height: 30px">
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
					<a href="{{route('getAdsByHtype',$htype->id)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-warning border-3 shadow" style="height: 30px">
						<div class="col-12" style="display: inline-block;font-size:x-small">
							 {{count($ads->where('htype_id',$htype->id))}} {{$htype->name}} 
						</div>
					</a>
					@endforeach
					<a href="#" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-warning border-3 shadow" style="height: 30px">
						<div class="col-12" style="display: inline-block;font-size:x-small">
							 {{count($ads->where('htype_id',null))}} غير محدد 
						</div>
					</a>
				</div>

				<div class="row col-12 mr-1 ml-1 mt-3">
				<h6 style="color:brown">الولايات</h6>
				</div>
				<div class="row col-12 mr-1 ml-1">
				@foreach ($states as $state)
				<a href="{{route('getAdsByState',$state->id)}}" class="card col-6 mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 30px">
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
