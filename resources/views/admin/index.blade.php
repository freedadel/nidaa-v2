@extends('layout.masterPage_dashboard')


@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Needs Page</h1>
          <p class="mb-4">
            
          </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Type</th>
                      <th>State</th>
                      <th>Locality</th>
                      <th>Area</th>
                      <th>Details</th>
                      <th>Created At</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Type</th>
                      <th>State</th>
                      <th>Locality</th>
                      <th>Area</th>
                      <th>Details</th>
                      <th>Created At</th>
                      <th>Status</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @if ($ads->count() > 0)
                    @foreach ($ads as $index => $ad)
                    <tr>
                      <td>{{ $index +1 }}</td>
                      <td>{{ !empty($ad->htype_id)?$ad->htype->name:"غير محدد" }}</td>
                      <td>{{ !empty($ad->state_id)?$ad->state->name:"غير محدد" }}</td>
                      <td>{{ !empty($ad->locality_id)?$ad->locality->name:"غير محدد" }}</td>
                      <td>{{$ad->area}}</td>
                      <td>{{$ad->details}}</td>
                      <td>{{$ad->created_at->format('d-m-Y')}}</td>
                      <td>{{$ad->status == 1?"قيد الانتظار":($ad->status==2?"مكتملة":"قيد الاجراء")}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr >
                        <th colspan="6" class="text-center">No data</th>
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script>
  $(document).ready(function() {
      $('#dataTable').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'excel'
          ]
      } );
  } );
  </script>