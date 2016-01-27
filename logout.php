<?php 
// Login Controller
define('_root',$_SERVER['DOCUMENT_ROOT']);
require (_root.'/PHPApps/Forum/core/init.php');

?>

<?php

if(isset($_POST['do_logout'])){
    
    // Create User object
    $user = new User;
    
    if($user->logout()){
        
        redirect('index.php', 'You are now logged out', 'success');
    }
    
}  else {
    redirect('index.php');
}
