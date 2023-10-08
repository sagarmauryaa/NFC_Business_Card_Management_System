 <footer class="footer">
     <div class="d-flex justify-content-center">
         <span class="text-muted text-center">Copyright &copy; <?php echo date("Y"); ?> Powered by <a href="#" target="_blank">FebbleSpot</a></span>
     </div>
 </footer>

 </div>
 <!-- main-panel ends -->
 </div>
 <!-- page-body-wrapper ends -->
 </div>
 <!-- container-scroller -->
 <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
 <script src="./vendors/js/vendor.bundle.base.js"></script>
 <script src="./assets/js/jquery.cookie.js" type="text/javascript"></script>
 <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
 <!-- <script type="text/javascript" src="./vendors/ckeditor/build/ckeditor.js"></script> -->



 <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js" type="text/javascript"></script>
 <!-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js" type="text/javascript"></script> -->
 <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>
 <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/locales/LANG.js"></script>


 <script src="./vendors/chart.js/chart.min.js"></script>
 <script src="./assets/js/Chart.roundedBarCharts.js"></script>
 <script src="./vendors/DataTables/datatables.min.js"></script>
 <script src="./vendors/jquery.repeater/jquery.repeater.min.js"></script>
 <!-- custom js for this page-->
 <!-- <?php
        if (basename($_SERVER['PHP_SELF']) == "manage-questions.php") {
            echo '<script src="./class/load-questions.js"></script>';
        }
        ?>
 <?php
    if (basename($_SERVER['PHP_SELF']) == "manage-banners.php" || basename($_SERVER['PHP_SELF']) == "manage-homepage.php" || basename($_SERVER['PHP_SELF']) == "settings.php" || basename($_SERVER['PHP_SELF']) == "post-new-blog.php") {
        echo '<script src="./assets/js/banners.js"></script>';
    }
    ?> -->
 <script src="./assets/js/template.js"></script>
 <script src="./assets/js/settings.js"></script>
 <script src="./class/data.js"></script>
 <script>
     CKEDITOR.replace('address');
     CKEDITOR.replace('bio');
     CKEDITOR.replace('bank_details');
 </script>
 <!-- End custom js for this page-->
 </body>

 </html>