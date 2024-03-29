<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rombel = Rombel::all();
        return view('rombel.index', compact('rombel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rombel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rombel' => 'required',            
        ]);

        Rombel::create([
            'rombel' => $request->rombel,            
        ]);
        
        return redirect()->route('rombel.home')->with('success', 'Berhasil menambahkan rombel!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rombel $rombel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rombel $rombel, $id)
    {
        $rombel = Rombel::find($id);

        return view('rombel.edit', compact('rombel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rombel $rombel, $id)
    {
        $request->validate([
            'rombel' => 'required',

        ]);

        $DataBaru = [
            'rombel' => $request->rombel,           
        ];

        Rombel::where('id', $id)->update($DataBaru);

        return redirect()->route('rombel.home')->with('success', 'Berhasil mengubah data rombel!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rombel $rombel, $id)
    {
        Rombel::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function search(Request $request, $class)
    {
        $class = $request->get('rombel');
        $rombel = Rombel::where('rombel', 'LIKE', '%' . $class . '%')->simplePaginate(10);

        return view('rombel.index', compact('rombel'));
    }
}
