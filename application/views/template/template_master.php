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
    <link href="/resources/css/bootstrap.css" rel="stylesheet">
    
    <!-- Font-Awesome CSS -->
    <link href="/resources/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- MetisMenu CSS -->
    <link href="/resources/css/metisMenu.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="/resources/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/resources/css/dataTables.responsive.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="/resources/css/sb-admin-2.css" rel="stylesheet">
    
    <!-- Morris Charts CSS -->
    <link href="/resources/css/morris.css" rel="stylesheet">
    
    <!-- International Days CSS -->
    <link href="/resources/css/intdays.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="/resources/js/jquery-3.3.1.min.js"></script>
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
    
    <!-- Font Awesome 5 Pro -->
    <script src="/resources/js/fontawesome-all.min.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="/resources/js/bootstrap.min.js"></script>
    
    <!-- Metis Menu Plugin JavaScript -->
    <script src="/resources/js/metisMenu.min.js"></script>
    
    <!-- Morris Charts JavaScript -->
    <script src="/resources/js/raphael.min.js"></script>
    <script src="/resources/js/morris.min.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="/resources/js/sb-admin-2.js"></script>
    
    <!-- DataTables JavaScript -->
    <script src="/resources/js/jquery.dataTables.min.js"></script>
    <script src="/resources/js/dataTables.bootstrap.min.js"></script>
    <script src="/resources/js/dataTables.responsive.js"></script>
    
    <!-- International Days JavaScript -->
    <script src="/resources/js/intdays.js"></script>
</body>

</html>