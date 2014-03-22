(function($){
	$(document).ready( function(){

		var val_holder;

		$("#emailForm").validate({
			ignore: "",
			rules: {
				email:{ required:true,
						 email:true,
						 remote: "includes/check_email.php"},
			},
			messages: {
				email:{ required:"Το ηλεκτρονικό ταχυδρομείο δεν έχει σωστή μορφή. Πρέπει να έχει τη μορφή onoma@onoma.gr",
						   email:"Πρέπει να έχει την μορφή email",
						   remote:'Το email που δηλώσατε δεν υπάρχει'},
			},
			
			
			
		});//emailForm validation 
		$("#newpass").validate({
			ignore: "",
			rules: {
				password: {
					required: true,
					minlength: 5
				},
				 password1: {
				     required: true,
				     minlength: 5,
				     equalTo: "#password"
				 },
			},
			messages: {
				password:{required:"O κωδικός χρήστη είναι υποχρεωτικός", 
					  minlength:" Ο κωδικός χρήστη πρέπει να περιέχει τουλάχιστον 5 χαρακτήρες"},
				password1:{required:"O κωδικός χρήστη - ξανά είναι υποχρεωτικός", 
				  minlength:" Ο κωδικός χρήστη πρέπει να περιέχει τουλάχιστον 5 χαρακτήρες",
				  equalTo:"Ο κωδικός χρήστη - ξανά πρέπει να είναι ίδιος με τον κωδικό χρήστη"},
			}
		});
		
		
	
	
});	
	
})(jQuery)
