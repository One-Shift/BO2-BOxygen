<?php
    include './../../configuration.php';
    include './../../connect.php';
    include './../../languages/'.$configuration['language'].'.php';
    
    header('Content-Type: text/html; charset=utf-8');
?>
<html>
    <head>
    
        <title>Files List</title>
        <script type="text/javascript" src="./../../site-assets/jquery.js"></script>
        <script type="text/javascript" src="./../../site-assets/script.js"></script>
        <style type="text/css">
            * {
                font-family: Sans-Serif;
            }
            
            div#toolbar {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 30px;
                background: rgba(0,0,0,0.85);
                color: white;
                line-height: 30px;
                padding: 0 5px 0 5px;
            }
            
            div#toolbar button {
                background: transparent;
                border: none;
                color: white;
                cursor: pointer;
            }
            
            div#toolbar button:hover {
                color: orange;
            }
            
            table {
                font-size: 14px;
                width: 100%;
                border-spacing: 0;
            }
            
            table tr:hover td {
                background: rgb(240,240,240);
            }
            
            table img {
                cursor: pointer;
            }
            
            .spacer30 {
                height: 30px;
            }
        </style>
        <script type="text/javascript">
            
        </script>
    </head>
    <body>
    
    <div class="spacer30"></div>
    
    <?php  
        // SÓ ENTRA NO UPLOADER SE O COOKIE AINDA EXISTIR
        // O UTILIZADORE TERÁ DE TER CUIDADO COM O TEMPO DE SESSÃO
        if (isset($_REQUEST['mdl']) && isset($_REQUEST['i']) && !empty($_REQUEST['mdl']) && !empty($_REQUEST['i'])) {
            $module = $mysqli->real_escape_string($_REQUEST['mdl']);
            $id = $mysqli->real_escape_string(intval($_REQUEST['i']));
            
            if (isset($_REQUEST[$configuration['cookie']])) {
                print 
                '<div id="toolbar">'.
                    '<button onclick="if ($(\'input[type=radio]:checked\').val() != null) {if (confirm(\'Are You Sure?\')) {var code = $(\'input[type=radio]:checked\').val().split(\'.\'); goTo(\''.$_SERVER["REQUEST_URI"].'&tp=\' + code[1] + \'&vl=\' + code[0]);}} else {alert(\'Seleccione um ficheiro!\'); return false;}"><img src="./../../site-assets/images/icon_wrong.png" alt="del" valign="middle"/> Delete</button>'.
                    '<button onclick="goTo(\'./upload_list.php?mdl='.$module.'&i='.$id.'\');"><img src="./../../site-assets/images/icon_update.png" alt="update" valign="middle"/> Atualizar</button>'.
                '</div>';
                if (!isset($_REQUEST["tp"]) && !isset($_REQUEST["vl"])) {
                      
                    print '<table>';
                    
                    $query_i = 'SELECT * FROM '.$configuration['mysql-prefix'].'_images WHERE id_ass = \''.$id.'\' AND module = \''.$_GET["mdl"].'\'';
                    $source_i = $mysqli->query($query_i);
                    
                    while ($data_i = $source_i->fetch_array(MYSQLI_ASSOC)) {
                        print 
                        '<tr>'.
                            '<td><input type="radio" name="item" value="'.$data_i['id'].'.img"/></td>'.
                            '<td title="Alt_2: '.$data_i['alt_2'].'">'.$data_i['alt_1'].'</td>'.
                            '<td>'.$data_i['file'].'</td>'.
                            '<td><img src="./../../site-assets/images/icon_computer.png" alt="see" onclick="popUp(\'./../../../u-img/'.$data_i['file'].'\',\'640\',\'480\');"/></td>'.
                        '</tr>';
                    }
                    
                    $query_d = 'SELECT * FROM '.$configuration['mysql-prefix'].'_documents WHERE id_ass = \''.$id.'\' AND module = \''.$_GET["mdl"].'\'';
                    $source_d = $mysqli->query($query_d);
                    
                    while ($data_d = $source_d->fetch_array(MYSQLI_ASSOC)) {
                        print 
                        '<tr>'.
                            '<td><input type="radio" name="item" value="'.$data_d['id'].'.doc"/></td>'.
                            '<td>'.$data_d['alt'].'</td>'.
                            '<td>'.$data_d['file'].'</td>'.
                            '<td><img src="./../../site-assets/images/icon_computer.png" alt="see" onclick="popUp(\'./../../../u-docs/'.$data_d['file'].'\',\'640\',\'480\');"/></td>'.
                        '</tr>';
                    }
                    
                    if ($source_i->num_rows == 0 && $source_d->num_rows == 0) {
                        print '<tr>'.
                            '<td>No results found</td>'.
                        '</tr>';
                    }
                        
                    print '</table>';
                } else {
                    if ($_REQUEST["tp"] == 'img') {
                        $query_i_1 = 'SELECT * FROM '.$configuration['mysql-prefix'].'_images WHERE id = \''.intval($_REQUEST["vl"]).'\' AND module = \''.$_GET["mdl"].'\' LIMIT 1';
                        $source_i_1 = $mysqli->query($query_i_1);
                        $data_i_1 = $source_i_1->fetch_array(MYSQLI_ASSOC);
                        
                        $query_i_2 = 'DELETE FROM '.$configuration['mysql-prefix'].'_images WHERE id = \''.$data_i_1['id'].'\'';
                        if ($mysqli->query($query_i_2)) {
                            unlink('./../../../u-img/'.$data_i_1['file']) or die();
                            print '<p>Ficheiro Apagado com Sucesso</p>';
                        } else {
                            print '<p>Erro encontrado ao tentar imprimir</p>';
                        }    
                    } else if ($_REQUEST["tp"] == 'doc') {
                        $query_d_1 = 'SELECT * FROM '.$configuration['mysql-prefix'].'_documents WHERE id = \''.intval($_REQUEST["vl"]).'\' AND module = \''.$_GET["mdl"].'\' LIMIT 1';
                        $source_d_1 = $mysqli->query($query_d_1);
                        $data_d_1 = $source_d_1->fetch_array($source_d_1);
                        
                        $query_d_2 = 'DELETE FROM '.$configuration['mysql-prefix'].'_documents WHERE id = \''.$data_d_1['id'].'\'';
                        if ($mysqli->query($query_d_2)) {
                            unlink('./../../../u-docs/'.$data_d_1['file']) or die();
                            print '<p>Ficheiro Apagado com Sucesso</p>';
                        } else {
                            print '<p>Erro encontrado ao tentar imprimir</p>';
                        } 
                    } else {
                        print '<p>Erro encontrado ao tentar apagar o ficheiro pretendido!</p>';
                    }
                }
                
            } else {
                print '<p>Please login first!</p>';
            }
        } else {
            print '<p>The module can\'t be initialized!</p>';
        }
        
    ?>
    </body>
</html>
