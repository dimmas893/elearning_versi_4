<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\guru_kelas;
use App\Models\MataPelajaran;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class WaliKelasController extends Controller
{

    // set index page view
    public function index()
    {
        $ruangan = Ruangan::all();
        $guru = Guru::all();
        $matapelajaran = MataPelajaran::all();

        return view('admin.walikelas.index', compact([
            'ruangan',
            'matapelajaran',
            'guru'
        ]));
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = guru_kelas::with('ruangan', 'mata_pelajaran', 'guru')->get();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
              <th>Id</th>
              <th>Nama Pengajar</th>
              <th>Kelas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->guru->name . '</td>
                <td>' . $emp->ruangan->kelas->kelas . ' ' . $emp->ruangan->jurusan->name . '</td>
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
            'guru_id' => $request->guru_id,
            'ruangan_id' => $request->ruangan_id,
        ];
        guru_kelas::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Ruangan ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = guru_kelas::find($id);
        return response()->json($emp);
    }

    // handle update an Ruangan ajax request
    public function update(Request $request)
    {
        $emp = guru_kelas::find($request->emp_id);

        $empData = [
            'guru_id' => $request->guru_id,
            'ruangan_id' => $request->ruangan_id,
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
        $emp = guru_kelas::find($id);
        guru_kelas::destroy($id);
    }
}
