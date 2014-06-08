<?php
    if(isset($_REQUEST['i']) && !empty($_REQUEST['i'])){
        $product = new product();
        $product->setId($_REQUEST['i']);
        if($product->delete()) print 'sucess'; else print 'error';
    }else{
        print 'error';
    }
?>