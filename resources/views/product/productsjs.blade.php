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
  $("#currentBid").focusout(function() {
      var el = $(this);
      if ( el.val() > product["bid"]["amount"]) {
        el.closest(".form-group").removeClass("has-error");
      } else {
          el.closest(".form-group").addClass("has-error");
      }
  });

  modal.find('.modal-title').text('Create bid for ' + product["name"])
   modal.find(".modal-body input[name='product_id'] ").val(product["id"])
  modal.find(".modal-body input[name='currentBid'] ").val(product["bid"]["amount"])
})

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
