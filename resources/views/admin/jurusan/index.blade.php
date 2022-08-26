@extends('layouts.template_admin')
@section('content')
    <div>
        <div class="row my-5">
        <div class="col-lg-12">
            <div class="card shadow">
            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h3 class="text-light">Data Jurusan</h3>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addjurusan"><i
                        class="bi-plus-circle me-2"></i>Add New Jurusan</button>
                    </div>
            <div class="card-body" id="show_data_jurusan">
                <h1 class="text-center text-secondary my-5">Loading...</h1>
            </div>
            </div>
        </div>
        </div>

    <div class="modal fade" id="editjurusan" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit sekolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="edit_jurusan_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="emp_id" id="emp_id">
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                        <label for="name">Name Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name Jurusan" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="edit_jurusan_btn" class="btn btn-success">Update</button>
                </div>
            </form>
            </div>
        </div>
        </div>

        {{-- add new jurusan modal start --}}
<div class="modal fade" id="addjurusan" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data jurusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_jurusan_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="name">Name jurusan</label>
              <input type="text" name="name" class="form-control" placeholder="Name Jurusan" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_jurusan_button" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new jurusan modal end --}}
  </div>
  
@endsection



@section('js')
    <script>
    $(function() {

      // add new jurusan ajax request
      $("#add_jurusan_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_jurusan_button").text('Adding...');
        $.ajax({
          url: '{{ route('jurusan-store') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Data jurusan Added Successfully!',
                'success'
              )
              jurusan_all();
            }
            $("#add_jurusan_button").text('Add Jurusan');
            $("#add_jurusan_form")[0].reset();
            $("#addjurusan").modal('hide');
          }
        });
      });

      // edit jurusan ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('jurusan-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#name").val(response.name);
            $("#emp_id").val(response.id);
          }
        });
      });

      // update jurusan ajax request
      $("#edit_jurusan_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_jurusan_btn").text('Updating...');
        $.ajax({
          url: '{{ route('jurusan-update') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'jurusan Updated Successfully!',
                'success'
              )
              jurusan_all();
            }
            $("#edit_jurusan_btn").text('Update Nama jurusan');
            $("#edit_jurusan_form")[0].reset();
            $("#editjurusan").modal('hide');
          }
        });
      });

      // delete jurusan ajax request
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('jurusan-delete') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                jurusan_all();
              }
            });
          }
        })
      });

      // fetch all jurusans ajax request
      jurusan_all();

      function jurusan_all() {
        $.ajax({
          url: '{{ route('jurusan-all') }}',
          method: 'get',
          success: function(response) {
            $("#show_data_jurusan").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
@endsection