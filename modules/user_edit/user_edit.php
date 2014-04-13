 <?php if(isset($_REQUEST['i']) && !empty($_REQUEST['i'])){ ?>
<h1><?php echo $language["mod-user-edit-title"]; ?></h1>
    <?php if (!isset($_REQUEST['save'])) { 
        $user_edit= new user();
        $user_edit->setId(intval($_REQUEST['i']));
        $tmp = $user_edit->returnOneUser();
    ?>
    <form method="post">
        <span id="label">Rank</span>
        <select name="rank">
            <option value="null">Selecione um rank de utilizador</option>
            <option value="owner" <?php if($tmp['rank'] == 'owner') print 'SELECTED';?> >Owner</option>
            <option value="manager" <?php if($tmp['rank'] == 'manager') print 'SELECTED';?> >Manager</option>
            <option value="member" <?php if($tmp['rank'] == 'member') print 'SELECTED';?> >Member</option>
        </select>
    	<span id="label">Nome</span>
        <input type="text" name="username" readonly="readonly" value="<?php print $tmp['name']; ?>"/>
        <span id="label">E-Mail</span>
        <input type="email" name="email" value="<?php print $tmp['email']; ?>"/>
        <span id="label">Password</span>
        <input type="password" name="password"/>	
        <span id="label">Confirme a password</span>
        <input type="password" name="confirm_password"/>
        
        <div class="separator30"></div>
        
        <span id="label">Lista de ficheiros</span>
        <?php returnFilesList($tmp['id'],'user'); ?>
        
        <div class="separator30"></div>
        
        <?php
            returnImgUploader('IMG Uploader',$tmp['id'],'user','290',350);
            print ' ';
            returnDocsUploader('DOCS Uploader',$tmp['id'],'user','290',350);
        ?>
        
        <div class="bottom-area">  
              <button type="submit" name="save" onclick="if ($('input[name=password]').val() != '') {if ($('input[name=password]').val() == $('input[name=confirm_password]').val()) {return true;} else {alert('Passowrds não coincidem!'); return false;}} else {return true;}">
              <?php echo $language['save']; ?></button>
        	  <button type="reset" name="cancel"><?php echo $language['cancel']; ?></button>
        </div>
    </form>    
    <?php
        
    }else{
        
        if(checkEmail($_REQUEST['email'])){ 
            $user = new user();
            $user->setId($_REQUEST['i']);
            $tmp = $user->returnOneUser();
            $user->setUsername($tmp['name']);
            
            if(!empty($_REQUEST['password']) && !empty($_REQUEST['confirm_password'])){ 
                if($_REQUEST['password'] == $_REQUEST['confirm_password']){
                    $user->setPassword($_REQUEST['password']);
                }else{
                    print 'Passwords erradas';
                }
                
            }else if(empty($_REQUEST['password']) && empty($_REQUEST['confirm_password'])){
                $user->setOldPassword($tmp['password']);
            }else{
                print 'ola';
            }
                
            $user->setEmail($_REQUEST['email']);
            $user->setRank($_REQUEST['rank']);
            
            if($user->update()){
                print 'sucess';
            } else {
                print 'failure';
            }
        }else{
            print 'Email invalido';
            //print'<script type="text/javascript">setTimeout(goBack(),2000);</script>';
        }
    }
}else{
    print 'error';
}
    ?>