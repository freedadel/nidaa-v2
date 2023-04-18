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
					<div class="row" style="text-align: center">
						<div class="col-6" style="margin:auto"><img src="{{asset('img/logo2.png')}}" alt="مقبول" style="width:100%"></div> 
					</div>
					<br>
					@if(count($weak) > 0 || count($medium) > 0 || count($strong) > 0)
						@foreach ($weak as $index => $weak)
						<div class="card mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-danger border-3 shadow" style="height: 70px">
							<div class="row mr-1 ml-1">
							<div class="col-9" style="display: inline-block">
								<h6>
									{{$index+1}}. <a href="#" onclick='about("{{$weak->name}}",
									"{!! $weak->about !!}","{{$weak->website}}",
									"{{$weak->img}}")'>{{\Illuminate\Support\Str::limit($weak->name, 50, $end='...')}}</a></a>
								</h6>
								<h6>
									<a href="#" onclick='about("{{$weak->university->name}}",
										"{!! $weak->university->about !!}","{{$weak->university->website}}",
										"{{$weak->university->img}}")' style="font-size: x-small;color:#3b3c3d !important">{{\Illuminate\Support\Str::limit($weak->university->name, 50, $end='...')}}</a>
								</h6>
							</div>
							<div class="col-3 text-center" style="display: inline-block;margin:auto;height:65">
								<h6 class="text-dark mt-4" style="margin: auto">{{$weak->percent}}</h6>
							</div>
							</div>
						</div>
						@endforeach	
						@foreach ($medium as $index2 => $medium)
						<div class="card mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-info border-3 shadow" style="height: 70px">
							<div class="row mr-1 ml-1">
							<div class="col-9" style="display: inline-block">
								<h6>
									{{($weak->count() > 0)?($index + $index2 + 2) : ($index2 + 1)}}. 
									<a href="#" onclick='about("{{$medium->name}}",
										"{!! $medium->about !!}","{{$medium->website}}",
										"{{$medium->img}}")'>{{\Illuminate\Support\Str::limit($medium->name, 50, $end='...')}}</a>
								</h6>
								<h6>
									<a href="#" onclick='about("{{$medium->university->name}}",
										"{!! $medium->university->about !!}","{{$medium->university->website}}",
										"{{$medium->university->img}}")' style="font-size: x-small;color:#3b3c3d !important">{{\Illuminate\Support\Str::limit($medium->university->name, 50, $end='...')}}</a>
								</h6>
							</div>
							<div class="col-3 text-center" style="display: inline-block;margin:auto;height:65">
								<h6 class="text-dark mt-4" style="margin: auto">{{$medium->percent}}</h6>
							</div>
							</div>
						</div>
						@endforeach	
						@foreach ($strong as $index3 => $strong)
						<div class="card mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-success border-3 shadow" style="height: 70px">
							<div class="row mr-1 ml-1">
							<div class="col-9" style="display: inline-block">
								<h6>
									{{($weak->count() > 0 && $medium->count() > 0)?$index + $index2 + $index3 + 3:($medium->count() > 0?$index2 + $index3 + 2:$index3 + 1)}}.
									<a href="#" onclick='about("{{$strong->name}}",
									"{!! $strong->about !!}","{{$strong->website}}",
									"{{$strong->img}}")'>{{\Illuminate\Support\Str::limit($strong->name, 50, $end='...')}}</a>
								</h6>
								<h6>
									<a href="#" onclick='about("{{$strong->university->name}}",
									"{!! $strong->university->about !!}","{{$strong->university->website}}",
									"{{$strong->university->img}}")' style="font-size: x-small;color:#3b3c3d !important">{{\Illuminate\Support\Str::limit($strong->university->name, 50, $end='...')}}</a>
								</h6>
							</div>
							<div class="col-3 text-center" style="display: inline-block;margin:auto;height:65">
								<h6 class="text-dark mt-4" style="margin: auto">{{$strong->percent}}</h6>
							</div>
							</div>
						</div>
						@endforeach
					@else
						<h4 class="text-center">عذراً لا يوجد نتائج</h4>
					@endif

				
					<div class="container-login100-form-btn">
					<button class="login100-form-btn" style="font-family: Poppins-Regular;">
						الرجوع للرئيسية
					</button>
					</div>
					
					<a href="https://docs.google.com/forms/d/e/1FAIpQLSeHjjYwn7QrI4ax9q19Fa_7QoHKIQ8utSDUOpUgh5IBLFVl0g/viewform?usp=sf_link"
					class="login100-form-btn" style="font-family: Poppins-Regular;color:white !important;margin-top:5px">
						اضافة تعليق
					</a>
					<a href="https://docs.google.com/forms/d/e/1FAIpQLScuLr-PvypFsMWRvsYcw1Kxi_TJG282fkjVbm3kN-3dx6pNVw/viewform?usp=sf_link"
					class="login100-form-btn" style="font-family: Poppins-Regular;color:white !important;margin-top:5px">
						اضافة معلومات عن كلية
					</a>
					<div class="card" id="container" style="width: 18rem;display:none">
					<img id="img" src="..." class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title" id="university">الاسم</h5>
						<p class="card-text" style="position: inherit;font-size:11px !important" id="data">حول </p>
						<a href="#" class="btn btn-warning" id="link" style="width: 100%;margin-top:10px">انتقل للموقع </a>
						
						<a href="#" onclick="clos()" class="btn btn-light" style="width: 100%;margin-top:10px">اغلاق</a>
					</div>
					</div>
				</form>


			</div>
		</div>
	</div>
<script>
	
	function about(name,newdata,url,newimg) {
	
    var details = document.getElementById('container');
	var university = document.getElementById('university');
	var data = document.getElementById('data');
	var link = document.getElementById('link');
	var img = document.getElementById('img');
		
		details.style.display = "block";
		university.innerText = name;
		data.innerHTML = newdata;
		data.style.fontSize = '11px !important';
		link.href = url;
			if(url === ""){
				link.style.display = "none";
			}else{
				link.style.display = "block";
			}
		img.src='img/universities/'+newimg;

	}

	function clos() {
		var details = document.getElementById('container');
		details.style.display = "none";
	}
</script>	
@endsection
