$(function() {

	// Custom JS
// кастомный селект
 $('.adv-search__select').styler({
 	size: 6
 });

 // кастомный скролл

 $(".jq-selectbox__dropdown ul").niceScroll({
    horizrailenabled : false,
    "verge" : "500",
    cursorborder: "0",
    cursorborderradius: "4px",
    cursorwidth: "10px",
    cursorcolor: "#7aa700", 
    background: " #f8fee0",
    // railpadding: "5"
    // touchbehavior: "true",
  });
 $(".jq-selectbox").click(function(){
 		
		 $(".jq-selectbox__dropdown ul").getNiceScroll().show();
 
 })
 $(document).click( function(event){
      if( $(event.target).closest(".jq-selectbox").length ) 
        return;
     
		 $(".jq-selectbox__dropdown ul").getNiceScroll().hide();
 
    });

 // скрытие расширенног поиска
 $(".adv-search__btn-toggle").click(function(){
 		$(".adv-search__panel").slideToggle();
 })
});
