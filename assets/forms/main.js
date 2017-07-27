$(document).ready(function () {
	$.fn.bootstrapSwitch.defaults.onColor = 'success';

	$("[name='trabaja']").bootstrapSwitch();
	$("[name='trabaja']").on('switchChange.bootstrapSwitch', function(event, state) {
	  if(state){
	  	$("[name='donde']").attr('disabled', false).attr('required', true).focus();
	  } else {
	  	$("[name='donde']").attr('disabled', true).attr('required', false);
	  }
	});
	$("[name='hijos']").bootstrapSwitch();
	$("[name='hijos']").on('switchChange.bootstrapSwitch', function(event, state) {
	  if(state){
	  	$("[name='cantidad']").attr('disabled', false).attr('required', true).focus();
	  	$("[name='edades']").attr('disabled', false).attr('required', true).focus();
	  } else {
	  	$("[name='cantidad']").attr('disabled', true).attr('required', false);
	  	$("[name='edades']").attr('disabled', true).attr('required', false);
	  }
	});
	$("[name='padre-vive']").bootstrapSwitch();
	$("[name='madre-vive']").bootstrapSwitch();

	$.h5Validate.addPatterns({
		telefono: /([\+][0-9]{1,3}([ \.\-])?)?([\(]{1}[0-9]{4}[\)])?([0-9A-Z \.\-]{1,32})((x|ext|extension)?[0-9]{1,4}?)/,			
		celu: /([\+][0-9]{1,2}([ \.\-])?)?([\(]{1}[0-9]{4}[\)])?([0-9A-Z \.\-]{1,32})((x|ext|extension)?[0-9]{1,4}?)/				
	});

    $('form').h5Validate();
/*
    $('.btn-iscripcion').click(function(e){
    	e.preventDefault();
    });
*/
});
