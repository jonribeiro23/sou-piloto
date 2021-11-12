@extends('layouts.app')

@section('content')
<div class="row my-5">
	<div class="col"></div>
		<div class="col">

			<!-- Mensagem de erro caso o modelo não seja preenchido -->
			@if($errors->any())
			<div class="row">
				<div class="col">
					<div class="alert alert-danger">
						<ul>
						@foreach($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
						</ul>
					</div>
				</div>
			</div>
			@endif

			<!-- Mensagem de erro -->
			@if(session('message'))
			<div class="row">
				<div class="col">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  {{ session('message') }}
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				</div>
			</div>
			@endif

			<h2 class="my-2">Procure por um modelo</h2>
			<form class="input-group my-3" method="post" action="{{ route('capturar') }}">
				@csrf
				<input type="text" name="modelo" class="form-control" placeholder="Ex: Audi" aria-label="" aria-describedby="button-addon2">
				<button class="btn btn-outline-secondary" type="submit" id="button-addon2">Procurar</button>
			</form>
		</div>
	<div class="col"></div>
</div>
@endsection