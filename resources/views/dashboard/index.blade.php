@extends('layouts.app')

@section('content')
<div class="container mt-5">

	@if(session('message'))
	<div class="row">
		<div class="col-1"></div>
		<div class="col-10" align="center">
			<div class="alert alert-info alert-dismissible fade show" role="alert">
			  {{ session('message') }}
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		</div>
		<div class="col-1"></div>
	</div>
	@endif

	@if($carros->isEmpty())
	<div class="row mt-5">
			<div class="col" align="center">
				<h1 class="my-5">Não há veículos registrados</h1>
				<a href="{{ route('buscar') }}"><button class="btn btn-outline-dark">Buscar veículos</button></a>
			</div>
		</div>
	@endif

	<!-- Cards de carros -->

	@foreach($carros as $carro)
	<div class="row mb-5">
		<div class="col-1"></div>
		<div class="col-10">
			<div class="card">
			  <div class="card-body">
			    <div class="row">

			    	<!-- Imagem -->
			    	<div class="col-4">
			    		<img class="figure-img img-fluid rounded" src="{{ $carro->link }}">
			    	</div>
			    	<div class="col-8">

			    		<!-- Título -->
			    		<div class="row">
			    			<div class="col">
			    				<h3>{{$carro->nome_veiculo}}</h3>
			    			</div>
			    		</div>

			    		<!-- Campos de informações -->
			    		<div class="row mt-2">
			    			<div class="col">
			    				<input class="form-control" type="text" placeholder="Ano" aria-label="Disabled input example" value="{{ $carro->ano }}" disabled>
			    			</div>
			    			<div class="col">
			    				<input class="form-control" type="text" placeholder="Quilometragem" aria-label="Disabled input example" value="{{ $carro->quilometragem }}" disabled>
			    			</div>
			    		</div>
			    		<div class="row mt-2">
			    			<div class="col">
			    				<input class="form-control" type="text" placeholder="Combustível" aria-label="Disabled input example" value="{{ $carro->combustivel }}" disabled>
			    			</div>
			    			<div class="col">
			    				<input class="form-control" type="text" placeholder="Câmbio" aria-label="Disabled input example" value="{{ $carro->cambio }}" disabled>
			    			</div>
			    		</div>
			    		<div class="row mt-2">
			    			<div class="col">
			    				<input class="form-control" type="text" placeholder="Portas" aria-label="Disabled input example" value="{{ $carro->portas }}" disabled>
			    			</div>
			    			<div class="col">
			    				<input class="form-control"  type="text" placeholder="Cor" aria-label="Disabled input example" value="{{ $carro->cor }}" disabled>
			    			</div>
			    		</div>
			    	</div>
			    </div>
			  </div>
			   @if(isset(Auth::user()->id) && Auth::user()->id == $carro->user_id)
			  <div class="card-footer text-muted">
			    <form class="" action="/deletar/{{$carro->id}}">
			    	@csrf
			    	<button class="btn btn-outline-danger">Deletar</button>
			    </form>
			  </div>
			  @endif
			</div>
		</div>
		<div class="col-1"></div>
	</div>
	@endforeach
		
</div>
@endsection