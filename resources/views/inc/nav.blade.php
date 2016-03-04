
<nav>
  <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
  <ul>
    @if (Auth::guest())
      <li><a href="/"><h4>Home</h4></a></li>
    @else

      <li class="welcome"> Welcome, {{ Auth::user()->name }}</li>
      	<li>
             @if($count!=0)
      	    <a href="/cart">
      	        <i class="fa fa-shopping-cart fa-2x"></i>
      	         <lavel id="cart-badge" class="badge badge-warning">{{$count}}</lavel>
      	 </a>
           @else
            <div id="cart">
            <span class="empty">No items in cart.</span>
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


@section('navjs')
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
@endsection
