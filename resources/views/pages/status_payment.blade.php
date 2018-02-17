@extends('layout')

@section('content')
  <div class="jumbotron mt-4">
    <div class="row">
        <div class="w-100">
            <h1 class="display-5">Status do Pagamento</h1>
        </div>
    </div>
    <div class="row">
        <div class="w-100">
          <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                      <label>Forma de Pagamento:</label>
                      <span id="type-text">Aguarde...</span>
                  </div>
                  <div class="col-md-4">
                      <label>Preço:</label>
                      <span id="amount-text">Aguarde...</span>
                  </div>
                  <div class="col-md-5">
                      <label>Status do Pagamento:</label>
                      <span class="badge badge-info" id="status-payment-text">Aguarde...</span>
                  </div>
                </div>
                <div class="row mt-4" id="boleto-group">
                    <div class="col-md-3 offset-4">
                        <h3>Número do Boleto</h3>
                        <h4 class="text-center" id="numero-boleto">Aguarde...</h4>
                    </div>

                </div>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection
