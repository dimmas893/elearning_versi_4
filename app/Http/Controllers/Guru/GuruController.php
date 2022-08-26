<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Jadwal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function index()
    {
        return view('frontend.guru.index');
    }

    public function jadwalMengajar()
    {
        $jadwals = Jadwal::with('mata_pelajaran', 'hari', 'ruangan', 'guru')->where('guru_id', Auth::guard('guru')->user()->id)->get();

        return view('frontend.guru.jadwal', [
            'jadwals' => $jadwals,
        ]);
    }

    public function create($id)
    {
        $jadwalId = decrypt($id);
        $jadwal = Jadwal::where('id', $jadwalId)
            ->where('guru_id', Auth::guard('guru')->user()->id)
            ->first();

        return view('frontend.guru.meteri', compact('jadwal'));
    }

    // public function store(Request $request)
    // {
    //     $materi = $request->all();

    //     if ($request->tipe == 'pdf') {
    //         $fileName = time() . '.' . $request->file('file_or_link')->extension();
    //         $materi['file_or_link'] = $request->file('file_or_link')->storeAs("materials", $fileName);
    //     }

    //     Auth::guard('guru')->user()->materi()->create($materi);

    //     return redirect(route('kelas.materi', $materi['jadwal']))->with('success', 'Berhasil membuat materi');
    // }

    public function masuk(Request $request, $id)
    {
        //parameter $jadwalId adalah id dari jadwal yang sudah di encrypt
        //dan kode dibawah untuk mencari jadwal dari param $jadwalId sekalian di decrypt var $jadwalId nya
        $jadwal = Jadwal::where('id', decrypt($id))->first();

        // Jika waktu pada jadwal sesuai maka jalankan code dibawah
        if (\Carbon\Carbon::now('Asia/Jakarta')->format('H:i') >= $jadwal->jam_masuk && \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') <= $jadwal->jam_keluar) {

            // Code dibawah untuk menampilkan seluruh mahasiswa yang berada di kelas yang sama dan dijadwal yang sama
            // Beserta menampilkan  absensi hari ini
            $mahasiswa = Siswa::with(['mahasiswaAbsenHariIni' => function ($q) use ($jadwal) {
                $q->where('jadwal_id', $jadwal->id);
            }])->where('ruangan_id', $jadwal->ruangan_id)->get();

            $mahasiswaHadir = $mahasiswa->where('mahasiswaAbsenHariIni', '!=', null)->count();
            $mahasiswaTidakHadir = $mahasiswa->where('mahasiswaAbsenHariIni', '==', null)->count();

            // Code dibawah untuk menampilkan data absen yang telah dibuat oleh dosen untuk hari ini
            // dan akan digunakan untuk simpan rekap absen
            $absen = Absen::where('guru_id', Auth::guard('guru')->user()->id)
                ->where('jadwal_id', $jadwal->id)
                ->whereDate('created_at', now())
                ->first();


            return view('frontend.guru.kelas', compact('mahasiswa', 'jadwal', 'absen', 'mahasiswaHadir', 'mahasiswaTidakHadir'));
        }

        // Jika waktu pada jadwal tidak sesuai return back
        return back();
    }

    public function storeAbsen(Request $request)
    {
        dd($request->all());
        $absen = collect(Absen::where('guru_id', Auth::Id())
            ->where('jadwal_id', $request->jadwal)
            ->whereDate('created_at', date('Y-m-d'))
            ->first());

        //Jika parent absen belom dibuat jangan kasih create absen
        if ($absen->isNotEmpty()) {
            for ($i = 0; $i < count($request->mahasiswa); $i++) {
                Absen::updateOrCreate(
                    [
                        'mahasiswa_id' => $request->mahasiswa[$i],
                        'parent' => $absen['id']
                    ],
                    [
                        'parent' => $request->parent,
                        'status' => $request->status[$i],
                        'jadwal_id' => $request->jadwal,
                        'pertemuan' => $request->pertemuan,
                    ]
                );
            }
            return back()->with('success', 'Berhasil menyimpan data absen');
        }

        return back()->with('error', 'Ups!! Sepertinya anda belum membuat absen untuk hari ini');
    }




    public function create_absensi($id)
    {
        $jadwal = Jadwal::with('hari')->findOrFail(decrypt($id));
        $kelasActive = Jadwal::with('guru')->where('guru_id', Auth::guard('guru')->user()->id)->where('hari_id', 5)->get();
        $absen = Absen::where('guru_id', Auth::guard('guru')->user()->id)
            ->where('jadwal_id', $jadwal->id)
            ->whereDate('created_at', now())
            ->first();
        return view('frontend.guru.absensi-create', compact('kelasActive', 'jadwal', 'absen'));
    }

    public function store_absensi(Request $request)
    {
        $jadwal_id = decrypt(request('jadwal'));

        request()->validate([
            'pertemuan' => 'required'
        ]);

        $absen = Absen::create([
            'jadwal_id' => $jadwal_id,
            'pertemuan' => request('pertemuan'),
            'rangkuman' => request('rangkuman'),
            'berita_acara' => request('berita_acara')
        ]);

        $mahasiswas = Siswa::where('ruangan_id', request('kelas'))->get();

        foreach ($mahasiswas as $mahasiswa) {
            Absen::create([
                'jadwal_id' => $jadwal_id,
                'parent' => $absen->id,
                'siswa_id' => $mahasiswa->id,
                'pertemuan' => $absen->pertemuan,
            ]);
        }

        session()->flash('success', 'Berhasil membuat absen hari ini');
        return redirect(route('kelas-masuk', request('jadwal')));
    }
}