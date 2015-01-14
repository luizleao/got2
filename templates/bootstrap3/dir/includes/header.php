<?php
$config = parse_ini_file(dirname(dirname(__FILE__)) . "/classes/core/config.ini", true);
?>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Sistema <?=ucfirst($config['producao']['sistema'])?></title>

<!-- CSS -->
<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="jscalendar/css/jscal2.css" />
<link rel="stylesheet" href="jscalendar/css/border-radius.css" />

<!-- CSS Custom -->
<link href="css/navbar.css" rel="stylesheet">
<link href="css/sticky-footer-navbar.css" rel="stylesheet">

<!-- ICON -->
<link rel="shortcut icon" href="img/ico.png" />

<!-- JS -->
<script type="text/javascript" src="jscalendar/js/jscal2.js"></script>
<script type="text/javascript" src="jscalendar/js/lang/pt.js"></script>
<?php require_once(dirname(__FILE__)."/js.php");?>