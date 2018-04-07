<?php
$config = parse_ini_file(dirname(dirname(__FILE__))."/classes/core/config.ini", true);
?>
<meta charset="utf-8" />
<title>Sistema <?=$config['producao']['sistema']?></title>
<meta name="viewport"    content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author"      content="" />

<!--Import Google Icon Font-->
<link rel="stylesheet" href="http://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Serif:400" />

<!-- CSS -->
<link rel="stylesheet" href="/<?=$config['producao']['sistema']?>/css/init.css" />
<link rel="stylesheet" href="/<?=$config['producao']['sistema']?>/css/materialize.css" />

<!-- ICON -->
<link rel="shortcut icon" href="/<?=$config['producao']['sistema']?>/img/ico.png" />

<!-- JS -->
<?php require_once(dirname(__FILE__)."/js.php");?>