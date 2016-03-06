@extends('app')

@section('content')
  @include('inc.header')


<div class="container">
      @include('createProduct.modal')


  @if (count($errors) > 0)
   <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
  @endif
  @if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

  <div class="row auto-clear">

    @if (count($products) > 0)

      @foreach ($products as $product)
          @include('inc.product', array('product'=>$product))
      @endforeach


    @else
      <div class="nothing col-sm-3">
        <p>
          <h1>No items found.</h1>
        </p>
      </div>
    @endif
  </div>

</div>
@include('inc.footer')
@endsection
@section('counterjs')
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script>

  $('#storeBid').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var product = button.data('product')
    var modal = $(this)
    modal.find('.modal-title').text('Create bid for ' + product["name"])
     modal.find(".modal-body input[name='product_id'] ").val(product["id"])
    modal.find(".modal-body input[name='max'] ").val(product["price"])
  })

  $('#bid').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var product = button.data('product')
    var modal = $(this)
    modal.find('.modal-title').text('Create bid for ' + product["name"]+' is $'+ product["bid"]["amount"])
     modal.find(".modal-body input[name='product_id'] ").val(product["id"])
    modal.find(".modal-body input[name='currentBid'] ").val(product["bid"]["amount"])
  })
  //buy form
  $('#buy').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var product = button.data('product')
    var modal = $(this)
    $("#card-number").focusout(function() {
      console.log('on');
        var el = $(this);
        if ( ! Stripe.validateCardNumber(el.val())) {
            el.closest(".form-group").addClass("has-error");
        } else {
            el.closest(".form-group").removeClass("has-error");
        }
    });
    $("#card-cvc").focusout(function() {
        var el = $(this);
        if ( ! Stripe.validateCVC(el.val())) {
            el.closest("div").addClass("has-error");
        } else {
            el.closest("div").removeClass("has-error");
        }
    });
    $('#purchase-form').submit(function(e) {
        $('.submit-button').prop('disabled', true);
        var $form = $(this);

        $form.find('.payment-errors').hide()
        Stripe.card.createToken({
            number: $form.find('#card-number').val(),
            cvc: $form.find('#card-cvc').val(),
            exp_month: $form.find('#card-month').val(),
            exp_year: $form.find('#card-year').val()
        }, stripeResponseHandler);
        return false;
    });
    modal.find('.modal-title').text('Buy ' + product["name"]+' for $'+ product["price"])
     modal.find(".modal-body input[name='product_id'] ").val(product["id"])

  })
//stripe charge
  Stripe.setPublishableKey('pk_test_GOBypCWqHxenhGDfHClBzJXH');

   var stripeResponseHandler = function(status, response) {
       var $form = $('#purchase-form');
       var $errors = $('.payment-errors');
       // Reset any errors
       $errors.text("");
       if (response.error) {
           $errors.text(response.error.message).show();
           $form.find('button').prop('disabled', false);
       } else {
           var token = response.id;
           $form.append($('<input type="hidden" name="stripe_token" />').val(token));
           $form.get(0).submit();
           $form.find('button').html('Processing...');
       }
   };
//countdown timer
           $('[data-countdown]').each(function() {
     var $this = $(this), finalDate = $(this).data('countdown');
               expiration = new Date(finalDate * 1000);

     $this.countdown(expiration, function(event) {
       $this.html(event.strftime('%D days %H:%M:%S'));
     });

   });

   //textarea limit
   $('#characterLeft').text('233 characters left');
$('#message').keyup(function () {
    var max = 233;
    var len = $(this).val().length;
    if (len >= max) {
        $('#characterLeft').text('You have reached the limit');
        $('#characterLeft').addClass('red');
        $('#btnSubmit').addClass('disabled');
    }
    else {
        var ch = max - len;
        $('#characterLeft').text(ch + ' characters left');
        $('#btnSubmit').removeClass('disabled');
        $('#characterLeft').removeClass('red');
    }
});

  </script>

@endsection
