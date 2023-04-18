@extends('layout.masterPage_dashboard')


@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">State Page</h1>
          <p class="mb-4">
            here you can view and change state data
          </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
              <a href="{{ route('States.create') }}" class="btn btn-success" style="float: right">Add state <i class="fa fa-plus"></i></a>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Add By</th>
                      <th>Published date</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Add By</th>
                      <th>Published date</th>
                      <th>Edit</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @if ($states->count() > 0)
                    @foreach ($states as $index => $state)
                    <tr>
                      <td>{{ $index +1 }}</td>
                      <td>{{ $state->name }}</td>
                      <td>{{$state->user->name}}</td>
                      <td>{{$state->created_at}}</td>
                      <td>
                          <span>
                              <a href="{{ route('States.edit', $state->id) }}" class="btn btn-info">Edit <i class="fa fa-edit"></i></a>
                          </span>
                          <button class="btn btn-danger" onclick="handleDelete({{ $state->id }})"><span class="fa fa-trash"></span> Delete </button>
                          @if($state->status == 1)
                          <button class="btn btn-warning" onclick="handleUnpublish({{ $state->id }})"><span class="fa fa-minus-circle"></span> Unpublish </button>
                          @else 
                          <button class="btn btn-success" onclick="handlePublish({{ $state->id }})"><span class="fa fa-caret-square-o-right"></span> Publish </button>
                          @endif
                                  </td>
                    </tr>
                    @endforeach
                    @else
                    <tr >
                        <th colspan="6" class="text-center">No state</th>
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
@endsection


  <script>
  
    function handleDelete(id) {
        //console.log('star.', id)
       var form = document.getElementById('deleteCategoryForm')
      // form.action = '/user/delete/' + id
       form.action = '/States/' + id
       $('#deleteModel').modal('show')
    }
  
    function handleUnpublish(id) {
        //console.log('star.', id)
       var form = document.getElementById('unpublishCategoryForm')
      // form.action = '/user/delete/' + id
       form.action = '/States/unpublish/' + id
       $('#unpublishModel').modal('show')
    }
    function handlePublish(id) {
        //console.log('star.', id)
       var form = document.getElementById('publishCategoryForm')
      // form.action = '/user/delete/' + id
       form.action = '/States/publish/' + id
       $('#publishModel').modal('show')
    }
  
  </script>
  
  
