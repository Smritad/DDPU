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
											<a href="{{ route('whychoose-details.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Why choose Details</li>
									</ol>
								</nav>

								<a href="{{ route('whychoose-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Why choose Details</a>
							</div>


                    <div class="table-responsive custom-scrollbar">
<table class="display" id="basic-1">    <thead>
        <tr>
            <th>#</th>
            <th>Main Heading</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($whychooses as $index => $whychoose)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $whychoose->main_heading }}</td>
            <td>
                <!-- Edit Button -->
                <a href="{{ route('whychoose-details.edit', $whychoose->id) }}" 
                   class="btn btn-sm btn-primary">
                   <i class="bi bi-pencil"></i> Edit
                </a>

                <!-- Delete Button -->
                <form action="{{ route('whychoose-details.destroy', $whychoose->id) }}" method="POST" style="display:inline-block;" 
                      onsubmit="return confirm('Are you sure you want to delete this item?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">
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
            <!-- footer start-->
             @include('components.backend.footer')
      </div>
    </div>

        @include('components.backend.main-js')

</body>

</html>