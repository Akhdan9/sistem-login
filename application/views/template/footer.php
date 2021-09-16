 <!-- Right Panel -->

 <script src="<?= base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
 <script src="<?= base_url(); ?>assets/vendors/popper.js/dist/umd/popper.min.js"></script>
 <script src="<?= base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
 <script src="<?= base_url(); ?>assets/assets/js/main.js"></script>


 <script src="<?= base_url(); ?>assets/vendors/chart.js/dist/Chart.bundle.min.js"></script>
 <script src="<?= base_url(); ?>assets/assets/js/dashboard.js"></script>
 <script src="<?= base_url(); ?>assets/assets/js/widgets.js"></script>
 <script src="<?= base_url(); ?>assets/vendors/jqvmap/dist/jquery.vmap.min.js"></script>
 <script src="<?= base_url(); ?>assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
 <script src="<?= base_url(); ?>assets/svendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
 <script>
     (function($) {
         "use strict";

         jQuery('#vmap').vectorMap({
             map: 'world_en',
             backgroundColor: null,
             color: '#ffffff',
             hoverOpacity: 0.7,
             selectedColor: '#1de9b6',
             enableZoom: true,
             showTooltip: true,
             values: sample_data,
             scaleColors: ['#1de9b6', '#03a9f5'],
             normalizeFunction: 'polynomial'
         });
     })(jQuery);
 </script>

 <script>
     $('.form-check-input').on('click', function() {
         const id_menu = $(this).data('menu');
         const id_role = $(this).data('role');

         $.ajax({
             url: "<?= base_url('admin/change'); ?>",
             type: "post",
             data: {
                 id_menu: id_menu,
                 id_role: id_role
             },
             success: function() {
                 document.location.href = <?= base_url('admin/roleaccess/'); ?> + id_role;
             }
         });
     });
 </script>

 </body>

 </html>