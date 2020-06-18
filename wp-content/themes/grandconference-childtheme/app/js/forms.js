(function($) {
  'use strict';

  function applyLibraries() {
    $('.mask-phone').mask('+000 9999999999999');

    // Stylize the dropdowns
    $('select.selectric').selectric();

    // Datepickers
    /*$('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });*/

    // Stylize the checkboxes / radio boxes
    $('input.pretty').each(function() {
      $(this).prettyCheckable({
        labelPosition: 'right'
      });
    });

    // Autoresize the textareas
    autosize($('textarea.autosize'));
  }

  $(function() {

    // Do a countdown for fields that have maxlength (textareas)
    $('textarea[maxlength]').each(function() {
      var max = $(this).attr('maxlength');

      // Insert field after for display
      var notice = $('<span class="wordcount"></span>');
      $(this).after(notice);

      $(this).on('keyup', function() {
        var obj = $(this).next('.wordcount');
        var length = $(this).val().length;
        var msg = (max - length) + ' characters remaining';

        obj.removeClass('maxed');

        if (length >= max) {
          msg = 'You have reached the limit';
          obj.addClass('maxed');
        }

        obj.text(msg);
      });

      $(this).trigger('keyup');
    });

    // Preselect country if a value isn't given (UAE)
    // $('select.selectric[name=country]').prop('selectedIndex', 195).selectric('refresh');

    // For urls it should automatically prefix it
    $('form').on('keyup', 'input.url', function(e) {
      var val = $(this).val();

      if (val.indexOf('.') !== -1 && val.indexOf('http') === -1) {
        $(this).val('http://' + val);
      }
    });

    $('form.validate').validate({
      submitHandler: function(form) {
        var id       = $(form).attr('id');
        var uri      = $(form).data('endpoint');
        var gtmEvent = $(form).data('gtm-event');
        var formData = $(form).serialize();

        // Replace variables in the URI
        uri = uri
          .replace('{API_URL}', API_URL)
          .replace('{EVENT_ID}', EVENT_ID);

        // Reset the error message
        $('.error-msg', form).remove();

        $.ajax({
          dataType: 'json',
          method: 'POST',
          url: uri,
          data: formData,
          success: function(res) {

            // Get success html
            var html = $('#' + id + '-success').html();
            $(form).html(html);

            // Send GTM callback
            if (gtmEvent && dataLayer) {

              // Send custom form submission
              dataLayer.push({
                event: 'step.form.submission'
              });

              // Add custom event
              dataLayer.push({
                event: gtmEvent
              });
            }
          },
          error: function(res) {
            var message = res.responseJSON.message;

            if (message) {
              var error = $('<div class="error-msg alert alert-danger"></div>');
              $(form).children('.container').prepend(error.text(message));
            }
          }
        });

        return false;
      }
    });

    // Startup form magic
    var startupForm = $('form.wpcf7-form');
    if (startupForm.length) {
      $('select[name=fundingStage]', startupForm).change(function(e) {
        var stage = $(this).val();
        var html = $('#stage-' + stage).html();

        $('#extra-fields').hide().html(html || '').fadeIn();

        applyLibraries();
      });

      $('select[name=fundingStage]').trigger('change');
    }

    // Apply styles to form
    applyLibraries();

    // Upload the logo
    /*$('.js-upload-logo').on('click', function(e) {
      e.preventDefault();

      var dir = 'logos/' + makeid(7) + '/';

      filepicker.pickAndStore({
        maxFiles: 1,
        mimetypes: ['image/*'],
        services: ['COMPUTER', 'FACEBOOK', 'INSTAGRAM', 'GOOGLE_DRIVE', 'DROPBOX']
      }, {
        location: 'S3',
        path: dir
      }, function(blobs) {
        var blob = blobs[0];
        var newFile = blob.key.substr(0, blob.key.lastIndexOf('.')) + '-300.png';

        filepicker.convert(blob, {
          width: 300,
          height: 300,
          format: 'png',
          fit: 'max'
        }, {
          location: 'S3',
          path: newFile
        }, function(data) {
          var url = sanitizeUrl('https://conference.stepcdn.com/' + data.key);

          // Update the form
          $('input[name=logoUrl]').val(url);

          // Update the UI
          var img = $('<img />');
          img.attr('src', url);
          $('.uploaded-image').html(img);

          $('.js-remove-upload').css('display', 'block');
        }, handleUploadError);
      }, handleUploadError);
    });

    $('.js-upload-photo').on('click', function(e) {
      e.preventDefault();

      var dir = 'photos/' + makeid(7) + '/';

      filepicker.pickAndStore({
        maxFiles: 1,
        mimetypes: ['image/*'],
        services: ['COMPUTER', 'FACEBOOK', 'INSTAGRAM', 'GOOGLE_DRIVE', 'DROPBOX']
      }, {
        location: 'S3',
        path: dir
      }, function(blobs) {
        var blob = blobs[0];
        var newFile = blob.key.substr(0, blob.key.lastIndexOf('.')) + '-500.jpg';

        filepicker.convert(blob, {
          width: 500,
          height: 500,
          align: 'faces',
          format: 'jpg',
          fit: 'crop'
        }, {
          location: 'S3',
          path: newFile
        }, function(data) {
          var url = sanitizeUrl('https://conference.stepcdn.com/' + data.key);

          // Update the form
          $('input[name=imageUrl]').val(url);

          // Update the UI
          var img = $('<img />');
          img.attr('src', url);
          $('.uploaded-image').html(img);

          $('.js-remove-upload').css('display', 'block');
        }, handleUploadError);
      }, handleUploadError);
    });

    // Remove uploaded images and reset
    $('.js-remove-upload').on('click', function(e) {
      e.preventDefault();
      $('input[name=logoUrl], input[name=imageUrl]').val('');
      $('.uploaded-image').html('');
      $(this).hide();
    });*/
  });
})(jQuery);
