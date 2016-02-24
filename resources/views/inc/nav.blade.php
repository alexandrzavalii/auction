<nav> 
         <ul> 
          @if (Auth::guest())
      <li><a href="/auth/login">Login</a></li>
      <li><a href="/auth/register">Register</a></li>
       <li><a href="/">Home</a></li>
  @else
               Welcome, {{ Auth::user()->name }}
          <li><a href="/products">Store</a></li>
          <li><a href="/auth/logout">Logout</a></li>
          
 @endif

 <li><a href="/about">About</a></li>
<li><a href="/contact">Contact</a></li>
</ul>
</nav>