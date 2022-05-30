@extends('layouts.app')

@section('header')
    <header class="bg-secondary bg-gradient text-white py-5 mb-4">
        <div class="container px-4 text-center">
            <h1 class="fw-bolder">Dokumentace PilaSystému</h1>           
            <p class="lead">
                Znalostní báze aplikace obsahující jak technické údaje, tak i praktické postupy.  
            </p>   
          
            @if (Auth::user()->admin == true)
                <div class="btn-group" style="width: 350">
                    <a class="btn btn-lg btn-light btn-outline-success mt-2" style="width: 110px" href="{{ route('news') }}">Novinky</a> 
                    <a class="btn btn-lg btn-light btn-outline-primary mt-2" style="width: 110px" href="{{ route('home') }}">Úvod</a> 
                    <a class="btn btn-lg btn-light btn-outline-secondary mt-2 text-nowrap" style="width: 130px" href="{{ route('NewArticle') }}">Nový článek</a>
                </div>                   
            @else
                <div class="btn-group" style="width: 300">
                    <a class="btn btn-lg btn-light btn-outline-success mt-2" style="width: 150px" href="{{ route('news') }}">Novinky</a> 
                    <a class="btn btn-lg btn-light btn-outline-primary mt-2" style="width: 150px" href="{{ route('home') }}">Úvod</a> 
                </div>   
            @endif
        </div>
    </header>
@endsection

@section('content')

    <div class="container" style="margin-bottom: 60px">
        <div class="row">
            <!-- Side widgets-->
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-12">
                        <!-- Search widget-->
                        <div class="card mb-4">
                            <div class="card-header">
                                Hledat
                                @isset($search_reset)
                                    <a class="text-reset float-end inline-link" href="{{ route('docs') }}">Zrušit filtry 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                        </svg>
                                    </a>
                                @endisset 
                            </div>
                            <div class="card-body">
                                <form action="{{ route('docs_search'); }}" method="post">
                                    @csrf
                                    <div class="input-group">
                                        @if (isset($search_reset))
                                            <input class="form-control" name="term" type="text" value="{{ $search_reset }}" placeholder="Hledaný výraz..." aria-label="Enter search term..." aria-describedby="button-search" />
                                        @else
                                            <input class="form-control" name="term" type="text" placeholder="Hledaný výraz..." aria-label="Enter search term..." aria-describedby="button-search" />
                                        @endif
                                        
                                        <input type="submit" class="btn btn-primary" value="Najít">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-12">
                        <!-- Categories widget-->
                        <div class="card mb-4">
                            <div class="card-header">
                                Kategorie

                                @isset($cat_reset)
                                    <a class="text-reset float-end inline-link" href="{{ route('docs') }}">Zrušit filtry 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                        </svg>
                                    </a>
                                @endisset                      
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="list-unstyled mb-0">
                                            @for ($i = 0; $i < count($categories); $i += 2)
                                                <li><a href="{{ route('docs_cat', ['category' => $categories[$i]]) }}">{{ $categories[$i] }}</a></li>
                                            @endfor
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="list-unstyled mb-0">
                                            @for ($i = 1; $i < count($categories); $i += 2)
                                                <li><a href="{{ route('docs_cat', ['category' => $categories[$i]]) }}">{{ $categories[$i] }}</a></li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side widget-->
                <div class="card border-success mb-4" style="cursor: pointer;" onclick="window.location='{{ route('news') }}'">
                    <div class="card-header">
                        Poslední aktualizace

                        <svg height="16" width="16" class="blinking float-end mt-1">
                            <circle cx="8" cy="8" r="7" fill="green" />
                            Sorry, your browser does not support inline SVG.  
                        </svg> 
                    </div>
                    @foreach ($novinky as $novinka)
                        <div class="card-body">
                            <p class="accordion-header" id="headingOne">                          
                                <strong class="me-3">{{ $novinka->date }}</strong> 
                                <br />
                                {{ $novinka->message }}                           
                            </p>
                        </div>
                        @if (!$loop->last)
                            <hr class="m-0">
                        @endif
                        
                    @endforeach                    
                </div>
            </div>

            <!-- Články -->
            <div class="col-lg-8">               
                @foreach ($articles as $item)
                <div class="card mb-3" style="cursor: pointer;" onclick="window.location='{{ route('article_detail', ['article' => $item->id ]) }}'">                    
                    <div class="card-body">
                        <div class="small text-muted">{{ $item->category }}</div>
                        <h2 class="card-title">{{ $item->name }}</h2>
                        <p class="card-text">{{ $item->description }}</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between">
                            <p class="mb-auto mt-auto text-muted">Komentáře {{ "(" . strval(count($item->comments)) . ")" }}</p>

                            @if (Auth::user()->admin == true)
                                <div class="btn-group float-end">
                                    <a class="btn btn-sm btn-primary" href="{{ route('editarticle', ['article' => $item->id ]) }}">Upravit</a>
                                    <a class="btn btn-sm btn-danger" href="{{ route('deletearticle', ['article' => $item->id ]) }}">Smazat</a>
                                </div>
                            @endif
                        </div>
                        
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    
@endsection

