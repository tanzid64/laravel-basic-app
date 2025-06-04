@extends('admin.base')

@section('admin')

<div class="container-xxl">
    <!-- Datatables  -->
    <div class="row py-3">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">All Testimonials</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <table id="testimonialTable" class="table table-bordered dt-responsive table-responsive nowrap">
                        <thead>
                        <tr>
                            <th width="3%">SL</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th width="10%" class="text-center">Image</th>
                            <th class="text-center">Message</th>
                            <th width="10%" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($testimonials as $key=>$testimonial)
                          <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td>{{ $testimonial->name }}</td>
                                <td>{{ $testimonial->position }}</td>
                                <td class="text-center">
                                  <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" style="width: 40px; height: 40px;" class="rounded-circle">
                                </td>
                                <td>{{ Str::limit($testimonial->message, 50) }}</td>
                                <td class="text-center">
                                  <a href="{{ route('edit.testimonial', $testimonial->id) }}" class="btn btn-primary btn-sm">
                                    Edit
                                  </a>
                                  <a href="" class="btn btn-danger btn-sm">
                                    Delete
                                  </a>
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
<script>
  $(document).ready(function() {
    $('#testimonialTable').DataTable({
      "language": {
        "emptyTable": "No testimonials available",
      },
      "infoEmpty": "No testimonials to show",
      "columnDefs": [
        {
          "targets": [3,4,5],
          "orderable": false,
        }
      ]
    });
  });
</script>
@endsection
