@extends('layouts.template_admin')
@section('content')
    {{-- add new employee modal start --}}
<div class="modal fade" id="add_siswa_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_siswa_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="my-2">
              <label for="name">Nama Siswa</label>
              <input type="text" name="name" class="form-control" placeholder="Nama Siswa" required>
          </div>
          
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
          </div>

          <div class="my-2">
            <label for="nisn">NISN</label>
            <input type="number" name="nisn" class="form-control" placeholder="NISN" required>
          </div>

          <div class="my-2">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
          </div>

          <div class="my-2">
            <label for="gender">Gender</label>
            <input type="text" name="gender" class="form-control" placeholder="gender" required>
          </div>

          <div class="my-2">
            <label for="image">Select image</label>
            <input type="file" name="image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_siswa_btn" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_siswa_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="emp_image" id="emp_image">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="name">Name Siswa</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Name TU" required>
            </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
          </div>
          
          <div class="my-2">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
          </div>
          
          <div class="my-2">
            <label for="alamat">alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="alamat" required>
          </div>
          
          <div class="my-2">
            <label for="nisn">nisn</label>
            <input type="string" name="nisn" id="nisn" class="form-control" placeholder="nisn" required>
          </div>
          
          <div class="my-2">
            <label for="gender">gender</label>
            <input type="text" name="gender" id="gender" class="form-control" placeholder="gender" required>
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
          <button type="submit" id="edit_siswa_btn" class="btn btn-success">Update</button>
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
            <h3 class="text-light">Data Siswa</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#add_siswa_modal"><i
                class="bi-plus-circle me-2"></i>Add Siswa</button>
          </div>
          <div class="card-body" id="siswa_all">
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
      $("#add_siswa_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_siswa_btn").text('Adding...');
        $.ajax({
          url: '{{ route('siswa-store') }}',
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
                'TU Added Successfully!',
                'success'
              )
              siswa_all();
            }
            $("#add_siswa_btn").text('Save');
            $("#add_siswa_form")[0].reset();
            $("#add_siswa_modal").modal('hide');
          }
        });
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('siswa-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#name").val(response.name);
            $("#email").val(response.email);
            $("#password").val(response.password);
            $("#alamat").val(response.alamat);
            $("#nisn").val(response.nisn);
            $("#gender").val(response.gender);
            $("#image").html(
              `<img src="storage/images/${response.image}" width="100" class="img-fluid img-thumbnail">`);
            $("#emp_id").val(response.id);
            $("#emp_image").val(response.image);
          }
        });
      });

      // update employee ajax request
      $("#edit_siswa_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_siswa_btn").text('Updating...');
        $.ajax({
          url: '{{ route('siswa-update') }}',
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
                'TU Updated Successfully!',
                'success'
              )
              siswa_all();
            }
            $("#edit_siswa_btn").text('Update');
            $("#edit_siswa_form")[0].reset();
            $("#editSiswaModal").modal('hide');
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
              url: '{{ route('siswa-delete') }}',
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
                siswa_all();
              }
            });
          }
        })
      });

      // fetch all employees ajax request
      siswa_all();

      function siswa_all() {
        $.ajax({
          url: '/siswa/all',
          method: 'get',
          success: function(response) {
            $("#siswa_all").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
@endsection