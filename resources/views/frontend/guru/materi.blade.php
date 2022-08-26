@extends('layouts.template_guru')
@section('content')
        <div class="card">
        <div class="card-header">
            <h4>Form Upload Materi</h4>
        </div>
        <div class="card-body col-md-8 col-sm">

            <form action="/" method="post" enctype="multipart/form-data">
                @csrf
                <select attr="ruangan_id" label="ruangan" :data="$jadwal" valueOption="ruangan_id" relasi="ruangan"
                    labelOption="name" selected />
                <select attr="mata_pelajaran_id" label="matapelajaran" :data="$jadwal" valueOption="mata_pelajaran_id" relasi="mata_pelajaran"
                    labelOption="nm_matkul" selected />
                <input type="text" attr="judul" label="Judul" />
                <input type="number" attr="pertemuan" label="Pertemuan"
                    value="{{ $jadwal->absenParent->pertemuan ?? '' }}" />
                {{-- <input type="text" value="pertemuan" class="form-control"> --}}
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <select class="form-control selectric" name="tipe" id="tipe">
                        <option disabled selected>Pilih Tipe</option>
                        <option value="pdf">PDF</option>
                        <option value="youtube">YouTube</option>
                    </select>
                </div>
                <div class="form-group" id="formLink">
                    <label for="link">Link <code>https://www.youtube.com/watch?v=jfKfPfyJRdk</code></label>
                    <input type="text" name="file_or_link" class="form-control" id="link" placeholder="jfKfPfyJRdk">
                </div>
                <div class="form-group" id="formFile">
                    <label for="file">File</label>
                    <input type="file" name="file_or_link" class="form-control" id="file">
                </div>
                <textarea attr="deskripsi" label="Deskripsi"></textarea>
                <input type="hidden" name="jadwal" value="{{ encrypt($jadwal->id) }}">

                <button>Simpan</button>
            </form>
        </div>
    </div>
@endsection