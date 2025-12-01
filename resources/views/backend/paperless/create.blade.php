
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
    <hr>

    {{-- Display Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('direct_debit.store') }}" method="POST">
        @csrf

        {{-- Personal Details --}}
        <h4>Personal Details</h4>
        <hr>
        <div class="row mb-3">
            <div class="col-md-2"><label for="title">Title <span class="text-danger">*</span></label></div>
            <div class="col-md-4">
                <select name="title" class="form-control" required>
                    <option value="">Select</option>
                    <option value="Mr" {{ old('title')=='Mr'?'selected':'' }}>Mr</option>
                    <option value="Mrs" {{ old('title')=='Mrs'?'selected':'' }}>Mrs</option>
                    <option value="Miss" {{ old('title')=='Miss'?'selected':'' }}>Miss</option>
                    <option value="Dr" {{ old('title')=='Dr'?'selected':'' }}>Dr</option>
                </select>
            </div>

            <div class="col-md-2"><label for="first_name">First Name <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2"><label for="last_name">Surname <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required></div>

            <div class="col-md-2"><label for="mobile">Mobile Number <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" required></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2"><label for="email">Email Address <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="email" name="email" class="form-control" value="{{ old('email') }}" required></div>

            <div class="col-md-2"><label for="is_company">Company?</label></div>
            <div class="col-md-4"><input type="checkbox" name="is_company" value="1" {{ old('is_company')?'checked':'' }}></div>
        </div>

        {{-- Address Details --}}
        <h4>Address Details</h4>
        <hr>
        <div class="row mb-3">
            <div class="col-md-2"><label for="address1">Address Line 1 <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="address1" class="form-control" value="{{ old('address1') }}" required></div>

            <div class="col-md-2"><label for="address2">Address Line 2</label></div>
            <div class="col-md-4"><input type="text" name="address2" class="form-control" value="{{ old('address2') }}"></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2"><label for="town">Town / City <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="town" class="form-control" value="{{ old('town') }}" required></div>

            <div class="col-md-2"><label for="postcode">PostCode <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="postcode" class="form-control" value="{{ old('postcode') }}" required></div>
        </div>

        {{-- Bank Account Details --}}
        <h4>Bank Account Details</h4>
        <hr>
        <div class="row mb-3">
            <div class="col-md-2"><label for="account_name">Account Name <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="account_name" class="form-control" value="{{ old('account_name') }}" required></div>

            <div class="col-md-2"><label for="account_number">Account Number <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="account_number" class="form-control" value="{{ old('account_number') }}" required maxlength="10"></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2"><label for="sort_code">Sort Code <span class="text-danger">*</span></label></div>
            <div class="col-md-4"><input type="text" name="sort_code" class="form-control" value="{{ old('sort_code') }}" required maxlength="6"></div>

            <div class="col-md-2"><label for="bank">Bank</label></div>
            <div class="col-md-4"><input type="text" name="bank" class="form-control" value="{{ old('bank') }}"></div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
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
