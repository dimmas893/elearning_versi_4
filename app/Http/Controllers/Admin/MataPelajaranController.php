<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{

    // set index page view
    public function index()
    {
        return view('admin.mata_pelajaran.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = MataPelajaran::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nama Mata Pelajaran</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->name . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editmatapelajaran"><i class="bi-pencil-square h4"></i></a>

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

    // handle insert a new jurusan ajax request
    public function store(Request $request)
    {
        $empData = ['name' => $request->name];
        MataPelajaran::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an jurusan ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = MataPelajaran::find($id);
        return response()->json($emp);
    }

    // handle update an jurusan ajax request
    public function update(Request $request)
    {
        $emp = MataPelajaran::find($request->emp_id);
        $empData = ['name' => $request->name];
        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an jurusan ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        MataPelajaran::destroy($id);
    }
}

