<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotifRequest;
use App\Models\Motif;
use Cache;
use App\Repositories\MotifsRepository;

class MotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $motifs = Cache::remember('motifs', 3600, function () {
            return motif::withTrashed()->get();
        });

        return view('motifs.index', ['motifs' => $motifs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('motifs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MotifRequest $request)
    {
        $motif = new motif();
        $motif->nom = $request->input('nom');
        $motif->description = $request->input('description');
        $motif->is_accessible_salarie = $request->has('is_accessible_salarie') ? 1 : 0;
        $motif->save();
        Cache::forget('motifs');

        return redirect()->route('motifs.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        $motif = motif::withTrashed()->findOrFail($id);

        return view('motifs.show', ['motif' => $motif]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $motif = motif::withTrashed()->findOrFail($id);

        return view('motifs.edit', ['motif' => $motif]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MotifRequest $request, int $id)
    {
        $motif = motif::withTrashed()->findOrFail($id);
        $motif->nom = $request->input('nom');
        $motif->description = $request->input('description');
        $motif->is_accessible_salarie = $request->has('is_accessible_salarie') ? 1 : 0;
        $motif->save();

        return redirect()->route('motifs.show', $motif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Motif $motif)
    {
        // Check for related Absence records and handle them
        if ($motif->absences()->count() > 0) {
            session()->flash('message_erreur', 'Ce motif est utilisé dans des absences');

            return redirect()->route('motifs.show', $motif);
        }
        if ($motif->deleted_at === null) {
            $motif->delete();
        } else {
            $motif->restore();
        }

        return redirect()->route('motifs.index');
    }
}
