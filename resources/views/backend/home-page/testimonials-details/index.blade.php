<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>
	   
		@include('components.backend.header')

	    <!--start sidebar wrapper-->	
	    @include('components.backend.sidebar')
	   <!--end sidebar wrapper-->

    
     <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb mb-0">
										<li class="breadcrumb-item">
											<a href="{{ route('testimonials-details.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Testimonials Details</li>
									</ol>
								</nav>

								<a href="{{ route('testimonials-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Testimonials Details</a>
							</div>


                    <div class="table-responsive custom-scrollbar">
                    
    <table class="display table table-striped" id="basic-1">
        <thead>
            <tr>
                <th>#</th>
                <th>Main Heading</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $index => $testimonial)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $testimonial->main_heading }}</td>
                <td>
                    <a href="{{ route('testimonials-details.edit', $testimonial->id) }}" class="btn btn-sm btn-primary mb-1">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    <form action="{{ route('testimonials-details.destroy', $testimonial->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>






                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
            <!-- footer start-->
             @include('components.backend.footer')
      </div>
    </div>

        @include('components.backend.main-js')

</body>

</html>