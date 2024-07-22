<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cover $cover)
    {
        return view('books.show', ['cover' => $cover]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cover $cover)
    {
        Gate::authorize('update', $cover);

        return view('books.edit', ['cover' => $cover]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cover $cover)
    {
        Gate::authorize('update', $cover);

        return Redirect::route('profile.books.index')->with('status', 'Book updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cover $cover)
    {
        Gate::authorize('delete', $cover);

        return Redirect::route('profile.books.index')->with('status', 'Book deleted!');
    }
}
