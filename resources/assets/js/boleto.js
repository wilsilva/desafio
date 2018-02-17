
$("#payment-boleto").submit((event) => {
	event.preventDefault();

	let payment = {};

  	payment.amount = $("#payment-boleto").find('#amount').val().toString().replace(/\.|\./g, '').replace(',','.');
  	payment.type = 'boleto';
  	payment.buyer_id = sessionStorage.getItem('buyer_id');

  	$.post('/api/payments/boleto', payment).then((data) => {

  		sessionStorage.setItem('payment_id', data.payment.id);

      	$("#message-succes-payment").html(data.message);
      	$("#alert-message").show('fade');

      	if(data.payment.type == 'boleto'){
			$("#boleto-group").show('fade');
			$("#numero-boleto").html('');

			data.payment.boleto.forEach(function(element){
				$("#numero-boleto").append(element.number);
				$("#numero-boleto").append('<br>');
			});
		}

  	}).catch((error) => {
      	for(var keyError in error.responseJSON.errors){
	        error.responseJSON.errors[keyError].forEach(function(textError){
	          toastr.error(textError);
	        });
      	}
  	});

});


$(function(){
	if(sessionStorage.getItem('payment_id')){
		let paymentId = sessionStorage.getItem('payment_id');
		$.get('/api/payments/status?payment=' + btoa(paymentId)).done(function(data){
			data.payment.amount = data.payment.amount.replace('.',',');

			$("#status-payment-text").html(data.payment.status_payment);
			$('#amount-text').html("R$ " + data.payment.amount);
			$('#type-text').html((data.payment.type == 'card') ? 'Cartão' : 'Boleto');
			console.log(data);
			if(data.payment.type == 'boleto'){
				$("#boleto-group").show('fade');
				$("#numero-boleto").html('');

				data.payment.boleto.forEach(function(element){
					$("#numero-boleto").append(element.number);
					$("#numero-boleto").append('<br>');
				});
			}

		});
	}
});