jQuery(document).ready(function($) {
  $('.offcanvas').on('show.bs.offcanvas', function (e) {
    //console.log(e);
    $(".navbar-toggler").addClass("active");
  });
  $('.offcanvas').on('hide.bs.offcanvas', function (e) {
    //console.log(e);
    $(".navbar-toggler").removeClass("active");
  });

  // Add smooth scrolling to all links
  $("a[href^=#]").click(function(e) {   
    e.preventDefault();   
    var dest = $(this).attr('href');   
    console.log(dest);   
    $('html,body').animate({ 
      scrollTop: $(dest).offset().top - $("#masthead").outerHeight()
     }, 'slow');
  });


});