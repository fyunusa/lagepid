(function ($, Drupal) {
    Drupal.behaviors.rulesIfAddAction = {
      attach: function (context, settings) {
        // Add your JavaScript logic for the "Add Action" button behavior here.
        $('.rules-if-add-action', context).once('rules-if-add-action').click(function () {
          // Use AJAX to add a new nested action to the IF container.
          var addButton = $(this);
          var ajaxSettings = {
            url: '/edawah_rules/add-action', // Replace with the correct URL to your AJAX callback.
            submit: addButton.closest('form').serialize(),
            progress: {
              type: 'throbber',
              message: ''
            }
          };
  
          $.ajax(ajaxSettings).done(function (response) {
            $('#actions-container', context).replaceWith(response);
          });
        });
      }
    };
  })(jQuery, Drupal);
  