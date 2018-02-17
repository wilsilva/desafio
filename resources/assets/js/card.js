$("#card_number").on('change', function(){
    let cardNumber = $(this).val();

    $.post('/api/cards/token',{'buyer_id': sessionStorage.getItem('buyer_id') }, (data) => {
        
        let token = data.token.public_token;
        sessionStorage.setItem('token', token);

        let options = {
          default_public_exponent : '65537',
        };

        let encrypt = new JSEncrypt(options);
        encrypt.setPublicKey(token);
        
        let cardEncrypted = encrypt.encrypt(cardNumber);

        $.post('/api/cards/validate',{'buyer_id': sessionStorage.getItem('buyer_id'), 'credit_card': btoa(cardEncrypted) })
        .then((data)=>{
            
            if(data.valid){
              sessionStorage.setItem('cardIsValid', data.valid);
              $('#card_number').removeClass('is-invalid');
              $('#card_number').addClass('is-valid');
              $('#card-brand').attr('src', data.image);
            }else{
              $('#card_number').removeClass('is-valid');
              $('#card_number').addClass('is-invalid');
              $('#card-brand').attr('src', '');
            }

        }, (error) =>{
            console.error(error);
            toastr.error(error.responseJSON.error);
        })
          
    });

});

$("#payment-card").submit((event) => {
  event.preventDefault();

  if(!sessionStorage.getItem('cardIsValid')){
    toastr.error('Favor informar um cartão de crédito válido.');
    return false;
  }

  if(!sessionStorage.getItem('token')){
    toastr.error('Falha ao processar o pagamento.');
  }

  let options = {
    default_public_exponent : '65537',
  };

  let encrypt = new JSEncrypt(options);
  encrypt.setPublicKey(sessionStorage.getItem('token'));

  let cardEncrypted = btoa(encrypt.encrypt($("#payment-card").find("#card_number").val()));
  let cvvEncrypted = btoa(encrypt.encrypt($("#payment-card").find("#cvv").val()));

  let payment = {};
  payment.card = {};

  payment.amount = $("#payment-card").find('#amount').val().toString().replace(/\.|\./g, '').replace(',','.');
  payment.type = 'card';
  payment.buyer_id = sessionStorage.getItem('buyer_id');
  payment.card.holder_name = $("#payment-card").find("#holder_name").val();
  payment.card.card_number = cardEncrypted;
  payment.card.expiration_date = $("#payment-card").find("#expiration_date").val();
  payment.card.cvv = cvvEncrypted;

  $.post('/api/payments/creditcard', payment).then((data) => {
        sessionStorage.setItem('payment_id', data.payment.id);

        $("#message-succes-payment").html(data.message);
        $("#alert-message").show('fade');

  }).catch((error) => {
      for(var keyError in error.responseJSON.errors){
        error.responseJSON.errors[keyError].forEach(function(textError){
          toastr.error(textError);
        });
      }
  });

});