@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Você está em: <a href="{{ route('properties.index') }}">Anúncios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div id="slideshow" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                        @for($i = 0; $i < $property->photos->count(); $i++)
                            <li data-target="#slideshow" data-slide-to="{{ $i }}" @if($i === 0)class="active"@endif></li>
                        @endfor
                        </ol>
                        <div class="carousel-inner">
                        @foreach($property->photos as $photo)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <img src="{{ $photo->url }}" class="d-block w-100" alt="{{ $photo->title }}" width="800" height="400">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $photo->title }}</h5>
                                    <p>{{ $photo->description }}</p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#slideshow" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#slideshow" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <h3>{{ $property->title }}</h3>
                    <p>{{ $property->description }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>
                        <strong>{{ $property->price }}</strong>
                    </h3>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    Localização
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <maps
                            class="col"
                            style="height:300px"
                            :center="{{ $property->positions }}"
                            :markers="{{ collect([['position' => $property->positions, 'infoText' => $property->title]]) }}"
                            :zoom="16"
                        />
                    </div>
                    <h5 class="card-title">{{ $property->address }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $property->city . ', ' . $property->state }}</h6>
                </div>
            </div>
        
            <div class="card mb-4">
                <div class="card-header">
                    Anunciante
                </div>

                <div class="card-body">
                    <strong>{{ $property->owner->name }}</strong><br>
                    {{ $property->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
