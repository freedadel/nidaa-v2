@extends('layout.masterPage_dashboard')


@section('content')
 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <div class="row">

            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
                </div>
                <div class="card-body">
                   @if ($category->count() > 0)
                   @foreach ($category as $category)
                  <form class="user" method="POST" action="{{ route('Categories.update', $category->id) }}" enctype = "multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name" value="{{$category->name}}" placeholder="Name in arabic...">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <input type="submit" class="btn btn-success" value="Save">
                    </div>
                  </div>
                  </form>
                  @endforeach
                  @endif
                </div>
              </div>

            </div>
            
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

@endsection
