</div><!-- end main -->
<!-- /#wrapper -->
    <!-- jQuery -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.js?v=<?= time() ?>"></script>


    <script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->

    <!-- Plugin JavaScript -->
    <script src="plugins/bower_components/moment/moment.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>

    <!-- Color Picker Plugin JavaScript -->
    <script src="plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>
    
    <!--Style Switcher -->
    <script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="plugins/bower_components/switchery/dist/switchery.min.js"></script>
    <script src="plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
    <script src="plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>

     <script src="plugins/bower_components/summernote/dist/summernote.min.js"></script>
     <script src="plugins/bower_components/tinymce/tinymce.min.js"></script>

    
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    
    <script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

    

    <script>
            jQuery(document).ready(function () {



                // Switchery
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                $('.js-switch').each(function () {
                    new Switchery($(this)[0], $(this).data());
                });
                // For select 2
                $(".select2").select2();
                $('.selectpicker').selectpicker();
                

                // Date Picker
                jQuery('.datepicker, #datepicker').datepicker();


                // For multiselect
                $('#pre-selected-options').multiSelect();
                $('#optgroup').multiSelect({
                    selectableOptgroup: true
                });
                $('#public-methods').multiSelect();
                $('#select-all').click(function () {
                    $('#public-methods').multiSelect('select_all');
                    return false;
                });
                
                $('#deselect-all').click(function () {
                    $('#public-methods').multiSelect('deselect_all');
                    return false;
                });
                $('#refresh').on('click', function () {
                    $('#public-methods').multiSelect('refresh');
                    return false;
                });
                $('#add-option').on('click', function () {
                    $('#public-methods').multiSelect('addOption', {
                        value: 42
                        , text: 'test 42'
                        , index: 0
                    });
                    return false;
                });
            

                $('.summernote').summernote({
                    height: 350, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: false // set focus to editable area after initializing summernote
                });
                $('.inline-editor').summernote({
                    airMode: true
                });


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

                
                if ($(".tinymce-mini").length > 0) {
                     
                    tinymce.init({
                        selector: '.tinymce-mini',
                        theme: "modern",
                        plugins: [
                            ["advlist autolink link image lists charmap hr anchor pagebreak"],
                            ["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"],
                            ["table contextmenu directionality paste textcolor"]
                        ],
                        toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | forecolor backcolor | code",
                        statusbar: false,
                        language : 'es',
                        height: 250,
                        menubar : false
                    });

                } // end if tinymce



            });

        </script>


</body>

</html>