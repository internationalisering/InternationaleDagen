<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title><?php echo $titel; ?></title>
    
    
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url(); ?>/resources/css/bootstrap.css" rel="stylesheet">
    
    <!-- Font-Awesome CSS -->
    <link href="<?= base_url(); ?>/resources/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- MetisMenu CSS -->
    <link href="<?= base_url(); ?>/resources/css/metisMenu.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="<?= base_url(); ?>/resources/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/resources/css/dataTables.responsive.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>/resources/css/sb-admin-2.css" rel="stylesheet">
    
    <!-- Morris Charts CSS -->
    <link href="<?= base_url(); ?>/resources/css/morris.css" rel="stylesheet">
    
    <!-- Jquery UI CSS -->
    <link href="<?= base_url(); ?>/resources/css/jquery-ui.min.css" rel="stylesheet">
    
    <!-- jQuery hour picker -->
    <link href="<?= base_url(); ?>/resources/css/jquery.ui.timepicker.css" rel="stylesheet">

    <!-- International Days CSS -->
    <link href="<?= base_url(); ?>/resources/css/intdays.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="<?= base_url(); ?>/resources/js/jquery-3.3.1.min.js"></script>
    <script>
        function base_url()
        {
            return "<?= base_url() ?>";
        }

        function site_url()
        {
            return "<?= site_url() ?>";
        }

    </script>
</head>
<body>
    <div id="wrapper">
        <?php 
        echo $template_menu . $template_pagina;
        ?>
    </div>
    
<footer class="footer">
      <div class="container">
        <span class="text-muted">Teamnr 27 - Brend Simons, Tom Van Den Rul, Quinten Van Casteren, Vincent Duchateau - <?php echo "Verantwoordelijke: " . (isset($verantwoordelijke)?$verantwoordelijke:"In te vullen"); ?> - Tinne Van Echelpoel</span>
      </div>
</footer>
    
    <!-- JQuery UI JavaScript -->
    <script src="<?= base_url(); ?>/resources/js/jquery-ui.min.js"></script>
    
    <!-- Font Awesome 5 Pro -->
    <script src="<?= base_url(); ?>/resources/js/fontawesome-all.min.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url(); ?>/resources/js/bootstrap.min.js"></script>
    
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= base_url(); ?>/resources/js/metisMenu.min.js"></script>
    
    <!-- Morris Charts JavaScript -->
    <script src="<?= base_url(); ?>/resources/js/raphael.min.js"></script>
    <script src="<?= base_url(); ?>/resources/js/morris.min.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url(); ?>/resources/js/sb-admin-2.js"></script>
    
    <!-- DataTables JavaScript -->
    <script src="<?= base_url(); ?>/resources/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/resources/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/resources/js/dataTables.responsive.js"></script>
    
    <!-- jQuery hour picker -->
    <script src="<?= base_url(); ?>/resources/js/jquery.ui.timepicker.js"></script>

    <!-- International Days JavaScript -->
    <script src="<?= base_url(); ?>/resources/js/intdays.js"></script>

    <!-- Modal -->
    <div id="modal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div id='modal-content' class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <p>Some text in the modal.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>


</body>

</html>