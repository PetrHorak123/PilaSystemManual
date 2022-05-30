@extends('layouts.app')

@section('header')
    <header class="bg-success bg-gradient text-white py-5 mb-4">
        <div class="container px-4 text-center">
            <h1 class="fw-bolder">Novinky v PilaSystému</h1>           
            <p class="lead">
                Kompletní přehled aktualizací aplikace    
            </p>   
            
            <div class="btn-group" style="width: 300">
                <a class="btn btn-lg btn-light btn-outline-secondary mt-2" style="width: 150px" href="{{ route('docs') }}">Dokumentace</a> 
                <a class="btn btn-lg btn-light btn-outline-primary mt-2" style="width: 150px" href="{{ route('home') }}">Úvod</a> 
            </div>  
        </div>
    </header>
@endsection

@section('content')
    <div class="container" style="margin-bottom: 70px">
        <div class="accordion" id="accordionExample">

            @foreach ($commits as $commit)

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="{{ "#id" . strval($loop->index) }}" aria-expanded="true" aria-controls="{{ "id" . strval($loop->index) }}">
                            <strong class="me-3">{{ $commit->date }}</strong> {{ $commit->message }}
                        </button>
                    </h2>
                    <div id="{{ "id" . strval($loop->index) }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-sm-2 text-center">
                                    <strong>Autor změny:</strong>                       
                                </div>
                                <div class="col-sm-4">
                                    <p class="text-center float-sm-start">{{ $commit->author }}</p>                                                    
                                </div>
                                <div class="col-sm-2 text-center">
                                    <strong>GitHub:</strong>                       
                                </div>
                                <div class="col-sm-4">
                                    <p class="text-center float-sm-start">
                                        <a href="{{ $commit->url }}" class="text-reset inline-link" style="text-underline-offset: 0.3em">
                                            {{ substr($commit->sha, 0, 7) }}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-box-arrow-up-right mb-1" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                                                <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                                            </svg>
                                        </a>  
                                    </p>                                               
                                </div>
                            
                                <hr />
                                <div class="col-sm-2 d-flex align-items-center">
                                    <strong class="w-100 text-center">Popis změn:</strong>
                                </div>
                                <div class="col-sm-10">
                                    @if (Auth::user()->admin == true)
                                        <form method="POST" action="{{ route('post_news_desc') }}">
                                            @csrf
                                            <input type="hidden" name="sha" value="{{ $commit->sha }}">

                                            <div class="row d-flex align-items-center"> 
                                                <div class="form-group col-sm-9">
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="description" value>{{ $commit->desc }}</textarea>
                                                </div>

                                                <div class="form-group col-sm-3 text-center">
                                                    <input type="submit" name="send" value="Potvrdit" class="btn btn-dark btn-block">        
                                                </div>
                                            </div>                                         
                                        </form>
                                    @else
                                        {{ $commit->desc }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

            @endforeach

        
        </div>
    </div>



@endsection

