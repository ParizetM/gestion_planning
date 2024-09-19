<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\motif;
use Illuminate\Http\Request;

class MotifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $motifs = motif::withTrashed()->get();
        return view('motifs.index', ['motifs' => $motifs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('motifs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $motif = new motif();
        $motif->nom = $request->input('nom');
        $motif->description = $request->input('description');
        $motif->is_accessible_salarie = $request->has('is_accessible_salarie') ? 1 : 0;
        $motif->save();
        return redirect()->route('motifs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $motif = motif::withTrashed()->findOrFail($id);
        return view('motifs.show', ['motif' => $motif]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(motif $motif)
    {
        return view('motifs.edit',['motif' => $motif]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, motif $motif)
    {
        $motif->nom = $request->input('nom');
        $motif->description = $request->input('description');
        $motif->is_accessible_salarie = $request->has('is_accessible_salarie') ? 1 : 0;
        $motif->save();
        return redirect()->route('motifs.show',$motif);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motif $motif)
    {
        // Check for related Absence records and handle them
        if ($motif->absences()->count() > 0) {
            session()->put('message', 'Ce motif est utilisé dans des absences');
            return redirect()->route('motifs.show',$motif);
        }
        if ($motif->deleted_at == null) {
            $motif->delete();
        } else {
            $motif->restore();
        }
        return redirect()->route('motifs.index');
    }
}
