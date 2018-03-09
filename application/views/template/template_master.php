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
    
    <!-- MetisMenu CSS -->
    <link href="/resources/css/metisMenu.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="/resources/css/sb-admin-2.css" rel="stylesheet">
    
    <!-- Morris Charts CSS -->
    <link href="/resources/css/morris.css" rel="stylesheet">
    
    <!-- International Days CSS -->
    <link href="/resources/css/intdays.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php 
        echo $template_menu . $template_pagina;
        ?>
    </div>
    
    <!-- jQuery -->
    <script src="/resources/js/jquery-3.3.1.min.js"></script>
    
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
    
    <!-- International Days JavaScript -->
    <script src="/resources/js/intdays.js"></script>
</body>
</html>