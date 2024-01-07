<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Rombel;
use App\Models\Rayon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $students = Students::all();
                $rombel = Rombel::all();
                $rayon = Rayon::all();
                return view('students.admin.index', compact('students', 'rombel', 'rayon'));
            } else {
                $students = Students::all();
                $rombel = Rombel::all();
                $rayon = Rayon::all();
                return view('students.ps.index', compact('students', 'rombel', 'rayon'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rombel = Rombel::all();
        $rayon = Rayon::all();
        return view('students.admin.create', compact('rombel', 'rayon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric',            
            'name' => 'required',            
            'rombel_id' => 'required',            
            'rayon_id' => 'required',            
        ]);

        Students::create([
            'nis' => $request->nis,            
            'name' => $request->name,            
            'rombel_id' => $request->rombel_id,            
            'rayon_id' => $request->rayon_id,            
        ]);
        
        return redirect()->route('students.home')->with('success', 'Berhasil menambahkan data siswa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Students $students, $id)
    {
        $students = Students::find($id);
        $rombel = Rombel::all();
        $rayon = Rayon::all();

        return view('students.edit', compact('students', 'rombel', 'rayon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $students, $id)
    {
        $request->validate([
            'nis' => 'required|numeric',            
            'name' => 'required',            
            'rombel_id' => 'required',            
            'rayon_id' => 'required',            
        ]);

        $DataBaru = [
            'nis' => $request->nis,
            'name' => $request->name, 
            'rombel_id'=> $request->rombel_id,          
            'rayon_id'=> $request->rayon_id,          
        ];

        Students::where('id', $id)->update($DataBaru);
        
        return redirect()->route('students.home')->with('success', 'Berhasil mengubah data siswa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $students, $id)
    {
        Students::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'data siswa berhasil dihapus!');
    }

    public function student()
    {
        $rayon = Rayon::where('user_id', Auth::user()->id)->first();
        $students = Students::where('rayon_id', $rayon->id)->get();
        $rombel = Rombel::all();
        return view('students.ps.index', compact('students', 'rayon'));
    }
}
