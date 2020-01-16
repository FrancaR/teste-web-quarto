@extends('manager.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Você está em: <a href="{{ route('manager.properties.index') }}">Seus anúncios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Novo anúncio</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Novo anúncio</h5>
                    <p class="card-text">Crie um anúncio para seu imóvel.</p>
                    <form method="POST" action="{{ route('manager.properties.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Título do meu anúncio" value="{{ old('title') }}">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Descrição do meu imóvel, contendo o tamanho do ambiente, a quantidade de quartos, banheiros, e muito mais.">{{ old('description') }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="price">Preço</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">R$</div>
                                    </div>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="0,00" value="{{ old('price') }}">
                                </div>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="address">Endereço</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Av. Paulista, 1234" value="{{ old('address') }}">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="neighborhood">Bairro</label>
                                <input type="text" class="form-control @error('neighborhood') is-invalid @enderror" id="neighborhood" name="neighborhood" placeholder="Centro" value="{{ old('neighborhood') }}">

                                @error('neighborhood')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="city">Cidade</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="São Paulo" value="{{ old('city') }}">
                                
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="state">Estado</label>
                                <select id="state" name="state" class="form-control @error('state') is-invalid @enderror">
                                    <option value="" selected>Escolha...</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="SP">São Paulo</option>
                                </select>

                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="postcode">CEP</label>
                                <input type="text" class="form-control @error('postcode') is-invalid @enderror" id="postcode" name="postcode" maxlength="10" placeholder="12.345-678" value="{{ old('postcode') }}">

                                @error('postcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar e publicar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
