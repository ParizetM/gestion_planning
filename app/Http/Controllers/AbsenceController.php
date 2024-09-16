<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Absence $absence)
    {
        $absence = Absence::with(['user', 'motif'])->findOrFail($absence->id);

        // Renvoyer la réponse en JSON avec les informations de l'absence et ses relations
        return response()->json([
            'id' => $absence->id,
            'user' => [
            'id' => $absence->user->id,
            'nom' => $absence->user->nom,
            'prenom' => $absence->user->prenom,
            ],
            'motif' => [
            'id' => $absence->motif->id,
            'nom'=> $absence->motif->nom,
            'description' => $absence->motif->description,
            ],
            'date_debut' => $absence->date_debut,
            'date_fin' => $absence->date_fin,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absence $absence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absence $absence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absence $absence)
    {
        //
    }
}
