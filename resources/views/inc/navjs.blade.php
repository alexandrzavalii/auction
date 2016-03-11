<script>
$(function(){

  $('footer .glyphicon').click(navToggle);

  function navToggle(){
    if($(this).hasClass('glyphicon-chevron-up')){
      $('.container').fadeOut();
      $('footer').addClass('ulVisible');
      $('footer').toggleClass('darken');
      $(this).removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
    } else {
      $('.container').fadeIn();
      $('footer').removeClass('ulVisible');
      $('footer').toggleClass('darken');
      $(this).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
    }
  }


});
</script>
