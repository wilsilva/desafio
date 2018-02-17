@extends('layout')

@section('content')
<div class="jumbotron mt-4">
    <div class="row">
        <div class="w-100">
            <h1 class="display-4">Checkout</h1>
            <p class="lead"><small>Para finalização do pagamento informe os dados abaixo, selecionando o tipo de pagamento desejado.</small></p>
            <div class="alert alert-success" id="alert-message" role="alert">
			  <span id="message-succes-payment">Pagamento realizado com sucesso.</span><br>
			  <small>Para visualizar o status do pagamento clique neste <strong><a href="/payment/status">link</a></strong>.</small>
			</div>
        </div>
    </div>
    <div class="row">
        <div class="w-100">
          <div class="card">
            <div class="card-body">
				<ul class="nav nav-tabs" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" data-toggle="tab" href="#card" role="tab">Cartão de Crédito</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" data-toggle="tab" href="#boleto" role="tab">Boleto</a>
				  </li>
				</ul>
				<div class="tab-content">
				  	<div class="tab-pane active" id="card" role="tabpanel">
						<form autocomplete="off" id="payment-card">
			                <input type="hidden" name="client_id" id="client_id" value="1">
			                <div class="row mt-4">
			                	<div class="col-md-8">
			                		<div class="form-group">
					                  <label for="holder_name">Nome no Cartão de Crédito</label>
					                  <input type="text" class="form-control" required name="holder_name" id="holder_name" required>
					                </div>
			                	</div>
			                	<div class="col-md-4">
								      <label for="amount">Valor á ser pago</label>
								      <div class="input-group">
								        <div class="input-group-prepend">
								          <div class="input-group-text">R$</div>
								        </div>
								        <input type="text" class="form-control amount" required id="amount" placeholder="00,00">
								    </div>
			                	</div>
			                </div>
			                <div class="row">
			                	<div class="col-md-6">
			                		<div class="row">
			                			<div class="col-md-10">
			                				<div class="form-group">
							                  <label for="card_number">Número do Cartão</label>
							                  <input type="number" class="form-control" required name="card_number" id="card_number" required>
							                </div>
			                			</div>
			                			<div class="col-md-2">
			                				<img src="" class="img-fluid" id="card-brand">
			                			</div>
			                		</div>
			                	</div>
			                	<div class="col-md-3">
			                		<div class="form-group">
					                  <label for="expiration_date">Data de Expiração</label>
					                  <input type="text" class="form-control date_card" required name="expiration_date" id="expiration_date" required>
					                </div>
			                	</div>
			                	<div class="col-md-3">
			                		<div class="form-group">
					                  <label for="cvv">Código Verificador</label>
					                  <input type="text" class="form-control cvv" required name="cvv" id="cvv" required>
					                </div>
			                	</div>
			                </div>
		                	<div class="row">
		                		<div class="col-md-12">
		                			<button type="submit" class="btn btn-success">Finalizar Pagamento</button>
		                		</div>
		                	</div>
		              	</form>
				  	</div>
				  	<div class="tab-pane" id="boleto" role="tabpanel">
				  		<form autocomplete="off" id="payment-boleto">
					  		<div class="row mt-4">
					  			<div class="col-md-4">
								     <label for="amount">Valor á ser pago</label>
							      	<div class="input-group">
								        <div class="input-group-prepend">
									        <div class="input-group-text">R$</div>
									        </div>
								        <input type="text" required class="form-control amount" id="amount" placeholder="00,00">
								    </div>
			                	</div>
					  		</div>
					  		<div class="row mt-4" id="boleto-group">
					  			<div class="col-md-12">
					  				<div class="alert alert-primary text-center" role="alert">
									  	<h3>Número do Boleto</h3>
                        				<h4  id="numero-boleto">Aguarde...</h4>
									</div>
					  			</div>
					  		</div>
					  		<div class="row mt-4">
					  			<div class="col-md-3 offset-5">
		                			<button type="submit" class="btn btn-success btn-lg">Gerar Boleto</button>
		                		</div>
					  		</div>
					  	</form>
				  	</div>
				</div>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection