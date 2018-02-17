$("#newBuyer").on('submit', (event) => {

    const name = $("#newBuyer").find("#name").val();
    const email = $("#newBuyer").find("#email").val();
    const cpf = $("#newBuyer").find("#cpf").val().toString().replace(/[\.-]/g,'');
    const client_id = $("#newBuyer").find("#client_id").val();
    
    const buyer = {
      name,
      email,
      cpf,
      client_id
    }

    $.post('/api/buyers', buyer, (data) => {
          sessionStorage.setItem('buyer_id', data.buyer.id);
          location.href = '/payment'
    }).catch((error) => {
        
        for(var keyError in error.responseJSON.errors){
          error.responseJSON.errors[keyError].forEach(function(textError){
            toastr.error(textError);
          });
        }

    });

    return false;
});