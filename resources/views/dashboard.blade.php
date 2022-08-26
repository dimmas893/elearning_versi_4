@extends('layouts.template_admin')
@section('content')
      <div>
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h3 class="text-light">Informasi Sekolah</h3>
          </div>
          <div class="card-body" id="show_data_sekolah">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>


        <div class="modal fade" id="editsekolahModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit sekolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="edit_sekolah_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="emp_id" id="emp_id">
                <input type="hidden" name="emp_image" id="emp_image">
                <div class="modal-body p-4 bg-light">
                <div class="row">
                    <div class="col-lg">
                    <label for="name">Name Sekolah</label>
                    <input type="text" name="name"  id="name" class="form-control" placeholder="Nama Sekolah" required>
                    </div>
                    <div class="col-lg">
                    <label for="alamat">Alamat Sekolah</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat Sekolah" required>
                    </div>
                </div>
                <div class="my-2">
                    <label for="description">Description Sekolah</label>
                    <input type="description" name="description" id="description" class="form-control" placeholder="Description Sekolah" required>
                </div>
                <div class="my-2">
                    <label for="image">Select Image</label>
                    <input type="file" name="image" lass="form-control">
                </div>
                            <div class="mt-2" id="image">

                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="edit_sekolah_btn" class="btn btn-success">Update sekolah</button>
                </div>
            </form>
            </div>
        </div>
        </div>
  </div>
  
@endsection

  @section('js')
  <script>
    $(function() {
      // edit sekolah ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('sekolah-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#name").val(response.name);
            $("#alamat").val(response.alamat);
            $("#description").val(response.description);
            $("#image").html(
              `<img src="storage/images/${response.image}" width="100" class="img-fluid img-thumbnail">`);
            $("#emp_id").val(response.id);
            $("#emp_image").val(response.image);
          }
        });
      });

            // update sekolah ajax request
      $("#edit_sekolah_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_sekolah_btn").text('Updating...');
        $.ajax({
          url: '{{ route('sekolah-update') }}',
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
                'sekolah Updated Successfully!',
                'success'
              )
              sekolah_all();
            }
            $("#edit_sekolah_btn").text('Update sekolah');
            $("#edit_sekolah_form")[0].reset();
            $("#editsekolahModal").modal('hide');
          }
        });
      });

       sekolah_all();

      function sekolah_all() {
        $.ajax({
          url: '{{ route('sekolah-all') }}',
          method: 'get',
          success: function(response) {
            $("#show_data_sekolah").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
</script>
@endsection