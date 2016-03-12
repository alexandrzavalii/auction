
//countdown timer
           $('[data-countdown]').each(function() {
             var d = new Date()
             var offset = d.getTimezoneOffset();

     var $this = $(this), finalDate = $(this).data('countdown');
               expiration = new Date(finalDate * 1000);
               expiration.setHours( expiration.getHours() +offset/60 );
     $this.countdown(expiration, function(event) {
       $this.html(event.strftime('%D days %H:%M:%S'));
     });

   });
