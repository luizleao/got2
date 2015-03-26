<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Listagem de Arquivos</title>
		<script type="text/javascript" src="ckeditor.js"></script>
		<script type="text/javascript">
                    function seleciona( arquivo ){
                        window.opener.CKEDITOR.tools.callFunction( <?php echo $num =& $_GET[ 'CKEditorFuncNum' ]; ?> , arquivo );
                        window.close();
                    }
		</script>
		<link rel="stylesheet" type="text/css" href="browser.css" />
	</head>
	<body>
            <?php
            $files = array();

            foreach ( new DirectoryIterator( $folder ) as $finfo ){
                if ( $finfo->isFile() ){
                    $pathname= $finfo->getPathname();
                    $files[] = sprintf( '<a style="background:url(\'%s\') no-repeat;" href="#" onclick="seleciona(\'%s\');">%s</a>' , $pathname , $pathname , $finfo->getFileName() );
                }
            }

            if ( count( $files ) ){
                    printf( '<ul class="fileBrowser"><li>%s</li></ul>' , implode( '</li><li>' , $files ) );
            } else echo '<h1>Nenhum arquivo encontrado.</h1>';
            
//0800-722-9090
            
            ?>
	</body>
</html>