@extends('admin.base') 
@section('admin')
<div class="content">
    <!-- Start Content-->
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Profile</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Components</a>
                    </li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center">
                            <div class="d-flex align-items-center">
                                <img
                                    src="{{ (!empty($user_data->photo)) ? url('upload/user_images/'.$user_data->photo) : url('upload/no_image.jpg') }}"
                                    class="rounded-circle avatar-xxl img-thumbnail float-start"
                                    alt="image profile"
                                />

                                <div class="overflow-hidden ms-4">
                                    <h4 class="m-0 text-dark fs-20">
                                        {{ $user_data->name }}
                                    </h4>
                                    <p class="my-1 text-muted fs-16">
                                        Email: {{ $user_data->email }}
                                    </p>
                                    <p class="my-1 text-muted fs-16">
                                        Phone: {{ $user_data->phone ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="tab-pane pt-4"
                            id="profile_setting"
                            role="tabpanel"
                        >
                            <div class="row">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="card border mb-0">
                                            <div class="card-header">
                                                <div
                                                    class="row align-items-center"
                                                >
                                                    <div class="col">
                                                        <h4
                                                            class="card-title mb-0"
                                                        >
                                                            Personal Information
                                                        </h4>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div
                                                        class="form-group mb-3 row"
                                                    >
                                                        <label
                                                            for="name"
                                                            class="form-label"
                                                            >Full Name</label
                                                        >
                                                        <div
                                                            class="col-lg-12 col-xl-12"
                                                        >
                                                            <input
                                                                class="form-control"
                                                                type="text"
                                                                id="name"
                                                                name="name"
                                                                value="{{ $user_data->name }}"
                                                            />
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="form-group mb-3 row"
                                                    >
                                                        <label
                                                            for="phone"
                                                            class="form-label"
                                                            >Contact
                                                            Phone</label
                                                        >
                                                        <div
                                                            class="col-lg-12 col-xl-12"
                                                        >
                                                            <div
                                                                class="input-group"
                                                            >
                                                                <span
                                                                    class="input-group-text"
                                                                    ><i
                                                                        class="mdi mdi-phone-outline"
                                                                    ></i
                                                                ></span>
                                                                <input
                                                                    class="form-control"
                                                                    type="text"
                                                                    id="phone"
                                                                    name="phone"
                                                                    placeholder="Phone"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $user_data->phone ?? '' }}"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="form-group mb-3 row"
                                                    >
                                                        <label
                                                            for="email"
                                                            class="form-label"
                                                            >Email
                                                            Address</label
                                                        >
                                                        <div
                                                            class="col-lg-12 col-xl-12"
                                                        >
                                                            <div
                                                                class="input-group"
                                                            >
                                                                <span
                                                                    class="input-group-text"
                                                                    ><i
                                                                        class="mdi mdi-email"
                                                                    ></i
                                                                ></span>
                                                                <input
                                                                    type="email"
                                                                    class="form-control"
                                                                    id="email"
                                                                    name="email"
                                                                    value="{{ $user_data->email }}"
                                                                    placeholder="Email"
                                                                    aria-describedby="basic-addon1"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="form-group mb-3 row"
                                                    >
                                                        <label
                                                            for="address"
                                                            class="form-label"
                                                            >Address</label
                                                        >
                                                        <div
                                                            class="col-lg-12 col-xl-12"
                                                        >
                                                            <textarea
                                                                  class="form-control"
                                                                  id="address"
                                                                  name="address"
                                                              >{{ $user_data->address }}
                                                            </textarea>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="form-group mb-3 row"
                                                    >
                                                        <label
                                                            for="photo"
                                                            class="form-label"
                                                            >Profile Photo</label
                                                        >
                                                        <div
                                                            class="col-lg-12 col-xl-12"
                                                        >
                                                            <div
                                                                class="input-group"
                                                            >
                                                                <input
                                                                    type="file"
                                                                    class="form-control"
                                                                    id="photo"
                                                                    name="photo"
                                                                    placeholder="Photo"
                                                                    aria-describedby="basic-addon1"
                                                                />
                                                            </div>
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
                                                                  src="{{ (!empty($user_data->photo)) ? url('upload/user_images/'.$user_data->photo) : url('upload/no_image.jpg') }}"
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

                                    <div class="col-lg-6 col-xl-6">
                                        <div class="card border mb-0">
                                            <div class="card-header">
                                                <div
                                                    class="row align-items-center"
                                                >
                                                    <div class="col">
                                                        <h4
                                                            class="card-title mb-0"
                                                        >
                                                            Change Password
                                                        </h4>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div>

                                            <div class="card-body mb-0">
                                                <div
                                                    class="form-group mb-3 row"
                                                >
                                                    <label class="form-label"
                                                        >Old Password</label
                                                    >
                                                    <div
                                                        class="col-lg-12 col-xl-12"
                                                    >
                                                        <input
                                                            class="form-control"
                                                            type="password"
                                                            placeholder="Old Password"
                                                        />
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group mb-3 row"
                                                >
                                                    <label class="form-label"
                                                        >New Password</label
                                                    >
                                                    <div
                                                        class="col-lg-12 col-xl-12"
                                                    >
                                                        <input
                                                            class="form-control"
                                                            type="password"
                                                            placeholder="New Password"
                                                        />
                                                    </div>
                                                </div>
                                                <div
                                                    class="form-group mb-3 row"
                                                >
                                                    <label class="form-label"
                                                        >Confirm Password</label
                                                    >
                                                    <div
                                                        class="col-lg-12 col-xl-12"
                                                    >
                                                        <input
                                                            class="form-control"
                                                            type="password"
                                                            placeholder="Confirm Password"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div
                                                        class="col-lg-12 col-xl-12"
                                                    >
                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary"
                                                        >
                                                            Change Password
                                                        </button>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger"
                                                        >
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
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
        </div>
        <!-- container-fluid -->
    </div>
  </div>
  <script type="text/javascript">
    // ** To show profile image before upload
    $(document).ready(function(){
      $('#photo').on('change', function(e){
        var reader = new FileReader();
        reader.onload = function(e){
          $('#showProfileImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
      })
    })
  </script>
@endsection
