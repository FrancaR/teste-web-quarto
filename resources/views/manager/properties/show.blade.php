@extends('manager.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Você está em: <a href="{{ route('manager.properties.index') }}">Seus anúncios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6>Imagens</h6>
                    @if($property->photos->count())
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
                    @else
                    <div class="alert alert-danger" role="alert">
                        Você não anexou nenhuma imagem ainda.
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    <h6>Informações do anúncio</h6>
                    <h3>{{ $property->title }}</h3>
                    <p>{{ $property->description }}</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <form action="{{ route('manager.properties.photos', $property->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h5>Anexar foto</h5>
                        <p>Caso deseje anexar fotos ao seu anúncio, faça aqui.</p>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="photos[]" id="photo" multiple required>
                            <label class="custom-file-label" for="photo">Escolha o(s) arquivo(s)...</label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <span class="badge badge-success">Publicado</span>
                    <h3>
                        <strong>{{ $property->price }}</strong>
                    </h3>

                    <a class="btn btn-danger" href="{{ route('manager.properties.destroy', $property->id) }}"
                        onclick="event.preventDefault();
                                        document.getElementById('destroy-property-form').submit();">
                        Excluir Anúncio
                    </a>

                    <form id="destroy-property-form" action="{{ route('manager.properties.destroy', $property->id) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
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
        </div>
    </div>
</div>
@endsection
