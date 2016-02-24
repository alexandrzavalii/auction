@extends('app')
@section('content')
    <section>
    	<div id="banner_outer">
      	<div id="banner_inner">
        	<h1 id="banner_text">Want some<br/>mercury?</h1>
				</div>
    	</div>
    	<div id="sign_outer">
        	<table id="sign_inner">
    				<tr>
							                            <td id="log_in_box">
								<a href="/auth/login" onmousedown="highlight(this)" onmouseup="unhighlight(this)" onmouseout="unhighlight(this)">Log In</a>
							</td>
							<td id="sign_up_box">
								<a href="/auth/register" onmousedown="highlight(this)" onmouseup="unhighlight(this)" onmouseout="unhighlight(this)">Sign Up</a>
							</td>
						</tr>
              </table>
              @yield('registration')
    	</div>
    </section>
@endsection
