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
						<h6 style="margin: auto">{{$type==1?"المشرفين":($type==2?"المشغلين":"المتطوعين")}}</h6>
					</div>
					<hr>
					<div class="row">
						<h6 style="margin: auto">مرحبا بك {{auth()->user()->name}}</h6>
					</div>
					<a href="{{route('users.create')}}"
					class="login100-form-btn mb-2" style="font-family: Poppins-Regular;color:white !important;margin-top:5px">
						+ اضافة مستخدم</a>
					@if(count($users) > 0)
						@foreach ($users as $index => $user)
						<a href="#" onclick='sw({{$user->id}})'>
							
							<input type="hidden" name="name{{$user->id}}" id="name{{$user->id}}" value="{{$user->name}}">
							<input type="hidden" name="phone{{$user->id}}" id="phone{{$user->id}}" value="{{$user->email}}">
							<input type="hidden" name="admin{{$user->id}}" id="admin{{$user->id}}" value="{{$user->admin}}">
							<input type="hidden" name="bio{{$user->id}}" id="bio{{$user->id}}" value="{{$user->bio}}">
						<div class="card mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 @if($user->type==1)border-danger @else border-success @endif border-3 shadow" style="height: 70px">
							<div class="row mr-1 ml-1">
								
							<div class="col-9" style="display: inline-block">
								<h6 style="font-size: small;color:#333333 !important;margin-top:2px">
									{{$index+1}}. {{\Illuminate\Support\Str::limit($user->name, 50, $end='...')}}
									<br><span style="font-size: x-small;color:#1e7a16 !important">{{$user->bio}}</span><br>
									<span style="font-size: x-small;color:#333333 !important">{{\Illuminate\Support\Str::limit($user->created_at, 50, $end='...')}}</span>
								</h6>
								<h6 class="mt-1">
									<span style="font-size: x-small;color:#3b3c3d !important">{{\Illuminate\Support\Str::limit($user->email, 50, $end='...')}}</span>
								</h6>
								
							</div>
							<div class="col-3 text-center" style="display: inline-block;margin:auto;height:65">
								<h6 class="text-dark mt-4" style="margin: auto;font-size:x-small">التغطية </h6>
								<h6 class="text-dark" style="margin: auto;font-size:small">{{$user->admin==3?count($user->adsCompleted):count($user->adsDone)}}</h6>
							</div>
							</div>
						</div>
					</a>
						@endforeach	
						
					@else
						<h4 class="text-center">عذراً لا يوجد مستخدمين</h4>
					@endif
				</form>


			</div>
		</div>
	</div>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

	function sw(id){
		var name = document.getElementById('name'+id).value;
		var phone = document.getElementById('phone'+id).value;
		var admin = document.getElementById('admin'+id).value;
		var bio = document.getElementById('bio'+id).value;
		
		if(admin==1)
		admin = "مشرف"
		else if(admin==2)
		admin = "مشغل"
		else if(admin==3)
		admin = "متطوع"
		//swal(phone, address+" - "+details, msg);

		
		swal(name+" - "+bio+" - "+admin+" - "+phone, {
		buttons: {
			cancel: "اغلاق",
			catch: {
			text: "تعديل",
			value: "catch",
			},
			defeat: {
			text: "حذف",
			value: "defeat",
			}
		},
		})
		.then((value) => {
		switch (value) {
		
			case "defeat":
			window.location.replace("/users-delete/"+id);
			break;
		
			case "catch":
			window.location.replace("/users-edit/"+id+"");
			break;
		
			default:
			
		}
		});
	}

	function clos() {
		var details = document.getElementById('container');
		details.style.display = "none";
	}
</script>	
@endsection
