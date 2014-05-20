<?php
    function returnFilesList($id,$module) {
        print '<iframe src="./modules/upload/upload_list.php?mdl='.$module.'&i='.$id.'">Your Browser do not support iframe method!</iframe>';
    }

    function returnImgUploader($button,$id,$module,$width,$height) {
        print '<button type="button" onclick="popUp(\'./modules/upload/upload_script_img.php?mdl='.$module.'&i='.$id.'\',\''.$width.'\',\''.$height.'\'); return false;">'.$button.'</button>';
    }

    function returnDocsUploader($button,$id,$module,$width,$height) {
        print '<button type="button" onclick="popUp(\'./modules/upload/upload_script_docs.php?mdl='.$module.'&i='.$id.'\',\''.$width.'\',\''.$height.'\'); return false;">'.$button.'</button>';
    }

    function returnVideosUploader($id,$module) {
        include "./modules/upload_videos/upload_videos_frame.php";
    }
    
    function returnEditorInit () {
        //print "<script type=\"text/javascript\">bkLib.onDomLoaded(function() { nicEditors.allTextAreas({fullPanel : true}) });</script>";
        
    }
    
   function returnEditor($textareanema,$content) {
        print "<textarea name=\"".$textareanema."\" id=\"".$textareanema."\" style=\"width: 100%;\">"
                    .$content
                ."</textarea>";
                
        printf("<script type=\"text/javascript\">new nicEditor({fullPanel : true}).panelInstance('%s');</script>", $textareanema);
    }
    
    function getBrowser() {
        $browser = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($browser, "MSIE 6.0") > -1) {
            return false;
        } else if (strpos($browser, "MSIE 7.0") > -1) {
            return false;
        } else if (strpos($browser, "MSIE 8.0") > -1) {
            return false;
        } else {
            return true;
        }
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

    function returnUserName($id) {
        global $configuration;

        $query = "SELECT name FROM ".$configuration["mysql-prefix"]."_users WHERE id = '".$id."' LIMIT 1";
        $source = mysql_query($query);
        $nr = mysql_num_rows($source);

        if ($nr > 0) {
                $data = mysql_fetch_array($source);

                return $data["name"];
        }
        return null;
    }
    
    function checkEmail($email) {
	  if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email)){
	    list($username,$domain) = explode('@',$email);
	    return true;
	  }
	  return false;
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

    print generateRandomString (50);

    
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
