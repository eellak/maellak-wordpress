(function($){
	$(document).ready( function(){
		
		$("#ma_ellak_software_submit_form").validate({
			ignore: "",
			rules: {
				namez:{ required: true },
				surnamez:{ required:true },
				emailz:{ required:true,
						 email:true},
				
			},
			messages: {
				namez:{ required: "Απαιτείται" },
				surnamez:{ required:"Απαιτείται" },
				emailz:{ required:"Απαιτείται",
						 email:"Πρέπει να έχει την μορφή email"},
			
			}
		});
		
	} );
})(jQuery)