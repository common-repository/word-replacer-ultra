(function($){

  $("#quick-search").submit(function(event) {
        event.preventDefault();
    $(this).validate({
        rules: {
            'search_key': {required: true},
            'replace_key': {required: true},
            'post_types[]': {required: true},

        },
        messages: {
            'search_key': {required:'Please Enter Any key to search'},
            'replace_key': {required: 'Please Enter Any key to replace'},
            'post_types[]': {required: 'Please select any post type to continue'},
        }

    });
    var valid = $(this).valid();
    if (valid) {
        if (confirm("Are you sure? You won't be able to revert!")) {
          var serialize_form = $(this).serialize();
            $.ajax({
              type:"POST",
              url: object.ajax_url,
              data: serialize_form,
              dataType: 'json',
              success: function (response) {
                        var status = response.status;
                        console.log(response);
                        if (status) { 
                           alert(response.message);
                           location.reload();
                        } else {
                           alert(response.message);
                    }
                },
                    error: function (errorThrown) {
                       alert('error');
                        console.log(errorThrown);
                    },
            });
        }
    }
  });
})(jQuery)