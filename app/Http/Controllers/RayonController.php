<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 
use Illuminate\Http\Request;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rayon = Rayon::all();
        $user = User::all();
        return view('rayon.index', compact('rayon', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();

        return view('rayon.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required',            
            'user_id' => 'required',            
        ]);

        Rayon::create([
            'rayon' => $request->rayon,            
            'user_id' => $request->user_id,            
        ]);
        
        return redirect()->route('rayon.home')->with('success', 'Berhasil menambahkan rayon!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rayon $rayon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rayon $rayon, $id)
    {
        $rayon = Rayon::find($id);
        $user = User::all();
        return view('rayon.edit', compact('rayon', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rayon $rayon, $id)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);

        $DataBaru = [
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,           
        ];

        Rayon::where('id', $id)->update($DataBaru);

        return redirect()->route('rayon.home')->with('success', 'Berhasil mengubah data rayon!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rayon $rayon, $id)
    {
        Rayon::where('id',$id)->delete();

        return redirect()->back()->with('deleted', 'data rayon berhasil dihapus!');
    }

    public function dashboard()
    {
        $userRayon = Rayon::where('user_id', Auth::user()->id)->first();
        $rayonStudentCount = Students::where('rayon_id', $userRayon->id)->count();
        $today = Carbon::now()->toDateString();
        $todayLateCount = Lates::whereDate('created_at', $today)
            ->whereIn('student_id', Students::where('rayon_id', $userRayon->id)->pluck('id'))
            ->count();
    
        return view('home.page', compact('rayonStudentCount', 'todayLateCount', 'userRayon'));
    }
}
