
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

								<a href="{{ route('membership.details') }}" class="btn btn-primary px-5 radius-30">+ Add Membership Details</a>
							</div>

                            <div class="container mt-4">
                                <h3 class="mb-4 text-primary">Membership Record</h3>

                                {{-- MEMBERSHIP INFO --}}
                                <div class="card mb-4">
                                    <div class="card-header bg-dark text-white">Membership Info</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4"><strong>ID:</strong> {{ $member->id }}</div>
                                            <div class="col-md-4"><strong>Unique Code:</strong> {{ $member->unique_code }}</div>
                                            <div class="col-md-4">
                                                <strong>Status:</strong>
                                                <span class="badge bg-{{ $member->status == 'completed' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($member->status) }}
                                                </span>
                                            </div>
                                            <div class="col-md-4"><strong>Created At:</strong> {{ $member->created_at }}</div>
                                            <div class="col-md-4"><strong>Updated At:</strong> {{ $member->updated_at }}</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- MEMBERSHIP TYPE --}}
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">Membership Type</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6"><strong>Grade:</strong> {{ $member->grade }}</div>
                                            <div class="col-md-6"><strong>Payment Type:</strong> {{ $member->payment_type }}</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- PERSONAL DETAILS --}}
                                <div class="card mb-4">
                                    <div class="card-header bg-info text-white">Personal Details</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4"><strong>Title:</strong> {{ $member->title }}</div>
                                            <div class="col-md-4"><strong>First Name:</strong> {{ $member->first_name }}</div>
                                            <div class="col-md-4"><strong>Middle Name:</strong> {{ $member->middle_name }}</div>
                                            <div class="col-md-4"><strong>Last Name:</strong> {{ $member->last_name }}</div>
                                            <div class="col-md-4"><strong>Gender:</strong> {{ $member->gender }}</div>
                                            <div class="col-md-4"><strong>Birth Date:</strong> {{ $member->birth_date }}</div>
                                            <div class="col-md-6"><strong>Primary Email:</strong> {{ $member->primary_email }}</div>
                                            <div class="col-md-6"><strong>Backup Email:</strong> {{ $member->backup_email }}</div>
                                            <div class="col-md-4"><strong>Phone Number:</strong> {{ $member->phone_number }}</div>
                                            <div class="col-md-4"><strong>Alternative Phone:</strong> {{ $member->alt_phone_number }}</div>
                                            <div class="col-md-12"><strong>Street Address 1:</strong> {{ $member->street_address }}</div>
                                            <div class="col-md-12"><strong>Street Address 2:</strong> {{ $member->street_address2 }}</div>
                                            <div class="col-md-12"><strong>Street Address 3:</strong> {{ $member->street_address3 }}</div>
                                            <div class="col-md-6"><strong>City:</strong> {{ $member->city }}</div>
                                            <div class="col-md-6"><strong>Postal Code:</strong> {{ $member->postal_code }}</div>
                                            <div class="col-md-6"><strong>Receive Benefit Emails:</strong> {{ $member->receive_benefit_emails }}</div>
                                            <div class="col-md-12"><strong>Join Reason:</strong> {{ $member->join_reason }}</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- PROFESSIONAL DETAILS --}}
                                <div class="card mb-4">
                                    <div class="card-header bg-secondary text-white">Professional Details</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4"><strong>GMC/GDC Number:</strong> {{ $member->gmc_gdc_number }}</div>
                                            <div class="col-md-4"><strong>Specialty:</strong> {{ $member->specialty }}</div>
                                            <div class="col-md-12"><strong>Qualifications:</strong> {{ $member->qualifications }}</div>
                                            <div class="col-md-4"><strong>LNC Member:</strong> {{ $member->lnc_member ? 'Yes' : 'No' }}</div>
                                            <div class="col-md-4"><strong>LNC Chair:</strong> {{ $member->lnc_chair ? 'Yes' : 'No' }}</div>
                                            <div class="col-md-6"><strong>Employer Name:</strong> {{ $member->employer_name }}</div>
                                            <div class="col-md-6"><strong>Employer Other:</strong> {{ $member->employer_other }}</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- WORKPLACE DETAILS --}}
                                <div class="card mb-4">
                                    <div class="card-header bg-warning text-white">Workplace Details</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6"><strong>Hospital Name:</strong> {{ $member->hospital_name }}</div>
                                            <div class="col-md-6"><strong>Workplace Other:</strong> {{ $member->workplace_other }}</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- BANK DETAILS --}}
                                <div class="card mb-4">
                                    <div class="card-header bg-success text-white">Bank Details</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4"><strong>Is Account Holder:</strong> {{ $member->is_account_holder }}</div>
                                            <div class="col-md-4"><strong>Is Sole Authoriser:</strong> {{ $member->is_sole_authoriser }}</div>
                                            <div class="col-md-4"><strong>Bank Name:</strong> {{ $member->bank_name }}</div>
                                            <div class="col-md-4"><strong>Account Holder Name:</strong> {{ $member->account_holder_name }}</div>
                                            <div class="col-md-4"><strong>Sort Code:</strong> {{ $member->sort_code }}</div>
                                            <div class="col-md-4"><strong>Account Number:</strong> {{ $member->account_number }}</div>
                                            <div class="col-md-4"><strong>Annual Amount:</strong> £{{ number_format($member->annual_amount, 2) }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <a href="{{ route('membership.details') }}" class="btn btn-secondary">Back</a>
                                </div>
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

