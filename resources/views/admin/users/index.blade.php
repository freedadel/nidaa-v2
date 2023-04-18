@extends('layout.masterPage_dashboard')


@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Users</h1>
          <p class="mb-4">
            here you can manage users
          </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
              <a href="{{ route('users.create') }}" class="btn btn-success" style="float: right">Add user <i class="fa fa-plus"></i></a>
            </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User</th>
                      <th>Email</th>
                      <th>Image</th>
                      <th>Created on</th>
                      <th>Add By</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>User</th>
                      <th>Email</th>
                      <th>Image</th>
                      <th>Created at</th>
                      <th>Add By</th>
                      <th>Edit</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @if ($users->count() > 0)
                    @foreach ($users as $index => $user)
                    <tr>
                      <td>{{ $index +1 }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td><img src="{{asset('img\Profile\\'.$user->img)}}" height="30px" width="30px" /></td>
                      <td>{{$user->created_at}}</td>
                      @if($user->user_id != 0)
                      <td>{{$user->user_id}}</td>
                      @else 
                      <td>Admin</td>
                      @endif
                      <td>
                          <button class="btn btn-primary" onclick="handleReset({{ $user->id }})"><span class="fa fa-refresh"></span> Reset </button>
                          <button class="btn btn-danger" onclick="handleDelete({{ $user->id }})"><span class="fa fa-trash"></span> Delete </button>
                          @if($user->admin == 1)
                          <button class="btn btn-warning" onclick="handleUnpublish({{ $user->id }})"><span class="fa fa-minus-circle"></span> Make user </button>
                          @else 
                          <button class="btn btn-success" onclick="handlePublish({{ $user->id }})"><span class="fa fa-caret-square-o-right"></span> Make Admin </button>
                          @endif
                                  </td>
                    </tr>
                    @endforeach
                    @else
                    <tr >
                        <th colspan="6" class="text-center">No Users</th>
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
          <h5 class="modal-title text-center" id="exampleModalLabel">Delete Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:right">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="deleteCategoryForm">
          @csrf
          @method('DELETE')
          <div class="modal-body">
            <p class="text-center">
              Are you sure?
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
<!-- Delete Modal -->
<div class="modal fade" id="resetModel" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">Reset Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="resetCategoryForm">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <h5 class="text-center">
              Are you sure you want to reset password?
            </h5>
            <input type="hidden" name="prod_id" id="product_id" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
            <button type="submit" class="btn btn-info">Yes, Reset</button>
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
          <h5 class="modal-title text-center" id="exampleModalLabel">Admin Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:right">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="unpublishCategoryForm">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <h5 class="text-center">
             Are you sure?
            </h5>
            <input type="hidden" name="prod_id" id="product_id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger" style="float:right">Yes, Make User</button>
            <button type="button" class="btn btn-info" data-dismiss="modal" style="float:right">No, Cancel</button>
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
        <h5 class="modal-title text-center" id="exampleModalLabel">Admin Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:right">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" id="publishCategoryForm">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <h5 class="text-center">
            Are you sure?
          </h5>
          <input type="hidden" name="prod_id" id="product_id" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" style="float:right">Yes, Make Admin</button>
          <button type="button" class="btn btn-info" data-dismiss="modal" style="float:right">No, Cancel</button>
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
       form.action = '/users/' + id
       $('#deleteModel').modal('show')
    }
  
    function handleUnpublish(id) {
        //console.log('star.', id)
       var form = document.getElementById('unpublishCategoryForm')
      // form.action = '/user/delete/' + id
       form.action = '/users/makeUser/' + id
       $('#unpublishModel').modal('show')
    }
    function handlePublish(id) {
        //console.log('star.', id)
       var form = document.getElementById('publishCategoryForm')
      // form.action = '/user/delete/' + id
       form.action = '/users/makeAdmin/' + id
       $('#publishModel').modal('show')
    }
    function handleReset(id) {
        //console.log('star.', id)
      var form = document.getElementById('resetCategoryForm')
      // form.action = '/user/delete/' + id
      form.action = '/users/reset-password/' + id
      $('#resetModel').modal('show')
    }
  </script>
  
  
