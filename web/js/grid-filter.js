/**
 * Debounce search for GridView filters
 */
(function () {
  var debounceTimer;

  $(document).on("keyup", ".filters input[type='text']", function () {
    var input = $(this);
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function () {
      // Trigger change event then simulate Enter key
      input.trigger("change");
      var e = $.Event("keydown", { keyCode: 13, which: 13 });
      input.trigger(e);
    }, 500);
  });
})();
