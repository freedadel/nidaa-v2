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
.wrap-login100{
height: 570px !important;
overflow-y: scroll !important;
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
				</div>
				<form class="login100-form validate-form" action="/">
					
					
					<br>
					<div class="row">
						<h6 style="margin: auto">سجل العمليات</h6>
					</div>
				
					@if(count($transactions) > 0)
						@foreach ($transactions as $index => $transaction)
						<a href="#">
							
						<div class="card mt-1 border-left-0 border-top-0 border-bottom-0 rounded-right-0 border-danger border-3 shadow" style="height: 40px">
							<div class="row mr-1 ml-1">
								
							<div class="col-12" style="display: inline-block">
								<h6 class="mt-1">
									<span style="font-size: x-small;color:#3b3c3d !important">{{\Illuminate\Support\Str::limit($transaction->details, 150, $end='...')}}</span>
								</h6>
								
							</div>
							</div>
						</div>
					</a>
						@endforeach	
						
					@else
						<h4 class="text-center">عذراً لا يوجد عمليات</h4>
					@endif
				</form>


			</div>
		</div>
	</div>
	@endsection