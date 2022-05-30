@extends('layouts.app')

@section('header')
    <header class="bg-secondary bg-gradient text-white py-4 mb-4">
        <div class="container px-4 text-center">
            <h1 class="fw-bolder mt-1">{{$article->name}}</h1>    
            <p class="lead">
                {{ $article->description }}
            </p>                 
        </div>
    </header>
@endsection

@section('content')
    <div class="container" style="margin-bottom: 100px">
            <!-- Články -->            
            <div class="col-lg-8 m-auto">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <div class="row">
                        <div class="col-6">
                            <div class="text-muted fst-italic mb-2 hstack gap-3">                                
                                <p>{{ date("d.m.y", strtotime($article->created_at))}}</p>
                                @if ($article->created_at != $article->updated_at)
                                    <p>{{"( Upraveno " . date("d.m.y", strtotime($article->updated_at)) . " )"}}</p>
                                @endif   
                                <p>{{$article->user->name }}</p>                           
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <span class="badge bg-secondary text-decoration-none link-light float-end">{{ $article->category }}</span>
                        </div>                        
                    </div>
                    <!-- Preview image figure-->
                    
                    <!-- Post content-->
                    <section class="mb-4">
                        {!! \Illuminate\Support\Str::markdown($article->text) !!}
                    </section>
                </article>

                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            <!-- Comment form-->
                            <form method="post" action="{{ route('post_comment', ['article' => $article->id ]); }}">
                                @csrf
                                <div class="input-group">                                   
                                    <textarea class="form-control" rows="1" name="comment" placeholder="Přidat komentář..."></textarea>
                                    <input class="btn btn-secondary" type="submit" id="button-addon2" value="Přidat" />
                                </div>
                            </form>
                        </div>
                        @if (count($comments) > 0)
                            <hr class="m-0">
                            <div class="card-body">
                                @foreach ($comments as $comment)
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img class="rounded-circle" src="{{ "https://dummyimage.com/50x50/ced4da/6c757d.jpg&text=" . $comment->GetInitials()}}" alt="..." />
                                        </div>
                                        <div class="ms-3">
                                            <div class="fw-bold">{{ $comment->user->name }}</div>
                                            {{ $comment->text }}
                                        </div>
                                    </div>
                                    @if (!$loop->last)
                                        <hr />
                                    @endif
                                @endforeach
                            </div>
                        @endif

                    </div>
                </section>
            </div>

        </div>
    </div>
@endsection