$("#card_number").on('change', function(){
    let cardNumber = $(this).val();

    $.post('/api/cards/token',{'buyer_id': sessionStorage.getItem('buyer_id') }, (data) => {
        
        let token = data.token.public_token;
        let options = {
          default_public_exponent : '65537',
        };

        let encrypt = new JSEncrypt(options);
        encrypt.setPublicKey(token);
        
        let encrypted = encrypt.encrypt(cardNumber);

        $.post('/api/cards/validate',{'buyer_id': sessionStorage.getItem('buyer_id'), 'credit_card': btoa(encrypted) })
        .then((data)=>{
            
            if(data.valid){
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
  let payment = {};
  payment.card = {};

  payment.amount = $("#payment-card").find('#amount').val().toString().replace(/\.|\./g, '').replace(',','.');
  payment.type = 'card';
  payment.buyer_id = sessionStorage.getItem('buyer_id');
  payment.card.holder_name = $("#payment-card").find("#holder_name").val();
  payment.card.card_number = $("#payment-card").find("#card_number").val();
  payment.card.expiration_date = $("#payment-card").find("#expiration_date").val();
  payment.card.cvv = $("#payment-card").find("#cvv").val();

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

  console.log(payment);

});