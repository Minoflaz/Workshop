$(document).ready(function(){

    $("#sel1").change(function() {
      if ($(this).val() == "Aucun") {
        $("#autre_choix").show();
      } else {
        $("#autre_choix").hide();
      }
      //$("ici").append(txt);
    });

    function myFunction() 
    {
      console.log("hghghghg");
      var txt = "<div class='form-group'><div class='row'><div class='col-sm-2'></div><div class='col-sm-3'><label for='titre'>Intitulé de la compétence</label></div><div class='col-sm-6'><input type='text' name='id' class='form-control' id='monChamp'></div></div></div>"
      $("ici  ").append(txt); 
    };

    /*document.getElementById("myButton").onclick = function () {
        location.href = "www.yoursite.com";
    };*/

  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();

   $('[data-toggle="popover"]').popover(); 
  
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  // Slide in elements on scroll
   $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
