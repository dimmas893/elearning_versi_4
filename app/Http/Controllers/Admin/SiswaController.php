<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{

    // set index page view
    public function index()
    {
        return view('admin.siswa.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = Siswa::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>image</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>NISN</th>
                <th>Alamat</th>
                <th>Gender</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td><img src="storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->email . '</td>
                <td>' . $emp->nisn . '</td>
                <td>' . $emp->alamat . '</td>
                <td>' . $emp->gender . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editSiswaModal"><i class="bi-pencil-square h4"></i></a>

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

    // handle insert a new Siswa ajax request
    public function store(Request $request)
    {
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $empData = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'gender' => $request->gender,
            'nisn' => $request->nisn,
            'password' => Hash::make('password'),
            'image' => $fileName
        ];
        Siswa::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Siswa ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Siswa::find($id);
        return response()->json($emp);
    }

    // handle update an Siswa ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $emp = Siswa::find($request->emp_id);
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

        $empData = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'gender' => $request->gender,
            'nisn' => $request->nisn,
            'password' => Hash::make($request->password),
            'image' => $fileName
        ];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Siswa ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Siswa::find($id);
        if (Storage::delete('public/images/' . $emp->image)) {
            Siswa::destroy($id);
        }
    }
}
