$(document).ready(function() {
    $(".parent-category").on("click", function() {
      // Close other open categories
      $(".parent-category").not(this).removeClass("active");
      $(".mega_menu").slideUp();
  
      // Open the selected category
      $(this).toggleClass("active");
      $(this).next(".mega_menu").slideToggle();
    });

    $(".sub-parent-category").on("click", function() {
        // Close other open sub-parent-categories
        $(".sub-parent-category").not(this).removeClass("sub-active");
        $(".mega_menu_inner").slideUp();
    
        // Open the selected sub-parent-category
        $(this).toggleClass("sub-active");
        $(this).next(".mega_menu_inner").slideToggle();
    });

    $(".sub-sub-category").on("click", function() {
        // Close other open sub-sub-categories
        $(".sub-sub-category").not(this).removeClass("sub-sub-active");
        $(".end-mega").slideUp();
    
        // Open the selected sub-sub-category
        $(this).toggleClass("sub-sub-active");
        $(this).next(".end-mega").slideToggle();
    });
});