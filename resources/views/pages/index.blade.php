@extends('layout')

@section('content')
  <div class="jumbotron mt-4">
    <div class="row">
        <div class="w-100">
            <h1 class="display-4">Checkout</h1>
            <p class="lead">Preencha os campos abaixo e siga o próximo passo para conclusão do pagamento. </p>
        </div>
    </div>
    <div class="row">
        <div class="w-100">
          <div class="card">
            <div class="card-body">
              <form autocomplete="off" id="newBuyer">
                <input type="hidden" name="client_id" id="client_id" value="1">
                <div class="form-group">
                  <label for="name">Nome Completo</label>
                  <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group">
                  <label for="email">E-mail</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="form-group">
                  <label for="cpf">CPF</label>
                  <input type="text" class="form-control cpf" name="cpf" id="cpf" required>
                </div>
                <button type="submit" class="btn btn-success">Próximo Passo</button>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection
