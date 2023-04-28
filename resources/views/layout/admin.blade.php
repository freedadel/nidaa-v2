<!DOCTYPE html>
<html lang="en">
<head>
	<title>نداء</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    
    <link rel="apple-touch-icon" sizes="57x57" href="fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="fav/favicon-16x16.png">
    <link rel="manifest" href="fav/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="fav/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <script data-ad-client="ca-pub-6582335294052464" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6582335294052464"
     crossorigin="anonymous"></script>
     <style>
        .swal-text{
            text-align: right !important;
            direction: rtl !important;
        }
     </style>
<!--===============================================================================================-->
</head>
<body style="direction: rtl">
	@yield('content')
    <div class="row col-12" style="margin: auto;text-align:center;background-color:#1f2832">
        <a href="{{url()->previous()}}" class="col-2 btn btn-warning" style="margin: auto">رجوع</a>
        <a href="{{route('users.myedit')}}" class="col-3 btn btn-warning" style="margin: auto">بياناتي</a>
        <a href="{{route('admin.index')}}" class="col-3 btn btn-warning" style="margin: auto">الرئيسية</a>
        <a href="#" class="col-2 btn btn-warning" style="margin: auto" data-toggle="modal" data-target="#logoutModal">خروج</a>
    </div>

     <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">تأكيد الخروج</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">هل تريد الخروج فعلاً؟</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">لا</button>
          <a class="btn btn-danger" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">نعم، خروج</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<!--===============================================================================================-->	
	<script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('js/main.js')}}"></script>
	   <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.css')}}">
        <script type="text/javascript" charset="utf8" src="{{asset('css/jquery.dataTables.js')}}"></script>
        <script src="{{asset('css/dataTables.buttons.min.js')}}" ></script>
        <script src="{{asset('css/jszip.min.js')}}" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" ></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js" ></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js" ></script>
    <script>
        $(document).ready( function () {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'print'
                ]
            });
            $('#example2').DataTable({
                dom: 'Bfrtip',
                paging: false,
                bFilter: false,
                ordering: false,
                searching: false,
				bInfo: false,
                buttons: [
                {
                //extend: 'print',
                //title: '',
                //text: 'طباعة',
				customize: function(doc) {
				doc.defaultStyle.fontSize = 16; //<-- set fontsize to 16 instead of 10 
			} 
            }
                ]
            });
            $('#table').DataTable();
        } );
    </script>
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<input type="hidden" id="success" value="{{session('success')}}">
<script>
    $msg = document.getElementById('success').value;
    if($msg != ''){
        swal("نجاح", $msg, "success");
    }
</script>


</html>