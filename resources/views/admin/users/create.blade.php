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
                  <h6 class="m-0 font-weight-bold text-primary">Add user</h6>
                </div>
                <div class="card-body">
                  <form class="user" method="POST" action="{{ route('users.store') }}" enctype = "multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Password confirmation">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                   
                    <div class="form-group row">
                      <label for="img" class="col-md-4 col-form-label text-md-right">{{ __('User image') }}</label>
                      <input style="padding:5px" id="img" type="file" class="col-md-6 form-control form-control-user @error('img') is-invalid @enderror" name="img" value="{{ old('img') }}">
                      @error('img')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    

                    <input type="submit" class="btn btn-success" value="Save">
                    </div>
                  </div>
                  </form>
                </div>
              </div>

            </div>
            
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
@endsection
