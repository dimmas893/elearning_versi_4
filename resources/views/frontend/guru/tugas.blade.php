@extends('layouts.template_admin')
@section('content')
    {{-- add new employee modal start --}}
<div class="modal fade" id="add_tugas_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New tugas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_tugas_form" enctype="multipart/form-data">
        @csrf
               <div class="modal-body p-4 bg-light">
                <div class="my-2">
                   <label for="name">Nama Ruangan</label>
                    <select class="form-control" name="ruangan_id">
                        @foreach($ruangan as $p)
                            <option value='{{ $p->id}}'> {{ $p->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="my-2">
                   <label for="name">Nama Guru</label>
                    <select class="form-control" name="guru_id">
                        @foreach($guru as $p)
                            <option value='{{ $p->id}}'> {{ $p->name}}</option>
                        @endforeach
                    </select>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_tugas_btn" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="edittugas" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit tugas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_tugas_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
 

        <div class="modal-body p-4 bg-light">
                <div class="my-2">
                   <label for="name">Nama Ruangan</label>
                    <select class="form-control" id="ruangan_id" name="ruangan_id">
                        @foreach($ruangan as $p)
                            <option value='{{ $p->id}}'> {{ $p->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="my-2">
                   <label for="name">Nama Guru</label>
                    <select class="form-control" id="guru_id" name="guru_id">
                        @foreach($guru as $p)
                            <option value='{{ $p->id}}'> {{ $p->name}}</option>
                        @endforeach
                    </select>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_tugas_btn" class="btn btn-success">Update</button>
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
            <h3 class="text-light">Data tugas</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#add_tugas_modal"><i
                class="bi-plus-circle me-2"></i>Add tugas</button>
          </div>
          <div class="card-body" id="tugas_all">
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
      $("#add_tugas_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_tugas_btn").text('Adding...');
        $.ajax({
          url: '{{ route('tugas-store') }}',
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
              tugas_all();
            }
            $("#add_tugas_btn").text('Save');
            $("#add_tugas_form")[0].reset();
            $("#add_tugas_modal").modal('hide');
          }
        });
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('tugas-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#guru_id").val(response.guru_id);
            $("#ruangan_id").val(response.ruangan_id);
            $("#emp_id").val(response.id);
          }
        });
      });

      // update employee ajax request
      $("#edit_tugas_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_tugas_btn").text('Updating...');
        $.ajax({
          url: '{{ route('tugas-update') }}',
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
              tugas_all();
            }
            $("#edit_tugas_btn").text('Update');
            $("#edit_tugas_form")[0].reset();
            $("#edittugas").modal('hide');
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
              url: '{{ route('tugas-delete') }}',
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
                tugas_all();
              }
            });
          }
        })
      });

      // fetch all employees ajax request
      tugas_all();

      function tugas_all() {
        $.ajax({
          url: '/tugas/all',
          method: 'get',
          success: function(response) {
            $("#tugas_all").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
@endsection