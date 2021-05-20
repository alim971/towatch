@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('index')}}" class="btn btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        Add movie
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('movies.update', $movie) }}">
                            @csrf
                            @method('PUT')
                            <div class="" style="margin-bottom: 25px; text-align: center">
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i></button>
                                <a href="{{ route('index') }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                            </div>
                            <input type="hidden" name="user_id" value="{{ $movie->user_id }}">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $movie->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description', $movie->description) }}"  autocomplete="description">

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="url" class="col-md-4 col-form-label text-md-right">Url</label>

                                <div class="col-md-6">
                                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url', $movie->url) }}" autocomplete="url">

                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="imdb" class="col-md-4 col-form-label text-md-right">IMBD/CSFD</label>

                                <div class="col-md-6">
                                    <input id="imdb" type="text" class="form-control @error('imdb') is-invalid @enderror" name="imdb" value="{{ old('imdb', $movie->imdb) }}" autocomplete="imdb">
                                </div>
                                @error('imdb')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="imbd" class="col-md-4 col-form-label text-md-right">Watched</label>

                                <div class="col-md-6">
                                    <input type="hidden" name="watched" value="0">
                                    <input id="watched" type="checkbox" {{( old('watched', $movie->watched) ? "checked" : "" )}} class="js-switch form-control @error('watched') is-invalid @enderror" name="watched" value="1">
                                </div>
                                @error('watched')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
