$(function(){

	$('.form_checkout').validate({
	      rules: {
	            first_name: "required",
	      },
	      submitHandler: function(form){

	            var request = new XMLHttpRequest();

	            request.open('POST', 'checkout/teste', true);

	            var formData = new FormData(form);

	            request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

	            request.onload = function()
	            {
	                if (request.status >= 200 && request.status < 400)
	                {
	                    let data = JSON.parse(request.responseText);

	                    if(data.status == 'success')
	                    {

	                    }else{
	                    }

	                }
	            };

	            request.onerror = function(a)
	            {
	            };

	            request.send(formData);
	      }
    	})

	$(document).ready(function() {

		$(".cep").mask("99.999-999");

	});

	$(document).ready(function() {

		$(".phone").mask("(99) 99999-9999");

	});


	$(document).on('click', '.send_cep', function(event) {
		event.preventDefault();

		let stret = $("input[name='address']");

		let state = $("input[name='state']");

		let city = $("input[name='city']");

		let bairro = $("input[name='bairro']");

		if($('.cep').val()){

			let a = $('.cep').val().split('.');

			let b = a[1].split('-');

			let cep = a[0] + b.join('');

			$.getJSON("https://viacep.com.br/ws/" + cep + "/json/", function(data) {

				stret.val(data.logradouro);

				state.val(data.uf);

				city.val(data.localidade);

				bairro.val(data.bairro);

			});

		}

	});

})