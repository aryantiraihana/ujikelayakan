<?php

namespace App\Http\Controllers;

use App\Models\Lates;
use App\Models\Students;
use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use App\Exports\LatesExport;

class LatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $lates = Lates::all();
                $students = Students::all();
                return view("lates.admin.index", compact('lates', 'students'));
            } else {
                $lates = Lates::all();
                $students = Students::all();
                return view("lates.ps.index", compact('lates', 'students'));
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
        $students = Students::all();
        return view('lates.admin.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_time_late' => 'required',            
            'information' => 'required',            
            'bukti' => 'nullable|mimes:png,jpg,jpeg|max:2048',            
            'student_id' => 'required',            
        ]);

        if ($request->hasFile('bukti')) {
            $bukti_file = $request->file('bukti');
            $bukti_nama = $bukti_file->hashName();
            $bukti_file->move(public_path('img'), $bukti_nama);

            $data_lates['bukti'] = $bukti_nama;
        }

        Lates::create([
            'date_time_late' => $request->date_time_late,            
            'information' => $request->information,            
            'bukti' => $bukti_nama,            
            'student_id' => $request->student_id,            
        ]);

        
        return redirect()->route('lates.home')->with('success', 'Berhasil menambahkan data keterlambatan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lates $lates, $id)
    {
        
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $lates = Lates::where('student_id', $id)->get();
                $students = Students::find($id);
                return view('lates.admin.lihat', compact('lates', 'students'));
            } else {
                $lates = Lates::where('student_id', $id)->get();
                $students = Students::find($id);
                return view("lates.ps.lihat", compact('lates', 'students'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lates $lates, $id)
    {
        $lates = Lates::find($id);
        $students = Students::all();
        return view('lates.admin.edit', compact('lates', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lates $lates, $id)
    {
        $request->validate([
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'student_id' => 'required',
        ]);

        $lates = Lates::find($id);

    // Menyiapkan data baru untuk update
        $DataBaru = [
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,          
            'student_id' => $request->student_id,           
        ];

        // Jika ada file bukti baru diunggah
        if ($request->hasFile('bukti')) {
            // Hapus file bukti lama jika ada
            $bukti_lama = $lates->bukti;
            if ($bukti_lama) {
                unlink(public_path('img') . '/' . $bukti_lama);
            }

            // Simpan file bukti baru
            $bukti_file = $request->file('bukti');
            $bukti_nama = $bukti_file->hashName();
            $bukti_file->move(public_path('img'), $bukti_nama);

            $DataBaru['bukti'] = $bukti_nama;
        }

        $lates->update($DataBaru);

        // Lates::where('id', $id)->update($DataBaru);

        return redirect()->route('lates.home')->with('success', 'Berhasil mengubah data keterlambatan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lates $lates, $id)
    {
        Lates::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Data Keterlambatan Berhasil Dihapus!');
    }

    public function rekap()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $lates = Lates::all();
                $students = Students::withCount('lates')->get();
                return view('lates.admin.rekap', compact('lates', 'students'));
            } else {
                $rayon = Rayon::where('user_id', Auth::user()->id)->first();
                $students = Students::whereHas('lates')->withCount('lates')->where('rayon_id', $rayon->id)->get();
                return view('lates.ps.rekap', compact('students'));
        
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function keterlambatan()
    {
        $rayon = Rayon::where('user_id', Auth::user()->id)->first();
        $students = Students::where('rayon_id', $rayon->id)->get();
        $lates = Lates::whereHas('students', function ($query) use($rayon) { 
            $query->where('rayon_id', $rayon->id);
            })->get();

        return view('lates.ps.index', compact('lates', 'rayon', 'students'));
    }

    public function print($id){
        $students = Students::findOrFail($id);
        $lates = Lates::with('students')->where('student_id', $id)->get();
        $rombel = Rombel::with('rombel')->where('rombel', $id)->get();
        $rayon = Rayon::with('rayon')->where('rayon', $id)->get();
        return view("lates.admin.print", compact('lates', 'students', 'rombel'));
    }

    public function printps($id){
        $students = Students::findOrFail($id);
        $lates = Lates::with('students')->where('student_id', $id)->get();
        return view("lates.ps.print", compact('lates', 'students'));
    }

    public function downloadPDF($id)
    {
        $lates = Lates::find($id)->toArray();
        view()->share('lates', $lates);

        $students = Students::where('id', $lates['student_id'])->first()->toArray();
        view()->share('students', $students);

        $rayon = Rayon::where('id', $students['rayon_id'])->first()->toArray();
        view()->share('rayon', $rayon);
        
        $rombel = Rombel::where('id', $students['rombel_id'])->first()->toArray();
        view()->share('rombel', $rombel);

        $ps = User::where('id', $rayon['user_id'])->first()->toArray();
        view()->share('ps', $ps);

        $pdf = PDF::loadview('lates.admin.download-pdf', $lates);
        return $pdf->download('suratpernyataan.pdf');
    }

    public function downloadPDFps($id)
    {
        $lates = Lates::find($id)->toArray();
        view()->share('lates', $lates);

        $students = Students::where('id', $lates['student_id'])->first()->toArray();
        view()->share('students', $students);

        $rayon = Rayon::where('id', $students['rayon_id'])->first()->toArray();
        view()->share('rayon', $rayon);
        
        $rombel = Rombel::where('id', $students['rombel_id'])->first()->toArray();
        view()->share('rombel', $rombel);

        $ps = User::where('id', $rayon['user_id'])->first()->toArray();
        view()->share('ps', $ps);

        $pdf = PDF::loadview('lates.ps.download', $lates);
        return $pdf->download('suratpernyataan.pdf');
    }

    public function data()
    {
        $lates = Lates::with('lates')->simplePaginate(5);
        return view("lates.admin.index", compact('lates'));
    }

    public function exportexcel()
    {
        $file_name = 'data_keterlambatan'.'.xlsx';
        return Excel::download(new \App\Exports\LatesExport, $file_name);
    }
}
