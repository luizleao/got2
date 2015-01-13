<?php
$config = parse_ini_file(dirname(dirname(__FILE__)) . "/classes/core/config.ini", true);
?>
<meta charset="utf-8" />
<title>Sistema <?=ucfirst($config['producao']['sistema'])?></title>
<meta name="viewport"    content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author"      content="" />

<!-- CSS -->
<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="jscalendar/css/jscal2.css" />
<link rel="stylesheet" href="jscalendar/css/border-radius.css" />
<style type="text/css">

/* Sticky footer styles
-------------------------------------------------- 
*/

html,
body {
    height: 100%;
/* The html and body elements cannot have any padding or margin. */
}

/* Wrapper for page content to push down footer */
#wrap {
    min-height: 100%;
    height: auto !important;
    height: 100%;
    /* Negative indent footer by it's height */
    margin: 0 auto -60px;
}

/* Set the fixed height of the footer here */
#push,
#footer {
    height: 60px;
}
#footer {
    background-color: #f5f5f5;
}

/* Lastly, apply responsive CSS fixes as necessary */
@media (max-width: 767px) {
    #footer {
        margin-left:   -20px;
        margin-right:  -20px;
        padding-left:  20px;
        padding-right: 20px;
    }
}

/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */

.container {
    width: auto;
    max-width: 90%;
}
.container .credit {
    margin: 20px 0;
}

.page-header{
    padding-top: 50px
}
</style>
<!-- ICON -->
<link rel="shortcut icon" href="ico/favicon.ico" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png"/>
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />

<!-- JS -->
<script type="text/javascript" src="jscalendar/js/jscal2.js"></script>
<script type="text/javascript" src="jscalendar/js/lang/pt.js"></script>
<?php require_once(dirname(__FILE__)."/js.php");?>