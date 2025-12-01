



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
											<a href="{{ route('direct_debit.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page"> Add Direct Debit Application</li>
									</ol>
								</nav>

								<!-- <a href="{{ route('membership.details') }}" class="btn btn-primary px-5 radius-30">+ Add Membership Details</a> -->
							</div>


<div class="container">
    <h3>Edit Direct Debit Application</h3>
    <hr>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('direct_debit.update', $application->id) }}" method="POST">
        @csrf

        {{-- Personal Details --}}
        <h4>Personal Details</h4>
        <hr>
        <div class="row mb-3">
            <div class="col-md-2"><label>Title <span class="text-danger">*</span></label></div>
            <div class="col-md-4">
                <select name="title" class="form-control" required>
                    <option value="">Select</option>
                    <option value="Mr" {{ $application->title=='Mr'?'selected':'' }}>Mr</option>
                    <option value="Mrs" {{ $application->title=='Mrs'?'selected':'' }}>Mrs</option>
                    <option value="Miss" {{ $application->title=='Miss'?'selected':'' }}>Miss</option>
                    <option value="Dr" {{ $application->title=='Dr'?'selected':'' }}>Dr</option>
                </select>
            </div>

            <div class="col-md-2"><label>First Name <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="first_name" class="form-control" value="{{ old('first_name', $application->first_name) }}" required></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2"><label>Surname <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="last_name" class="form-control" value="{{ old('last_name', $application->last_name) }}" required></div>

            <div class="col-md-2"><label>Mobile Number <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="mobile" class="form-control" value="{{ old('mobile', $application->mobile) }}" required></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2"><label>Email Address <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="email" name="email" class="form-control" value="{{ old('email', $application->email) }}" required></div>

            <div class="col-md-2"><label>Company?</label></div>
            <div class="col-md-4">
                <input type="checkbox" name="is_company" value="1" {{ $application->is_company?'checked':'' }}>
            </div>
        </div>

        {{-- Address --}}
        <h4>Address Details</h4>
        <hr>
        <div class="row mb-3">
            <div class="col-md-2"><label>Address Line 1 <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="address1" class="form-control" value="{{ old('address1', $application->address1) }}" required></div>

            <div class="col-md-2"><label>Address Line 2</label></div>
            <div class="col-md-4"><input type="text" name="address2" class="form-control" value="{{ old('address2', $application->address2) }}"></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2"><label>Town / City <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="town" class="form-control" value="{{ old('town', $application->town) }}" required></div>

            <div class="col-md-2"><label>PostCode <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="postcode" class="form-control" value="{{ old('postcode', $application->postcode) }}" required></div>
        </div>

        {{-- Bank Account Details --}}
        <h4>Bank Account Details</h4>
        <hr>
        <div class="row mb-3">
            <div class="col-md-2"><label>Account Name <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="account_name" class="form-control" value="{{ old('account_name', $application->account_name) }}" required></div>

            <div class="col-md-2"><label>Account Number <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="account_number" class="form-control" value="{{ old('account_number', $application->account_no) }}" required maxlength="10"></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2"><label>Sort Code <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="sort_code" class="form-control" value="{{ old('sort_code', $application->sort_code) }}" required maxlength="6"></div>

            <div class="col-md-2"><label>Bank</label></div>
            <div class="col-md-4"><input type="text" name="bank" class="form-control" value="{{ old('bank', $application->bank) }}"></div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('direct_debit.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
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
