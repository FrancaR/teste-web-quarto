@extends('manager.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col d-flex justify-content-between align-items-center mb-4">
            <h3 class="mt-2">Seus anúncios</h3>
            <a href="{{ route('manager.properties.create') }}" class="btn btn-primary">Novo anúncio</a>
        </div>
        <div class="col-md-12">

            <div class="card-columns">
            @foreach($properties as $property)
                <div class="card">
                    @if($property->photos)
                    <img src="{{ $property->photos->first()->url ?? '' }}" alt="{{ $property->photos->first()->title ?? '' }}" class="card card-img-top">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $property->price }}</h6>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($property->description, 80) }}</p>
                        <a href="{{ route('manager.properties.show', $property->id) }}" class="card-link">Saiba mais</a>
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
