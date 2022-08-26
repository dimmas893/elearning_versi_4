<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{

    // set index page view
    public function index()
    {
        $siswa = Siswa::all();
        $guru = Guru::all();
        $matapelajaran = MataPelajaran::all();
        $jadwal = Jadwal::all();

        return view('frontend.guru.tugas', compact([
            'siswa',
            'matapelajaran',
            'guru',
            'jadwal'
        ]));
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = Tugas::with('jadwal', 'siswa', 'mata_pelajaran', 'guru')->get();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
              <th>Id</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editwalikelas"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new Ruangan ajax request
    public function store(Request $request)
    {
        $empData = [
            'jadwal_id' => $request->guru_id,
            'guru_id' => $request->guru_id,
            'ruangan_id' => $request->ruangan_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'siswa_id' => $request->siswa_id,
            'parent' => $request->parent,
            'judul' => $request->judul,
            'type' => $request->type,
            'file_or_link' => $request->file_or_link,
            'pertemuan' => $request->pertemuan,
            'description' => $request->description,
            'pengumpulan' => $request->pengumpulan,
        ];
        Tugas::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Ruangan ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Tugas::find($id);
        return response()->json($emp);
    }

    // handle update an Ruangan ajax request
    public function update(Request $request)
    {
        $emp = Tugas::find($request->emp_id);

        $empData = [
            'jadwal_id' => $request->guru_id,
            'guru_id' => $request->guru_id,
            'ruangan_id' => $request->ruangan_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'siswa_id' => $request->siswa_id,
            'parent' => $request->parent,
            'judul' => $request->judul,
            'type' => $request->type,
            'file_or_link' => $request->file_or_link,
            'pertemuan' => $request->pertemuan,
            'description' => $request->description,
            'pengumpulan' => $request->pengumpulan,
        ];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Ruangan ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Tugas::find($id);
        Tugas::destroy($id);
    }
}
