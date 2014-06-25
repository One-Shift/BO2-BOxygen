<?php
    include './../../configuration.php';
    include './../../connect.php';
    include './../../languages/'.$configuration['language'].'.php';
    
    header('Content-Type: text/html; charset=utf-8');
?>  
<html>
    <head>
        <title>DOCS Uploader</title>
        <script type="text/javascript" src="./../../site-assets/js/jquery.js"></script>
        <script type="text/javascript" src="./../../site-assets/js/script.js"></script>
        <style type="text/css">
            * {
                font-family: Sans-Serif;
            }
            
            label {
                display: block;
            }
            
            input {
                display: block;
                border: 1px solid lightGrey;
                width: 100%;
                height: 30px;
            }
            
            button {
                background: url('./../../site-assets/images/bg-shade-light.png');
                border: 1px solid rgb(221, 221, 221);
                line-height: 25px;
                padding-left: 5px;
                padding-right: 5px;    
            }
            
            blockquote {
                border: 1px solid lightGrey;
                padding: 5px;
                font-size: 13px;
                color: grey;
                margin: 0;
                display: inline-block;
            }
            
            img.thumb {
                max-width: 100%;
                max-height: 150px;
                margin: auto;
                display: block;
            }
            
            .spacer30 {
                height: 30px;
            }
        </style>
    </head>
    <body>
    <?php  
        // SÓ ENTRA NO UPLOADER SE O COOKIE AINDA EXISTIR
        // O UTILIZADORE TERÁ DE TER CUIDADO COM O TEMPO DE SESSÃO
        if (isset($_REQUEST['mdl']) && isset($_REQUEST['i']) && !empty($_REQUEST['mdl']) && !empty($_REQUEST['i'])) {
            $module = $mysqli->real_escape_string($_REQUEST['mdl']);
            $id = $mysqli->real_escape_string(intval($_REQUEST['i']));
            
            if (isset($_REQUEST[$configuration['cookie']])) {
                if (!isset($_REQUEST['submit'])) {
                    
                    $query = sprintf("SELECT * FROM %s_files_type WHERE upload_format = 'document'", $configuration['mysql-prefix']);
                    $source = $mysqli->query($query);
                    while ($data = $source->fetch_array(MYSQLI_ASSOC)) {
                        if (!isset($allowedFormats)) {
                            $allowedFormats = $data['extension'];
                        } else {
                            $allowedFormats .= ' '.$data['extension'];
                        }
                    }
                    
                    print 
                    '<form method="post" enctype="multipart/form-data">'.
                    '<label>Alt _1:</label>'.
                    '<input type="text" name="alt_1" maxlength="255"/>'.
                    
                    '<div class="spacer30"></div>'.
                    
                    '<label>Alt _2:</label>'.
                    '<input type="text" name="alt_2" maxlength="255"/>'.
                    
                    '<div class="spacer30"></div>'.
                    
                    '<label>File:</label>'.
                    '<input type="file" name="file"/>'.
                    
                    '<div class="spacer30"></div>'.
                    
                    '<button type="submit" name="submit" onclick="if ($(\'input[type=file]\').val() != \'\' && $(\'input[name=alt_1]\').val() != \'\') {return true;} else {alert(\'Preencha o campo ALT! Seleccione um Ficheiro!\'); return false} return false;">Submit</button>'.
                    
                    '<blockquote>Alloowed Formats: '.$allowedFormats.'</blockquote>'.
                    
                    '</form>';
                } else {
                    $query = 'SELECT * FROM '.$configuration['mysql-prefix'].'_files_type WHERE upload_format = \'document\' AND type = \''.$_FILES['file']['type'].'\'';
                    $source = $mysqli->query($query);
                    $nr = $source->num_rows;
                    
                    if ($nr > 0) {
                        $alt = $mysqli->real_escape_string(utf8_decode(strip_tags($_REQUEST['alt_1'])));
                        $alt_2 = $mysqli->real_escape_string(utf8_decode(strip_tags($_REQUEST['alt_2'])));
                        $data = $source->fetch_array(MYSQLI_ASSOC);
                        $time = time();
                        $fileName = $time.'.'.$data['extension'];
                        $filePath = './../../../u-docs/'.$fileName;
                        
                        $query = 'INSERT INTO '.$configuration['mysql-prefix'].'_documents (file, alt_1, alt_2, module, priority, id_ass, date)'.
                        ' VALUES (\''.$fileName.'\', \''.$alt.'\', \''.$alt_2.'\', \''.$module.'\', \'0\', \''.$id.'\', \''.date('Y-m-d H:i:s',$time).'\')';
                        
                        if (move_uploaded_file($_FILES["file"]["tmp_name"],$filePath)) {
                            if ($mysqli->query($query)) {
                                print '<p>File saved with sucess!</p>';
                                print '<button onclick="goTo(\''. $filePath.'\');">Uploaded File ('.$_FILES['file']['name'].')</button>';
                                print '<button onclick="goTo(\''.$_SERVER["REQUEST_URI"].'\');">Adicionar Mais</button>';
                            } else {
                                print '<p>Error Announce! The system can\'t save this entry on BD for unkown reason!</p>';
                            }
                        } else {
                            print '<p>Error Announce! The system can\'t save this file for unkown reason!</p>';
                        }
                    } else {
                        print '<p>Formato não conhecido pelo sistema!</p>';
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
