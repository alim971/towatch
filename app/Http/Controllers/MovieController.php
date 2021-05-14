<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if(session('only_not_watched', "false") == "true") {
            $movies = $user->movies()->where('watched', false)->orderBy('order')->paginate(4);
        } else {
            $movies = $user->movies()->orderBy('order')->paginate(4);
        }
        return view('home', ['movies' => $movies]);
    }
    public function only(Request $request)
    {
        session(['only_not_watched' => $request->input('only')]);
        return redirect()->route('index');
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
        foreach(Auth::user()->movies as $movie) {
            $movie->order += 1;
            $movie->save();
        }
        $next_order =  1;
        $request->request->add(['order' => $next_order]);
        Movie::create($request->all());
//        return view('home', ['movies' => $movies]);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movies.edit', ['movie' => $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', ['movie' => $movie]);
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
        $next_order =  1;
        foreach(Auth::user()->movies as $movie) {
            $movie->order += 1;
            $movie->save();
        }
        $request->request->add(['order' => $next_order]);
        $movie->update($request->all());
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        foreach(Auth::user()->movies()->where('order', ">=", $movie->order)->get() as $movieT) {
            $movieT->order -= 1;
            $movieT->update();
        }
        $movie->delete();
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function watch(Movie $movie)
    {
        $movie->watched = !$movie->watched;
        $movie->update();
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function up(Movie $movie)
    {
        foreach(Auth::user()->movies()->where('order', "<=", $movie->order)->get() as $movieT) {
            $movieT->order += 1;
            $movieT->update();
        }
        $movie->order = 1;
        $movie->update();
        return redirect()->route('index');
    }
}
