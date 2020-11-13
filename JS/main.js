(function($) {
  
  "use strict";  

  $(window).on('load', function() {
	  



  /* slicknav mobile menu active  */
    $('.mobile-menu').slicknav({
        prependTo: '.navbar-header',
        parentTag: 'liner',
        allowParentLinks: true,
        duplicate: true,
        label: '',
        closedSymbol: '<i class="fa fa-angle-right"></i>',
        openedSymbol: '<i class="fa fa-angle-down"></i>',
      });


});  

/* Nav Menu Hover active
========================================================*/
$(".nav > li:has(ul)").addClass("drop");
$(".nav > li.drop > ul").addClass("dropdown");
$(".nav > li.drop > ul.dropdown ul").addClass("sup-dropdown");


 /*  Select Color Active
  ========================================================*/
  $("div.color-list .color").click(function(e){
    e.preventDefault();
    $(this).parent().parent().find(".color").removeClass("active");
    $(this).addClass("active");
  })
  

}(jQuery));