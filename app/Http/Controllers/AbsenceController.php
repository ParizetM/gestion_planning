<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbsencesRequest;
use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $absences = Absence::withTrashed()->with(['user', 'motif'])->get();

        return view('absences.index', ['absences' => $absences]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $motifs = motif::all();
        $users = User::all();

        return view('absences.create', [
            'motifs' => $motifs,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AbsencesRequest $request)
    {
        $absence = new Absence();
        $absence->user()->associate($request->input('user_id'));
        $absence->motif()->associate($request->input('motif_id'));
        $absence->date_debut = $request->input('date_debut');
        $absence->date_fin = $request->input('date_fin');
        $absence->save();

        return redirect()->route('absences.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        $absence = Absence::withTrashed()->with(['user', 'motif'])->findOrFail($id);

        // $reponse = [
        //     'id' => $absence->id,
        //     'user' => [
        //     'id' => $absence->user->id,
        //     'nom' => $absence->user->nom,
        //     'prenom' => $absence->user->prenom,
        //     ],
        //     'motif' => [
        //     'id' => $absence->motif->id,
        //     'nom'=> $absence->motif->nom,
        //     'description' => $absence->motif->description,
        //     ],
        //     'date_debut' => $absence->date_debut,
        //     'date_fin' => $absence->date_fin,
        // ];
        return view('absences.show', ['absence' => $absence]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $absence = Absence::withTrashed()->with(['user', 'motif'])->findOrFail($id);

        $users = User::all();
        $motifs = Motif::all();

        return view('absences.edit', [
            'absence' => $absence,
            'users' => $users,
            'motifs' => $motifs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AbsencesRequest $request, Absence $absence)
    {
        $absence->user()->associate($request->input('user_id'));
        $absence->motif()->associate($request->input('motif_id'));
        $absence->date_debut = $request->input('date_debut');
        $absence->date_fin = $request->input('date_fin');
        $absence->save();

        return redirect()->route('absences.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $absence = Absence::withTrashed()->with(['user', 'motif'])->findOrFail($id);
        $absence->delete();

        return redirect()->route('absences.index');
    }
}
