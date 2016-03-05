<!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width,
     initial-scale=1">
   <title>Welcome to our Company</title>
     <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="/css/app.css">
   <link rel="shortcut icon" href="/imgs/favicon.ico">



 </head>
 <body>
    @yield('content')

    <footer>
         @include('inc.nav')
    </footer>



   <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
   <script src="/lib/jquery.countdown.min.js"></script>
   @yield('footer_js')
   @yield('navjs')
   @yield('modaljs')
   @yield('counterjs')

 </body>
 </html>
