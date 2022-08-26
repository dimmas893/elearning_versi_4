@extends('layouts.template_guru')
@section('contents')
    @foreach ($jadwals as $p)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                    <h5 class="card-title">{{ $p->guru->name }}</h5>
                    <h5 class="card-title">{{ $p->hari->name }}</h5>
                    <p class="card-text">{{ $p->mata_pelajaran->name }}</p>
                    <p class="card-text">Kelas {{ $p->ruangan->kelas->kelas }} {{ $p->ruangan->jurusan->name }}</p>
                    <p class="card-text">Jam masuk {{ $p->jam_masuk }}</p>
                    <p class="card-text">Jam masuk {{ $p->jam_keluar }}</p>
                    <div class="pricing-cta">
					@if (\Carbon\Carbon::now('Asia/Jakarta')->format('H:i') >= $p->jam_masuk && \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') <= $p->jam_keluar && $p->hari->name == \Carbon\Carbon::now()->isoFormat('dddd'))
					<a class="btn btn-primary" href="{{ route('kelas-masuk' ,encrypt($p->id))}}">Masuk Kelas<i
						class="ml-2 fas fa-arrow-right"></i></a>
					@else
					

						<button class="btn btn-primary first">Masuk Kelas<i class="ml-2 fas fa-arrow-right"></i></button>
					@endif
					
				</div>
            </div>
        </div>
    @endforeach
@endsection

	@section('js')
	<script>
			document.querySelector(".first").addEventListener('click', function(){
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Jam Pelajaran Belum Dimulai!',
				})
			});
	</script>
	<!-- JS Libraies -->
	@endsection	