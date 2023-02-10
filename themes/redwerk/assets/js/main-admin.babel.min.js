/******/(function () {
  // webpackBootstrap
  /******/
  var __webpack_modules__ = {
    /***/"./src/js/main-admin.js":
    /*!******************************!*\
      !*** ./src/js/main-admin.js ***!
      \******************************/
    /***/
    function srcJsMainAdminJs() {
      var _this = this;
      jQuery(document).ready(function ($) {
        var media_select_image = $('#media-select-image');
        $('#media-select-button').click(function (e) {
          e.preventDefault();
          var media_select_field = $('#media-select-field');
          var media_frame = wp.media({
            title: 'Select or Upload Media',
            button: {
              text: 'Use this media'
            },
            multiple: false
          });
          media_frame.on('select', function () {
            var attachment = media_frame.state().get('selection').first().toJSON();
            media_select_field.val(attachment.id);
            media_select_image.attr('src', attachment.url);
            $('.media-custom-field-remove').show();
          });
          media_frame.open();
        });
        $('.media-custom-field-remove').click(function (e) {
          e.preventDefault();
          var media_select_field = $('#media-select-field');
          media_select_field.val('');
          media_select_image.attr('src', '');
          $(_this).hide();
        });
      });

      /***/
    }

    /******/
  };
  /************************************************************************/
  /******/
  /******/ // startup
  /******/ // Load entry module and return exports
  /******/ // This entry module is referenced by other modules so it can't be inlined
  /******/
  var __webpack_exports__ = {};
  /******/
  __webpack_modules__["./src/js/main-admin.js"]();
  /******/
  /******/
})();
