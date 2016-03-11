
//countdown timer
           $('[data-countdown]').each(function() {
     var $this = $(this), finalDate = $(this).data('countdown');
               expiration = new Date(finalDate * 1000);

     $this.countdown(expiration, function(event) {
       $this.html(event.strftime('%D days %H:%M:%S'));
     });

   });
