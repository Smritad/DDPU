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
                  <h4>Edit Join Membership Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('joinmembership-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Join Membership Details</li>
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
                                            action="{{ route('joinmembership-details.update', $membership->id) }}" 
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <!-- Heading -->
                                            <div class="col-12">
                                                <label class="form-label" for="heading">Heading <span class="text-danger">*</span></label>
                                                <input type="text" name="heading" id="heading" class="form-control" 
                                                    value="{{ old('heading', $membership->heading) }}" placeholder="Enter heading" required>
                                                <div class="invalid-feedback">Please enter a heading.</div>
                                            </div>

                                            <!-- Description -->
                                            <div class="col-12">
                                                <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                                                <textarea name="description" id="description" class="form-control" rows="4" 
                                                        placeholder="Enter description" required>{{ old('description', $membership->description) }}</textarea>
                                                <div class="invalid-feedback">Please enter a description.</div>
                                            </div>

                                            <!-- Form Actions -->
                                            <div class="col-12 text-end">
                                                <a href="{{ route('joinmembership-details.index') }}" class="btn btn-outline-danger px-4 me-2">Cancel</a>
                                                <button type="submit" class="btn btn-primary px-4">Update</button>
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
    const existingImageContainer = document.getElementById('existingJoin MembershipImageContainer');

    // Clear the previous preview
    previewImage.src = '';
    previewContainer.style.display = 'none';

    if (file) {
        const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

        if (validImageTypes.includes(file.type)) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // Hide existing image container if present
                if (existingImageContainer) {
                    existingImageContainer.style.display = 'none';
                }

                // Display the new preview
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
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