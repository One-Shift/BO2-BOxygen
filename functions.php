<?php
    function returnFilesList ( $id, $module) {
        return sprintf ('<iframe src="./modules/upload/upload_list.php?mdl=%s&i=%s">Your Browser do not support iframe method!</iframe>',
        $module, $id);
    }

    function returnImgUploader ( $button, $id, $module, $width, $height) {
        return sprintf ('<button type="button" onclick="popUp(\'./modules/upload/upload_script_img.php?mdl=%s&i=%s\',\'%s\',\'%s\'); return false;">'.$button.'</button>', 
        $module, $id, $width, $height);
    }

    function returnDocsUploader ( $button, $id, $module, $width, $height) {
        return sprintf ('<button type="button" onclick="popUp(\'./modules/upload/upload_script_docs.php?mdl=%s&i=%s\',\'%s\',\'%s\'); return false;">'.$button.'</button>',
        $module, $id, $width, $height);
    }
    
    function returnEditorInit () {
        //print "<script type=\"text/javascript\">bkLib.onDomLoaded(function() { nicEditors.allTextAreas({fullPanel : true}) });</script>";
        
    }
    
   function returnEditor($textareanema,$content) {
        return sprintf("<textarea name=\"%s\" id=\"%s\" style=\"width: 670px;\">%s</textarea>"
        ."<script type=\"text/javascript\">new nicEditor({fullPanel : true}).panelInstance('%s');</script>",
        $textareanema, $textareanema, $content, $textareanema);
    }

    function returnImageExt($filetype) {
        switch ($filetype) {
            case "image/jpg":
                    return "jpg";
                    break;
            case "image/jpeg":
                    return "jpg";
                    break;
            case "image/png":
                    return "png";
                    break;
            case "image/bmp":
                    return "bmp";
                    break;
            default:
                    return null;
                    break;
        }
    }
  
    function sendEmail ($from, $to, $subject, $message) {
        $headers = 'From: '.$from."\r\n" .
    	'Reply-To: '.$from;
    
        return mail($to, $subject, $message, $headers);
    }
    
    function sendEmailHTML($from,$to,$subject,$message) {

		// subject -> Argumento

		// message -> Argumento
		$message = "
		<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\" dir=\"ltr\">
		<head></head>
		<body>".$message."</body>
		</html>";
		
		$message =  utf8_decode($message);
		

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= "From: ".$from." <".$from.">" . "\r\n";

		// Mail it
		return mail($to, $subject, $message, $headers);
	}

    function generateRandomString($length = 10) {
    	
    	// work 100%
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        // in beta testing
        $characters = '!#$%&()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_abcdefghijklmnopqrstuvwxyz{|}~';
        
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $randomString;
    }

    
/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'x', $img = false, $atts = array() ) {
	
	$url = 'http://www.gravatar.com/avatar/';
	
	$url .= md5( strtolower( trim( $email ) ) );
	
	$url .= "?s=$s&d=$d&r=$r";
	
	if ( $img ) {
		$url = '<img src="' . $url . '"';
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	
	return $url;
}
?>
