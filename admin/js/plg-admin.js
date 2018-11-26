// Main JS
(function( $ ) {
  'use strict';

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

   var MyObject = {
       abc: function() { console.log("Hola Mundo"); }
       // other functions...
   }

   $(document).ready( function () {
      $('#services_list').DataTable( {
         "dom": 'Tfgtlp',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
         },
         "columnDefs": [
                { "targets": 0, "orderable": false },
                { "targets": 3, "orderable": false },
                { "targets": 4, "orderable": false }
                // { "targets": 5, "orderable": false }
            ],
      });
   });

})( jQuery );