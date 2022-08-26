@extends('layouts.template_admin')
@section('content')
    <div>
        <div class="row my-5">
        <div class="col-lg-12">
            <div class="card shadow">
            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h3 class="text-light">Data Kelas</h3>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addkelas"><i
                        class="bi-plus-circle me-2"></i>Add New kelas</button>
                    </div>
            <div class="card-body" id="show_data_kelas">
                <h1 class="text-center text-secondary my-5">Loading...</h1>
            </div>
            </div>
        </div>
        </div>

    <div class="modal fade" id="editkelas" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit sekolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="edit_kelas_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="emp_id" id="emp_id">
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                        <label for="kelas">Name Kelas</label>
                        <input type="text" name="kelas" id="kelas" class="form-control" placeholder="kelas Kelas" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="edit_kelas_btn" class="btn btn-success">Update</button>
                </div>
            </form>
            </div>
        </div>
        </div>

        {{-- add new kelas modal start --}}
<div class="modal fade" id="addkelas" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data kelas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_kelas_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="kelas">Name Kelas</label>
              <input type="text" name="kelas" class="form-control" placeholder="kelas Kelas" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_kelas_button" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new kelas modal end --}}
  </div>
  
@endsection



@section('js')
    <script>
    $(function() {

      // add new kelas ajax request
      $("#add_kelas_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_kelas_button").text('Adding...');
        $.ajax({
          url: '{{ route('kelas-store') }}',
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
                'Data kelas Added Successfully!',
                'success'
              )
              kelas_all();
            }
            $("#add_kelas_button").text('Add kelas');
            $("#add_kelas_form")[0].reset();
            $("#addkelas").modal('hide');
          }
        });
      });

      // edit kelas ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('kelas-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#kelas").val(response.kelas);
            $("#emp_id").val(response.id);
          }
        });
      });

      // update kelas ajax request
      $("#edit_kelas_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_kelas_btn").text('Updating...');
        $.ajax({
          url: '{{ route('kelas-update') }}',
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
                'kelas Updated Successfully!',
                'success'
              )
              kelas_all();
            }
            $("#edit_kelas_btn").text('Update');
            $("#edit_kelas_form")[0].reset();
            $("#editkelas").modal('hide');
          }
        });
      });

      // delete kelas ajax request
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
              url: '{{ route('kelas-delete') }}',
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
                kelas_all();
              }
            });
          }
        })
      });

      // fetch all kelass ajax request
      kelas_all();

      function kelas_all() {
        $.ajax({
          url: '{{ route('kelas-all') }}',
          method: 'get',
          success: function(response) {
            $("#show_data_kelas").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
@endsection