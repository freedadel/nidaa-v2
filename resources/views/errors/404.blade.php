@extends('layout.app')

@section('content')
    	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('img/flag.jpg')}}" alt="IMG">
				</div>
				<form class="login100-form validate-form" action="/">
					<div class="row" style="text-align: center">
						<div class="col-6" style="margin:auto"><img src="{{asset('img/logo2.png')}}" alt="مقبول" style="width:100%"></div> 
					</div>
					<br>
					<span class="login100-form-title" style="font-size: 0.8em">
						حوجة
					</span>
				<table class="table table-striped table-bordered table-hover" id="example2" style="font-size: small">
					<thead>
						<tr style="background-color: lightblue">
						<h3 style="text-align: center">الصفحة غير موجودة</h3>
						</tr>
					</thead>
					</table>
					<div class="container-login100-form-btn">
					<button class="login100-form-btn" style="font-family: Poppins-Regular;">
						الرجوع للرئيسية
					</button>
					</div>
				</form>
				

			</div>
		</div>
	</div>
@endsection
 