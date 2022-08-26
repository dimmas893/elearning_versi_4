@extends('layouts.template_admin')
@section('content')
    {{-- add new employee modal start --}}
<div class="modal fade" id="add_walikelas_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New walikelas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_walikelas_form" enctype="multipart/form-data">
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
          <button type="submit" id="add_walikelas_btn" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editwalikelas" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit walikelas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_walikelas_form" enctype="multipart/form-data">
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
          <button type="submit" id="edit_walikelas_btn" class="btn btn-success">Update</button>
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
            <h3 class="text-light">Data walikelas</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#add_walikelas_modal"><i
                class="bi-plus-circle me-2"></i>Add walikelas</button>
          </div>
          <div class="card-body" id="walikelas_all">
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
      $("#add_walikelas_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_walikelas_btn").text('Adding...');
        $.ajax({
          url: '{{ route('walikelas-store') }}',
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
              walikelas_all();
            }
            $("#add_walikelas_btn").text('Save');
            $("#add_walikelas_form")[0].reset();
            $("#add_walikelas_modal").modal('hide');
          }
        });
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('walikelas-edit') }}',
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
      $("#edit_walikelas_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_walikelas_btn").text('Updating...');
        $.ajax({
          url: '{{ route('walikelas-update') }}',
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
              walikelas_all();
            }
            $("#edit_walikelas_btn").text('Update');
            $("#edit_walikelas_form")[0].reset();
            $("#editwalikelas").modal('hide');
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
              url: '{{ route('walikelas-delete') }}',
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
                walikelas_all();
              }
            });
          }
        })
      });

      // fetch all employees ajax request
      walikelas_all();

      function walikelas_all() {
        $.ajax({
          url: '/walikelas/all',
          method: 'get',
          success: function(response) {
            $("#walikelas_all").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
@endsection