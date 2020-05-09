    </div>
</div>

    <!-- JavaScript -->
    <script src="js/vendors/jquery.min.js"></script>
    <script src="js/vendors/jquery-ui/jquery-ui.js"></script>
    <script src="js/vendors/tinymce/tinymce.min.js"></script>
    <script src="js/vendors/malsup.jquery.form.js"></script>
    <script src="js/vendors/select2/js/select2.full.js" type="text/javascript"></script>

    <script src="js/backend/min/backend-dependencies.min.js"></script>
    <script src="js/backend/backend-core.js"></script>
    <script src="js/backend/backend-modules.js"></script>
	<script src="js/vendors/fancybox/source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="js/vendors/fancybox/source/jquery.fancybox.css" />

    <script src="js/vendors/selectize/js/standalone/selectize.js"></script>
    <link rel="stylesheet" type="text/css" href="js/vendors/selectize/css/selectize.css" />


    <script type="text/javascript">

    $(".fancybox").fancybox({
            helpers: {
                overlay: {
                  locked: false
                }
              }
        });

    $(".fancybox-big").fancybox({
            width: "100%",
            helpers: {
                overlay: {
                  locked: false
                }
              }
        });

    $(".fancy_link").fancybox({
            'titlePosition': 'over',
            'hideOnContentClick': true,
            'width': 800,
            'autoScale': false,
            'autoDimensions': false,
            helpers: {
                overlay: {
                  locked: false
                }
              }
        });
    $(".fancyclose").fancybox({
            afterClose: function() {
                window.location.reload();
            },
            helpers: {
                overlay: {
                  locked: false
                }
              }
        });

    $(".fancybox-big-close").fancybox({
            width: "100%",
            afterClose: function() {
                window.location.reload();
            },
            helpers: {
                overlay: {
                  locked: false
                }
              }
        });
    </script>


</body>
</html>