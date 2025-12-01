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
                  <h4>Add Join Membership Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('joinmembership-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Join Membership Details</li>
                </ol>

                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Join Membership Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                               <form class="row g-3 needs-validation" novalidate 
                                        action="{{ isset($membership) ? route('joinmembership-details.update', $membership->id) : route('joinmembership-details.store') }}" 
                                        method="POST">
                                        @csrf
                                        @if(isset($membership))
                                            @method('PUT')
                                        @endif

                                        <div class="col-12">
                                            <label class="form-label" for="heading">Heading <span class="text-danger">*</span></label>
                                            <input type="text" name="heading" id="heading" class="form-control" 
                                                value="{{ $membership->heading ?? '' }}" placeholder="Enter heading" required>
                                            <div class="invalid-feedback">Please enter a heading.</div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter description" required>{{ $membership->description ?? '' }}</textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>

                                        <div class="col-12 text-end">
                                            <a href="{{ route('joinmembership-details.index') }}" class="btn btn-outline-danger px-4 me-2">Cancel</a>
                                            <button type="submit" class="btn btn-primary px-4">{{ isset($membership) ? 'Update' : 'Submit' }}</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
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

<script>
    function previewJoin MembershipImage() {
        const file = document.getElementById('Join Membership_image').files[0];
        const previewContainer = document.getElementById('Join MembershipImagePreviewContainer');
        const previewImage = document.getElementById('Join Membership_image_preview');

        // Clear the previous preview
        previewImage.src = '';
        
        if (file) {
            const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

            if (validImageTypes.includes(file.type)) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Display the image preview
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';  // Show the preview section
                };

                reader.readAsDataURL(file);
            } else {
                alert('Please upload a valid image file (jpg, jpeg, png, webp).');
            }
        }
    }
</script>
</body>

</html>