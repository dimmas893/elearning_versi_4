<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelasController extends Controller
{

    // set index page view
    public function index()
    {
        return view('admin.kelas.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = Kelas::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nama Kelas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->kelas . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editkelas"><i class="bi-pencil-square h4"></i></a>

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

    // handle insert a new Kelas ajax request
    public function store(Request $request)
    {
        $empData = ['kelas' => $request->kelas];
        Kelas::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Kelas ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Kelas::find($id);
        return response()->json($emp);
    }

    // handle update an Kelas ajax request
    public function update(Request $request)
    {
        $emp = Kelas::find($request->emp_id);
        $empData = ['kelas' => $request->kelas];
        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Kelas ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        Kelas::destroy($id);
    }
}
