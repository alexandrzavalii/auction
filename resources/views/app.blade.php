<!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, 
     initial-scale=1">
   <title>Welcome to our Company</title>
   <link rel="stylesheet" href="/css/app.css">
 </head>
 <body>
  
   <h1> This is the Header of our Company </h1>
   @include('inc.nav')
   @yield('content')
   
   <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
 </body>
 </html>

