$(function() {
    
    var form = $('#ajax-contact');
    var formSubmit = $('#ajax-contact #submit');
    var formAction = $('#ajax-contact').attr('action');
    var formResponse = $('.form-info');
    
    formSubmit.click(function(event){
       
        event.preventDefault();
        console.log("Form tested:"+formAction);
        var dataTest = "Testowa data";
        var formData = form.serialize();
        
        $.ajax({
			    type: 'POST',
                url: '../mail.php',
                data: formData ,
                success: function (response) {             
                    console.log("SUKCES:"+response);
                    formResponse.text(response);
                    $('#name').val('');
                    $('#phone').val('');
                    $('#email').val('');
                    $('#message').val('');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log("ERROR:"+textStatus, errorThrown);
                }
        });
        
    });
    
    
});




//<form action="/mail.php" method="post" class="form" id="ajax-contact">
//                <input type="text" name="name" placeholder="Imię i nazwisko | Nazwa firmy" data-validation="alphanumeric" data-validation-allowing=" ąćęłńóśżźĄĆĘŁŃÓŚŻŹ" data-validation="required">
//                <input type="text" name="email" placeholder="E-mail" data-validation="email" data-validation-error-msg="Niepoprawny email">
//                <input type="text" name="phone" placeholder="Telefon" data-validation="number" data-validation-allowing="range[100000000;999999999]" data-validation-error-msg="Numer telefonu może zawierać wyłącznie cyfry w formacie(XXXXXXXXX)">
//                <textarea name="message" placeholder="Wiadomość" data-validation="required"></textarea>
//                <button type="submit">Wyślij</button>
//            </form>
//            <div class="row">
//                <div class="col-md-12">
//                    <br class="clear" />
//                    <div id="form-messages">
//                        <div class="form-info"></div>
//                    </div>
//                </div>
//            </div>









//$(function() {
//	// Get the form.
//	var form = $('#ajax-contact');
//
//	// Get the messages div.
//	var formMessages = $('#form-messages');
//
//	// Set up an event listener for the contact form.
//	$(form).submit(function(event) {
//		// Stop the browser from submitting the form.
//		event.preventDefault();
//
//		var formData = $(form).serialize();
//
//		// Submit the form using AJAX.
//		$.ajax({
//			type: 'POST',
//			url: $(form).attr('action'),
//			data: formData
//		}).done(function(response) {
//			// Make sure that the formMessages div has the 'success' class.
//			$(formMessages).removeClass('error');
//			$(formMessages).addClass('success');
//
//			// Set the message text.
//			$(formMessages).text(response);
//
//			// Clear the form.
//			$('#name').val('');
//			$('#phone').val('');
//			$('#email').val('');
//			$('#message').val('');
//		}).fail(function(data) {
//			// Make sure that the formMessages div has the 'error' class.
//			$(formMessages).removeClass('success');
//			$(formMessages).addClass('error');
//
//			// Set the message text.
//			if (data.responseText !== '') {
//				$(formMessages).text(data.responseText);
//			} else {
//				$(formMessages).text('Nie udało się wysłac wiadomości.');
//			}
//		});
//
//		var alert=$(".alert");
//		alert.html("Wysłanow");
//
//		alert.css("display", "block");
//
//		// TODO
//	});
//});
