<!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, 
     initial-scale=1">
   <title>Welcome to our Company</title>
     <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="/css/app.css">
     <script>
			
    function highlight(el) {
    	el.style.backgroundColor = "white";
			el.style.color = "rgb(93, 93, 93)";
		}
		
		function unhighlight(el) {
    	el.style.backgroundColor = "rgba(255, 255, 255, 0)";
			el.style.color = "white";
		}
			
		</script>
		
 </head>
 <body>
  
   <video autoplay loop id="video" preload="auto" poster="#"  > 
      <source src="/snow.mp4" type="video/mp4">
    </video>
    
    @yield('content')
   
    <footer>
         @include('inc.nav')
    </footer>

   <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
 </body>
 </html>

