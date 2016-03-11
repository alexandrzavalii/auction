
<nav>
  <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
  <ul>
    @if (Auth::guest())
      <li><a href="/"><h5>Home</h5></a></li>
    @else

      <li class="welcome"> <a href="/user">Welcome, {{ Auth::user()->name }}</a> </li>

      	<li>

             @if($count!=0)
      	    <a href="/cart">
      	        <i class="fa fa-shopping-cart fa-2x"></i>
      	         <lavel id="cart-badge" class="badge badge-warning">{{$count}}</lavel>
      	 </a>
           @else
            <div id="cart">
            <span class="empty">cart is empty.</span>
            </div>
          @endif
      </li>
      <li><a href="/products"><h5>Store</h5></a></li>
      <li><a href="/auth/logout"><h5>Logout</h5></a></li>
    @endif
    <li><a href="/about"><h5>About</h5></a></li>
    <li><a href="/contact"><h5>Contact</h5></a></li>
  </ul>
</nav>
