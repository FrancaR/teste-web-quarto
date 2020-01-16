@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Anúncios</li>
            </ol>
        </nav>

            <div class="card-columns">
            @foreach($properties as $property)
                <div class="card">
                    <img src="{{ $property->photos()->first()->url ?? '' }}" alt="{{ $property->photos()->first()->title ?? '' }}" class="card card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $property->price }}</h6>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($property->description, 80) }}</p>
                        <a href="{{ route('properties.show', $property->id) }}" class="card-link">Saiba mais</a>
                    </div>
                </div>
            @endforeach
            </div>

            <div>
                {{ $properties->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
