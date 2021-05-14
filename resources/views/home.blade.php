@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Movies</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="text-center" style="margin-bottom: 15px; font-size: 1.85rem">
                        Only not watched:
                        <input type="checkbox" id="not_watched" class="js-switch" {{session('only_not_watched', false) == "true" ? "checked" : ""}}
                        value="1">
                    </div>
                        @forelse($movies as $movie)
                            <div class="text-center">
                                <h2 style="display: inline-block" data-toggle="collapse" class="collapsed mar-20 col-md-7 text-md-left"
                                    href="#collapse{{$movie->id}}" aria-expanded="true"
                                    aria-controls="collapse{{$movie->id}}">
                                    {{$movie->name}}
                                    <i class="fa fa-chevron-circle-down cursor"></i>
                                </h2>
                                <form  action="{{ route('movies.destroy', $movie) }}" class="inline mar-20 col-md-6" style="margin-left: 15px" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-warning" href="{{ route('movies.edit', $movie) }}"><i class="fa fa-pencil"></i></a>
                                    @if($movie->watched)
                                        <a href="{{ route('movies.watch', $movie) }}" class="btn btn-danger"><i class="fa fa-eye-slash"></i></a>
                                    @else
                                        <a href="{{ route('movies.watch', $movie) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                    @endif
                                    @if($movie->order != 1)
                                    <a href="{{ route('movies.up', $movie) }}" class="btn btn-primary"><i class="fa fa-sort-up"></i></a>
                                    @else
                                        <a href="" class="disabled btn btn-info"><i class="fa fa-sort-up"></i></a>
                                    @endif
                                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                </form>
                                <div class="collapse ml-16" id="collapse{{$movie->id}}">
                                    <div class="row">
                                        <label class="col-md-4 col-form-label text-md-right">Description</label>
                                        <div class="col-md-6">
                                            {{$movie->description}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-4 col-form-label text-md-right">Url</label>
                                        <div class="col-md-6">
                                            <a class="a" href="{{$movie->url}}" target="_blank">{{$movie->url}}</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-4 col-form-label text-md-right">Review</label>
                                        <div class="col-md-6">
                                            <a class="a" href="{{$movie->imdb}}" target="_blank">{{$movie->imdb}}</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-4 col-form-label text-md-right">Watched</label>
                                        <div class="col-md-6">
                                            @if($movie->watched)
                                                <i class="fa fa-check" style="font-size:48px;color:green"></i>
                                            @else
                                                <i class="fa fa-close" style="font-size:48px;color:red"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center">
                                No movies yet
                            </div>
                        @endforelse
                        @if($movies->hasPages())
                            <div class="flex justify-center">

                                <div style="margin-top: 25px; position: relative; left: {{45 - 2*$movies->lastPage()}}%" class="text-center">
                                    {{ $movies->links("pagination::bootstrap-4") }}
                                </div>
                            </div>
                        @endif
                        <div class="text-center">
                            <a href="{{ route('movies.create') }}" class="btn btn-primary mt-3">
                                Add a movie
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
