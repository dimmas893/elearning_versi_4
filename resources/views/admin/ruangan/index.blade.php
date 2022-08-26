@extends('layouts.template_admin')
@section('content')
    {{-- add new employee modal start --}}
<div class="modal fade" id="add_ruangan_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New ruangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_ruangan_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
                <div class="my-2">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama ruangan" required>
                </div>
                <div class="form-group">
                   <label for="name">Nama Siswa</label>
                    <select class="form-control" name="siswa_id">
                        @foreach($siswa as $p)
                            <option value='{{ $p->id}}'> {{ $p->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                   <label for="name">Kelas</label>
                    <select class="form-control" name="kelas_id">
                        @foreach($kelas as $p)
                            <option value='{{ $p->id}}'> {{ $p->kelas}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                   <label for="name">Jurusan</label>
                    <select class="form-control" name="jurusan_id">
                        @foreach($jurusan as $p)
                            <option value='{{ $p->id}}'> {{ $p->name}}</option>
                        @endforeach
                    </select>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_ruangan_btn" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editruanganModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit ruangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_ruangan_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="emp_image" id="emp_image">
 
        <div class="modal-body p-4 bg-light">
                <div class="my-2">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama ruangan" required>
                </div>
                <div class="form-group">
                   <label for="name">Nama Siswa</label>
                    <select class="form-control" id="siswa_id" name="siswa_id">
                        @foreach($siswa as $p)
                            <option value='{{ $p->id}}'> {{ $p->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                   <label for="name">Kelas</label>
                    <select class="form-control" id="kelas_id" name="kelas_id">
                        @foreach($kelas as $p)
                            <option value='{{ $p->id}}'> {{ $p->kelas}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                   <label for="name">Jurusan</label>
                    <select class="form-control" id="jurusan_id" name="jurusan_id">
                        @foreach($jurusan as $p)
                            <option value='{{ $p->id}}'> {{ $p->name}}</option>
                        @endforeach
                    </select>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_ruangan_btn" class="btn btn-success">Update</button>
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
            <h3 class="text-light">Data ruangan</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#add_ruangan_modal"><i
                class="bi-plus-circle me-2"></i>Add ruangan</button>
          </div>
          <div class="card-body" id="ruangan_all">
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
      $("#add_ruangan_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_ruangan_btn").text('Adding...');
        $.ajax({
          url: '{{ route('ruangan-store') }}',
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
              ruangan_all();
            }
            $("#add_ruangan_btn").text('Save');
            $("#add_ruangan_form")[0].reset();
            $("#add_ruangan_modal").modal('hide');
          }
        });
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('ruangan-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#name").val(response.name);
            $("#siswa_id").val(response.siswa_id);
            $("#kelas_id").val(response.kelas_id);
            $("#jurusan_id").val(response.jurusan_id);
            $("#emp_id").val(response.id);
          }
        });
      });

      // update employee ajax request
      $("#edit_ruangan_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_ruangan_btn").text('Updating...');
        $.ajax({
          url: '{{ route('ruangan-update') }}',
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
              ruangan_all();
            }
            $("#edit_ruangan_btn").text('Update');
            $("#edit_ruangan_form")[0].reset();
            $("#editruanganModal").modal('hide');
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
              url: '{{ route('ruangan-delete') }}',
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
                ruangan_all();
              }
            });
          }
        })
      });

      // fetch all employees ajax request
      ruangan_all();

      function ruangan_all() {
        $.ajax({
          url: '/ruangan/all',
          method: 'get',
          success: function(response) {
            $("#ruangan_all").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
@endsection