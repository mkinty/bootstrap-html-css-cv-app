$(document).ready(function() {
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#about']").on('click', function(event) {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function() {

      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
    });
  });
  
  $('#contact-form').submit(function (e) { // e comme evenement
    e.preventDefault();
    $('.comments').empty(); // vider les commantaires
    var postdata = $('#contact-form').serialize();

    $.ajax({
      type: 'POST',
      url: 'php/contact.php',
      data: postdata,
      dataType: 'json',
      success: function(result){
        if (result.isSuccess) {
          $("#contact-form").append("<p class='thank-you'>Votre message a bien été envoyé. Merci de m'avoir contacté :)</p>");
          $("#contact-form")[0].reset();
        } else {
          $("#firstname + .comments").html(result.firstnameError);
          $("#name + .comments").html(result.nameError);
          $("#email + .comments").html(result.emailError);
          $("#phone + .comments").html(result.phoneError);
          $("#message + .comments").html(result.messageError);
        }
      }

    });

  });

})
