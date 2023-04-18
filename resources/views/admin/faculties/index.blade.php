@extends('layout.masterPage_dashboard')

<style>
  .table td, .table th{
    padding: 0px !important;
  }
</style>
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Faculty Page</h1>
          <form class="row" action="{{route('getByUniversity')}}" method="POST" style="margin:auto;padding-top:10px">
            @csrf 
            <div class="col-md-1" style="text-align:right;display:inline-block">
              <label class="form-control-label" for="from">اختر الجامعة</label>
            </div>
            <div class="col-md-2" style="display:inline-block">
              <select class="form-control @error('university_id') is-invalid @enderror" id="university_id" name="university_id" required>
                <option value="">اختر الجامعة</option>
                @foreach ($universities as $university)
                  <option value="{{$university->id}}" @if(session('university_id')==$university->id) selected @endif>{{$university->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-1" style="display:inline-block">
              <button type="submit" class="form-control btn btn-danger" style="margin: auto">بحث</button>
            </div>
          </form>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
              <a href="{{ route('Faculties.create') }}" class="btn btn-success" style="float: right">Add faculty <i class="fa fa-plus"></i></a>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Percent</th>
                      <th>University</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Percent</th>
                      <th>University</th>
                      <th>Updated at</th>
                      <th>Edit</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @if ($faculties->count() > 0)
                    @foreach ($faculties as $index => $faculty)
                    
                    <tr>
                      <td>{{$index +1}}</td>
                      <td>{{\Illuminate\Support\Str::limit($faculty->name, 60, $end='...')}}</td>
                      <td>
                        <form action="{{route('facultyUpdate',$faculty->id)}}" method="POST">
                        @csrf
                        <input type="number" step="0.1" name="percent" value="{{$faculty->percent}}" style="display: inline-block">
                        <button type="submit" class="btn btn-success" style="display: inline-block"><i class="fa fa-paper-plane"></i></button>
                        </form>
                      </td>
                      <td>{{$faculty->university->name}}</td>
                      <td>{{$faculty->updated_at->format('Y-m-d')}}</td>
                      <td>
                          <span>
                              <a href="{{ route('Faculties.edit', $faculty->id) }}" class="btn btn-info"> <i class="fa fa-edit"></i></a>
                          </span>
                          <button class="btn btn-danger" onclick="handleDelete({{ $faculty->id }})"><span class="fa fa-trash"></span> </button>
                          @if($faculty->status == 1)
                          <button class="btn btn-warning" onclick="handleUnpublish({{ $faculty->id }})"><span class="fa fa-minus-circle"></span>  </button>
                          @else 
                          <button class="btn btn-success" onclick="handlePublish({{ $faculty->id }})"><span class="fa fa-caret-square-o-right"></span>  </button>
                          @endif
                          <button class="btn btn-success" onclick="handlePercent({{ $faculty->id }})"><span class="fa fa-comment"></span> النسبة </button>
                          
                                  </td>
                    </tr>
                    
                    @endforeach
                    @else
                    <tr >
                        <th colspan="6" class="text-center">No faculty</th>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <!-- Delete Modal -->
<div class="modal fade modal" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">Confirm the deletion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:right">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="deleteCategoryForm">
          @csrf
          @method('DELETE')
          <div class="modal-body">
            <p class="text-center">
              Do you really want to delete?
            </p>
            <input type="hidden" name="prod_id" id="product_id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger" style="float:right">Yes, delete</button>
            <button type="button" class="btn btn-success" data-dismiss="modal" style="float:right">No, cancel</button>
          </div>
        </form>
  
      </div>
    </div>
  </div>

  <!-- UnPublish Modal -->
  <div class="modal fade" id="unpublishModel" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">Unpublish confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:right">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="unpublishCategoryForm">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <h5 class="text-center">
              Do you really want to unpublish?
            </h5>
            <input type="hidden" name="prod_id" id="product_id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger" style="float:right">Yes, unpublish?</button>
            <button type="button" class="btn btn-info" data-dismiss="modal" style="float:right">No, cancel</button>
          </div>
        </form>

      </div>
    </div>
  </div>

<!-- Publish Modal -->
<div class="modal fade" id="publishModel" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Publish confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:right">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" id="publishCategoryForm">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <h5 class="text-center">
            Do you really want to publish?
          </h5>
          <input type="hidden" name="prod_id" id="product_id" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" style="float:right">Yes, publish</button>
          <button type="button" class="btn btn-info" data-dismiss="modal" style="float:right">No, cancel</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- Comment Modal -->
      <div class="modal fade modal" id="commentModel" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-center" id="exampleModalLabel">اضافة ملاحظة</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="POST" id="commentCategoryForm">
              @csrf
              @method('PUT')
              <div class="modal-body">
                <p class="text-center">
                  اكتب النسبة
                </p>
                <input type="text" class="form-control" name="percent" id="percent">
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success" style="float:right">نعم, حفظ</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right">لا, الغاء</button>
              </div>
            </form>
      
          </div>
        </div>
      </div>
    <!-- Comment Modal -->
@endsection


  <script>
  
    function handleDelete(id) {
        //console.log('star.', id)
       var form = document.getElementById('deleteCategoryForm')
      // form.action = '/user/delete/' + id
       form.action = '/Faculties/' + id
       $('#deleteModel').modal('show')
    }
  
    function handleUnpublish(id) {
        //console.log('star.', id)
       var form = document.getElementById('unpublishCategoryForm')
      // form.action = '/user/delete/' + id
       form.action = '/Faculties/unpublish/' + id
       $('#unpublishModel').modal('show')
    }
    function handlePublish(id) {
        //console.log('star.', id)
       var form = document.getElementById('publishCategoryForm')
      // form.action = '/user/delete/' + id
       form.action = '/Faculties/publish/' + id
       $('#publishModel').modal('show')
    }
  function handlePercent(id) {
        //console.log('star.', id)
       var form = document.getElementById('commentCategoryForm')
      // form.action = '/user/comment/' + id
       form.action = '/faculity/percent/' + id
       $('#commentModel').modal('show')
    }
  </script>
  
  
