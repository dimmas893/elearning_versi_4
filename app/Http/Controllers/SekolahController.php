<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SekolahController extends Controller
{

    // set index page view
    public function index()
    {
        return view('sekolah');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = Sekolah::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Sekolah</th>
                <th>Alamat Sekolah</th>
                <th>Description SEkolah</th>
                <th>Logo Sekolah</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->alamat . '</td>
                <td>' . $emp->description . '</td>
                <td><img src="storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editsekolahModal"><i class="bi-pencil-square h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle edit an Sekolah ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Sekolah::find($id);
        return response()->json($emp);
    }

    // handle update an Sekolah ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $emp = Sekolah::find($request->emp_id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($emp->image) {
                Storage::delete('public/images/' . $emp->image);
            }
        } else {
            $fileName = $request->emp_image;
        }

        $empData = ['name' => $request->name, 'alamat' => $request->alamat, 'description' => $request->description, 'image' => $fileName];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }
}
