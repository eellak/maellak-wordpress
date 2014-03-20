(function($){
	$(document).ready( function(){
		
		$("#myform").validate({
			ignore: "",
			rules: {
				username1:{ required: true },
				username2:{ required:true,  },
				regemail:{ required:true,
						 email:true},
				regname:{required:true,minlength: 5},
				
				regpass1: {
                    required: true,
                    minlength: 5
				 },
				 regpass2: {
				     required: true,
				     minlength: 5,
				     equalTo: "#regpass1"
				 },
				 recaptcha_response_field: { required: true}

				
			},
			messages: {
				username1:{ required: " Το όνομα είναι υποχρεωτικό!" },
				username2:{ required:" Το επώνυμο είναι υποχρεωτικό!" },
				regemail:{ required:"Το ηλεκτρονικό ταχυδρομείο δεν έχει σωστή μορφή. Πρέπει να έχει τη μορφή onoma@onoma.gr",
						   email:"Πρέπει να έχει την μορφή email"},
				regname:{required:" Το όνομα χρήστη είναι υποχρεωτικό !", minlength:" Το όνομα χρήστη  πρέπει να περιέχει τουλάχιστον 5 χαρακτήρες",},
				regpass1:{required:"O κωδικός χρήστη είναι υποχρεωτικός", 
						  minlength:" Ο κωδικός χρήστη πρέπει να περιέχει τουλάχιστον 5 χαρακτήρες"},
				regpass2:{required:"O κωδικός χρήστη - ξανά είναι υποχρεωτικός", 
					  minlength:" Ο κωδικός χρήστη πρέπει να περιέχει τουλάχιστον 5 χαρακτήρες",
					  equalTo:"Ο κωδικός χρήστη - ξανά πρέπει να είναι ίδιος με τον κωδικό χρήστη"},
					  recaptcha_response_field:{required:"To captcha είναι υποχρεωτικό"}
			
			},
			errorPlacement: function(error, element) {         
				if(element.attr("name") == "recaptcha_response_field") 
					error.insertBefore(element.parent().parent().parent().parent().parent());
				else 
					error.insertAfter(element);
		   }
		
		});
	
		$("#emailForm").validate({
			
			ignore: "",
			rules: {
				email:{ required:true,
						 email:true},
			},
			messages: {
				email:{ required:"Το ηλεκτρονικό ταχυδρομείο δεν έχει σωστή μορφή. Πρέπει να έχει τη μορφή onoma@onoma.gr",
						   email:"Πρέπει να έχει την μορφή email"},
			},
			
			
			
		});
	} );
	
	
})(jQuery)