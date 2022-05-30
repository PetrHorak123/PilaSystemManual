@extends('layouts.app')

@section('header')
    <header class="bg-secondary bg-gradient text-white py-4 mb-4">
        <div class="container px-4 text-center">
            <h1 class="fw-bolder">Úprava článku</h1>                     
        </div>
    </header>
@endsection

@section('content')
    <div class="container" style="margin-bottom: 70px">
        <form method="POST" action="{{ route('post_edited_article', ['article' => $article->id]) }}" class="w-75 m-auto" id="editPostForm">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <h3 class="mt-1">Název</h3> 
                </div>
                <div class="col-md-9">
                    <div class="input-group">
                        <input name="name" type="text" class="form-control" placeholder="Název článku" id="name" value="{{ $article->name }}">
                    </div>                       
                </div>             
            </div>
            <hr />

            <div class="row mb-3">
                <div class="col-md-3">
                    <h3 class="mt-1">Kategorie</h3> 
                </div>
                <div class="col-md-9">
                    <div class="input-group">
                        <select class="form-select" aria-label="Default select example" name="category"">
                            <option value="Základní informace" @php if($article->category == "Základní informace") echo "selected"; @endphp>Základní informace</option>
                            <option value="Technické údaje" @php if($article->category == "Technické údaje") echo "selected"; @endphp>Technické údaje</option>
                            <option value="Postupy" @php if($article->category == "Postupy") echo "selected"; @endphp>Postupy</option>
                            <option value="Ostatní" @php if($article->category == "Ostatní") echo "selected"; @endphp>Ostatní</option>
                        </select>
                    </div>                       
                </div>             
            </div>
            <hr />

            <div class="row mb-3">
                <div class="col-md-3">
                    <h3 class="mt-1">Popis</h3> 
                </div>
                <div class="col-md-9">
                    <div class="input-group">
                        <input name="popis" type="text" class="form-control" placeholder="Popis článku" value="{{ $article->description }}">
                    </div>                       
                </div>             
            </div>
            <hr />

            <div class="row mb-3">
                <div class="col-md-12 text-center">
                    <h3 class="mt-1">Text</h3> 
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <div id="editor" class="mt-1 w-100 block w-full rounded-md border-gray-300 shadow-sm"></div>
                                                    
                        <input type="hidden" id="oldContent" value="{{ $article->text }}">
                        <input type="hidden" name="content" id="content" />
                    </div>                       
                </div>             
            </div>
            <div class="row w-25 m-auto mt-4">
                <div class="btn-group w-100">
                    <input type="submit" value="Upravit" class="btn btn-primary w-50" />
                    <a class="btn btn-outline-primary w-50" href="{{ route('docs') }}">Zpět</a>
                </div>        
            </div>
        </form>


    </div>
@endsection

@section('scripts')

@endsection