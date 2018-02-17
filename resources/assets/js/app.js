require('./bootstrap');
require('./buyer');
require('./card');
require('./boleto');


$(function(){
  $('.cpf').mask('000.000.000-00', {reverse: true});
  $('.date_card').mask('00/00');
  $('.cvv').mask('000');
  $('.amount').mask("#.##0,00", {reverse: true});
  $(document).ajaxStart(function() { Pace.restart(); });
  $("#alert-message").hide();
  $("#boleto-group").hide();
});




