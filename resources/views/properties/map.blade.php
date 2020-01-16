@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Você está em: <a href="{{ route('properties.index') }}">Anúncios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mapa</li>
                </ol>
            </nav>
        </div>
        
        <div class="col">
            <maps
                class="col"
                style="height:400px"
                :center="{lat:0,lng:0}"
                :zoom="1"
                :markers="{{ collect($properties) }}"
            />
        </div>
    </div>
</div>
@endsection
