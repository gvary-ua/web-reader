<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use Illuminate\Http\Request;

class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $covers = Cover::orderBy('created_at', 'desc')->take(3)->get();
        return view('covers.index', compact('covers'));
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
    public function show(int $cover_id)
    {
        $cover = Cover::find($cover_id);

        return view('covers.show', [
            'cover' => $cover
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cover $cover)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cover $cover)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cover $cover)
    {
        //
    }
}
