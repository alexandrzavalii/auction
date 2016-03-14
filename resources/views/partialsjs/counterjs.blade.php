
//countdown timer
           $('[data-countdown]').each(function() {
             var d = new Date()
             var offset = d.getTimezoneOffset();

     var $this = $(this), finalDate = $(this).data('countdown'), bid = $(this).data('bid') ;
               expiration = new Date(finalDate * 1000);
               expiration.setHours( expiration.getHours() +offset/60 );

     $this.countdown(expiration, function(event) {
       if(expiration < new Date())
       {
         var bidId=bid["id"];
         $.ajax({
            type: "POST",
            url: '/bid_check/{bid}',
            data: { bid : bidId, offset: offset },
        }).done(function( msg ) {
            console.log("Checked: ".bidId);
        });
    }else if(expiration > new Date()){
      $this.html(event.strftime('%D days %H:%M:%S'));
    };


     });

   });
