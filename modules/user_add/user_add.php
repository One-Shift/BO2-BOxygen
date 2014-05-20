<h1><?php echo $language["mod-user-add-title"]; ?></h1>
    <?php
    if (!isset($_REQUEST['save'])) { 
    ?>
    <form method="post">
        <span id="label">Rank</span>
    	<select name="rank">
            <option value="null">Selecione um rank de utilizador</option>
            <option value="owner">Owner</option>
            <option value="manager">Mananger</option>
            <option value="member">Member</option>
        </select>
    	<span id="label">Nome</span>
        <input type="text" name="username"/>
        <span id="label">E-Mail</span>
        <input type="email" name="email"/>
        <span id="label">Password</span>
        <input type="password" name="password"/>	
        <span id="label">Confirme a password</span>
        <input type="password" name="confirm_password"/>
        
        <div class="bottom-area">  
              <button type="submit" name="save" onclick="if ($('input[name=password]').val() == $('input[name=confirm_password]').val() && $('input[name=password]').val() != '' && $('input[name=confirm_password]').val() != '') {return true;} else {alert('Passowrds não coincidem!'); return false;}"><?php echo $language['save']; ?></button>
        	  <button type="reset" name="cancel"><?php echo $language['cancel']; ?></button>
        </div>
    </form>    
    <?php
    }else{
        if(checkEmail($_REQUEST['email'])){        
            $user = new user();
            $user->setUsername($_REQUEST['username']);
            $user->setPassword($_REQUEST['password']);
            $user->setEmail($_REQUEST['email']);
            $user->setRank($_REQUEST['rank']);
            
            if($user->existUserByName() == 0){
                if($user->insert()){
                    print 'sucess';
                } else {
                    print 'failure';
                }
            }else{
                print 'O username ja existe';
            }
        }else{
            print'Email invalido';
            print'<script type="text/javascript">setTimeout(goBack(),2000);</script>';
        }
    }
