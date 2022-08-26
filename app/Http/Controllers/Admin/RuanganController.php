<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RuanganController extends Controller
{

    // set index page view
    public function index()
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $siswa = Siswa::all();
        $guru = Guru::all();
        
        return view('admin.ruangan.index', compact([
            'kelas',
            'jurusan',
            'siswa',
            'guru'
        ]));
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = Ruangan::with('siswa', 'kelas', 'jurusan', 'guru')->get();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
              <th>Id</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <th>Jurusan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->siswa->name . '</td>
                <td>' . $emp->kelas->kelas . '</td>
                <td>' . $emp->jurusan->name . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editruanganModal"><i class="bi-pencil-square h4"></i></a>

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
            'name' => $request->name,
            'siswa_id' => $request->siswa_id,
            'jurusan_id' => $request->jurusan_id,
            'kelas_id' => $request->kelas_id,
        ];
        Ruangan::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Ruangan ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Ruangan::find($id);
        return response()->json($emp);
    }

    // handle update an Ruangan ajax request
    public function update(Request $request)
    {
        $emp = Ruangan::find($request->emp_id);
        $empData = [
            'siswa_id' => $request->siswa_id,
            'jurusan_id' => $request->jurusan_id,
            'kelas_id' => $request->kelas_id,
            'name' => $request->name,
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
        $emp = Ruangan::find($id);
            Ruangan::destroy($id);
    }
}
