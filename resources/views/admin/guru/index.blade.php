@extends('layouts.template_admin')
@section('content')
    {{-- add new employee modal start --}}
<div class="modal fade" id="add_guru_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Guru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_guru_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="my-2">
              <label for="name">Nama Guru</label>
              <input type="text" name="name" class="form-control" placeholder="Nama Guru" required>
          </div>
          
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
          </div>

          <div class="my-2">
            <label for="image">Select image</label>
            <input type="file" name="image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_guru_btn" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editGuruModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Guru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_guru_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="emp_image" id="emp_image">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="name">Name Guru</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Name Guru" required>
            </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
          </div>
          
          <div class="my-2">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>
          <div class="my-2">
            <label for="image">Select image</label>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="mt-2" id="image">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_guru_btn" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit employee modal end --}}

    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h3 class="text-light">Data Guru</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#add_guru_modal"><i
                class="bi-plus-circle me-2"></i>Add Guru</button>
          </div>
          <div class="card-body" id="guru_all">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js')
      <script>
    $(function() {

      // add new employee ajax request
      $("#add_guru_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_guru_btn").text('Adding...');
        $.ajax({
          url: '{{ route('guru-store') }}',
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
                'Guru Added Successfully!',
                'success'
              )
              guru_all();
            }
            $("#add_guru_btn").text('Save');
            $("#add_guru_form")[0].reset();
            $("#add_guru_modal").modal('hide');
          }
        });
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('guru-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#name").val(response.name);
            $("#email").val(response.email);
            $("#password").val(response.password);
            $("#image").html(
              `<img src="storage/images/${response.image}" width="100" class="img-fluid img-thumbnail">`);
            $("#emp_id").val(response.id);
            $("#emp_image").val(response.image);
          }
        });
      });

      // update employee ajax request
      $("#edit_guru_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_guru_btn").text('Updating...');
        $.ajax({
          url: '{{ route('guru-update') }}',
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
                'Guru Updated Successfully!',
                'success'
              )
              guru_all();
            }
            $("#edit_guru_btn").text('Update');
            $("#edit_guru_form")[0].reset();
            $("#editGuruModal").modal('hide');
          }
        });
      });

      // delete employee ajax request
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
              url: '{{ route('guru-delete') }}',
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
                guru_all();
              }
            });
          }
        })
      });

      // fetch all employees ajax request
      guru_all();

      function guru_all() {
        $.ajax({
          url: '/guru/all',
          method: 'get',
          success: function(response) {
            $("#guru_all").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
@endsection