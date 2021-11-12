@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row mt-5">
    <div class="col" align="center">
      <h1>Login</h1>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col"></div>

    <div class="col">
      
      <!-- Mensagem de erro caso algum campo não seja preenchido -->
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

      <!-- Mensagem de erro de autenticação -->
      @if(session('danger'))
      <div class="row">
        <div class="col">
          <div class="alert alert-danger">
            <ul>
                <li>{{session('danger')}}</li>
            </ul>
          </div>
        </div>
      </div>
      @endif

      <form action="{{ route('auth.user') }}" method="post">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input type="password" name="password" class="form-control" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
      </form>
    </div>

    <div class="col"></div>
  </div>
</div>
@endsection