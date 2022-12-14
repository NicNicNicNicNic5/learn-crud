<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'genre' => 'required|max:100',
            'description' => '',
            'year' => 'required|integer|min:1900|max:2099',
            'rating' => 'required|numeric|min:0|max:5'
        ];

        $validated = $request->validate($rules);

        //teknik eloquent
        // $newMovie = new Movie();
        // $newMovie->title = $validated['title'];
        // $newMovie->genre = $validated['genre'];
        // $newMovie->description = $validated['description'];
        // $newMovie->year = $validated['year'];
        // $newMovie->rating = $validated['rating'];
        // $newMovie->save();

        //teknik mass assignment
        Movie::create($validated);

        //teknik eloquent
        // return "Film baru yang berjudul $newMovie->title sudah disimpan.";

        //teknik mass assignment
        // return "Film baru yang berjudul {$validated['title']} sudah disimpan.";
        //teknik mass assignment -> redirect
        $request->session()->flash('success', "Film yang berjudul {$validated['title']} sudah berhasil ditambahkan.");
        return redirect()->route('movies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $rules = [
            'title' => 'required|max:255',
            'genre' => 'required|max:100',
            'description' => '',
            'year' => 'required|integer|min:1900|max:2099',
            'rating' => 'required|numeric|min:0|max:5'
        ];

        $validated = $request->validate($rules);

        //teknik mass assignment
        $movie->update($validated);

        //flash data
        $request->session()->flash('success', "Berhasil memperbarui data film {$validated['title']}.");

        return redirect()->route('movies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success', "Data film {$movie['title']} sudah dihapus.");
    }
}
