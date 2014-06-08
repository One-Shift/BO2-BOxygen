<?php
    if(isset($_REQUEST['i']) && !empty($_REQUEST['i'])){ 
        $user = new user();
        $user->setId($_REQUEST['i']);
        if($user->delete()) print 'sucess'; else print 'error';
    }else{
        print 'error';
    }
?>