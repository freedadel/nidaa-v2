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
                  <h6 class="m-0 font-weight-bold text-primary">Add Faculty</h6>
                </div>
                <div class="card-body">
                  <form class="user" method="POST" action="{{ route('Faculties.store') }}" enctype = "multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name in arabic...">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                      <select type="text" class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                        <option value="">اختر التصنيف</option>
                        @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <select type="text" class="form-control @error('university_id') is-invalid @enderror" id="university_id" name="university_id">
                        <option value="">اختر الجامعة</option>
                        @foreach($universities as $university)
                          <option value="{{$university->id}}">{{$university->name}}</option>
                        @endforeach
                      </select>
                        @error('university_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user @error('percent') is-invalid @enderror" id="percent" name="percent" placeholder="Percent %">
                        @error('percent')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <select type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location">
                        <option value="">اختر الولاية</option>
                        @foreach($states as $state)
                          <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                      </select>
                        @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user @error('website') is-invalid @enderror" id="website" name="website" placeholder="website link">
                        @error('website')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                      <label for="img" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>
                      <input style="padding:5px" id="img" type="file" class=" col-md-8 form-control form-control-user @error('img') is-invalid @enderror" name="img" value="{{ old('img') }}">
                      @error('img')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    </div>
                    <div class="col-lg-6">
                    <textarea name="about" id="editor"  placeholder="About" ></textarea>
                    <br>
                     <div class="form-group">
                        @foreach($departments as $department)
                        <input type="checkbox" id="department_id" name="{{'chk'.$department->id}}" value="{{$department->id}}">
                        <label for="department_id">{{$department->name}}</label><br>
                        @endforeach
               
                        @error('department_id')
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
      <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
      <script>
              ClassicEditor
                      .create( document.querySelector( '#editor' ) )
                      .then( editor => {
                              console.log( editor );
                              
                      } )
                      .catch( error => {
                              console.error( error );
                      } );
              ClassicEditor.config.height = 500;  
      </script>

      <style>
        .ck{
          height: 80px;
        }
      </style>
@endsection
