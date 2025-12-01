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
											<a href="{{ route('membership.details') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Membership Details</li>
									</ol>
								</nav>

								<!-- <a href="{{ route('membership.details') }}" class="btn btn-primary px-5 radius-30">+ Add Membership Details</a> -->
							</div>


                    <div class="table-responsive custom-scrollbar">
                    <table class="display table table-bordered" id="basic-1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Unique Code</th>
                                    <th>Name</th>
                                    <th>Grade</th>
                                    <th>Payment Type</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Employer</th>
                                    <th>Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                        <tbody>
                        @foreach($memberships as $index => $member)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $member->unique_code }}</td>
                                <td>{{ $member->first_name ?? '' }} {{ $member->last_name ?? '' }}</td>
                                <td>{{ $member->grade ?? '-' }}</td>
                                <td>{{ $member->payment_type ?? '-' }}</td>
                                <td>{{ $member->primary_email ?? '-' }}</td>
                                <td>{{ $member->phone_number ?? '-' }}</td>
                                <td>{{ $member->employer_name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $member->status == 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($member->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('membership.show', $member->id) }}" class="btn btn-sm btn-primary">View</a>
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