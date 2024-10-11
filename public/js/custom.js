(function($) {
    $(document).ready(function() {        
        if ( $("#form-barta").length ) {
            
            $('#form-barta #form-submit').attr('disabled', 'disabled');
            $('#form-barta #form-submit').addClass('bg-gray-500');
            $('#form-barta #form-submit').removeClass('bg-gray-800');
            
            $( "textarea#barta" ).on( "keyup", function() {
                // alert('mouse up');
                console.log( $(this).val().length );
                
                if ( $(this).val().length > 0  ) {
                    $('form#form-barta #form-submit').removeAttr('disabled');
                    $('form#form-barta #form-submit').removeClass('bg-gray-500');
                    $('form#form-barta #form-submit').addClass('bg-gray-800');
                }else {
                    $('form#form-barta #form-submit').attr('disabled', 'disabled');
                    $('form#form-barta #form-submit').addClass('bg-gray-500');
                    $('form#form-barta #form-submit').removeClass('bg-gray-800');
                }
            } );        
        }
    });
  })(jQuery);