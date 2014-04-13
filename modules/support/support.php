<?php
if(isset($_POST['send'])){
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = '['.$language['suport-subject'].'@'.$_SERVER['SERVER_NAME'].'] '.$_POST['subject'];
    $message = strip_tags($_POST['message']);
    $headers = "From: $email";
    
    $headers1 = "From: ".$configuration['site_name']."<".$configuration['email'].">";
    $message1 = "Your ticket will be answered within 48 hours";
    $message2 = $message1."\n.............................. \n".$message;
    
    if (mail($configuration['email-support'], $subject, $message, $headers) && mail($email, $subject, $message2, $headers1)) {
        print 'Your ticket will be answered within 48 hours';   
    }
    
}else{
    
    echo '<div>'.
    	'<form name="" method="post">';
	returnEditorInit();
    	

    echo '<span id="label">Nome</span> <input type="text" name="name" value="'.$configuration['site-owner'].'"></input></br>';
    
    echo '<span id="label">E-Mail</span> <input type="text" name="email" value="'.$configuration['email'].'"></input></br>';
    
    echo '<span id="label">Assunto</span> <input type="text" name="subject"></input></br>'.
    	 '<span id="label">Mensagem</span>';
    	 returnEditor('message',null);
    echo '</br>'.
    	 '<button type="submit" name="send" onclick="return confirm(\'Are you Sure?\');">Enviar</button>'.
    	 '</form></div>'; 
}
?>