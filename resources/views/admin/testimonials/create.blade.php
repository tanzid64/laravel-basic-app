@extends('admin.base') 
@section('admin')
<div class="content">
    <!-- Start Content-->
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Add Testimonial</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('all.testimonials') }}">Testimonials</a>
                    </li>
                    <li class="breadcrumb-item active">Add Testimonial</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div
                            class="tab-pane pt-4"
                            id="profile_setting"
                            role="tabpanel"
                        >
                            <div class="row">
                                <div class="">
                                    <div class="card border mb-0">
                                        <div class="card-header">
                                            <div
                                                class="row align-items-center"
                                            >
                                                <div class="col">
                                                    <h4
                                                        class="card-title mb-0"
                                                    >
                                                        Fill the form to add a new testimonial
                                                    </h4>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <form action="{{ route('create.testimonial') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div
                                                    class="form-group mb-3 row"
                                                >
                                                    <label
                                                        for="name"
                                                        class="form-label"
                                                        >Name</label
                                                    >
                                                    <div
                                                        class="col-lg-12 col-xl-12"
                                                    >
                                                        <input
                                                            class="form-control"
                                                            type="text"
                                                            id="name"
                                                            placeholder="Name"
                                                            name="name"
                                                        />
                                                        @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div
                                                    class="form-group mb-3 row"
                                                >
                                                    <label
                                                        for="position"
                                                        class="form-label"
                                                        >Position</label
                                                    >
                                                    <div
                                                        class="col-lg-12 col-xl-12"
                                                    >
                                                        <input
                                                            class="form-control"
                                                            type="text"
                                                            id="position"
                                                            name="position"
                                                            placeholder="Position"
                                                        />
                                                        @error('position')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div
                                                    class="form-group mb-3 row"
                                                >
                                                    <label
                                                        for="message"
                                                        class="form-label"
                                                        >Message</label
                                                    >
                                                    <div
                                                        class="col-lg-12 col-xl-12"
                                                    >
                                                        <textarea
                                                            class="form-control"
                                                            id="message"
                                                            name="message"
                                                            placeholder="Message"
                                                        ></textarea>
                                                        @error('message')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div
                                                    class="form-group mb-3 row"
                                                >
                                                    <label
                                                        for="image"
                                                        class="form-label"
                                                        >User Photo</label
                                                    >
                                                    <div
                                                        class="col-lg-12 col-xl-12"
                                                    >
                                                            <input
                                                                type="file"
                                                                class="form-control"
                                                                id="image"
                                                                name="image"
                                                                placeholder="Image"
                                                                aria-describedby="basic-addon1"
                                                            />
                                                            @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                    </div>
                                                </div>

                                                <div
                                                    class="form-group mb-3 row"
                                                >
                                                    <label
                                                        for="photo"
                                                        class="form-label"
                                                        ></label
                                                    >
                                                    <div
                                                        class="col-lg-12 col-xl-12"
                                                    >
                                                        <div
                                                            class="input-group"
                                                        >
                                                          <img
                                                              id="showProfileImage"
                                                              src="{{ url('upload/no_image.jpg') }}"
                                                              class="rounded-circle avatar-xxl img-thumbnail float-start"
                                                              alt="image profile"
                                                          />
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                        </div>
                                        <!--end card-body-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
  </div>
  <script type="text/javascript">
    // ** To show profile image before upload
        $(document).ready(function(){
            $('#image').on('change', function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showProfileImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
