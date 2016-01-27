<?php 

define('_root',$_SERVER['DOCUMENT_ROOT']);
require (_root.'/PHPApps/Forum/core/init.php');

if(!isLoggedIn()){
    header("Location: error.php");
}
?>

<?php 


//Create Topic Object
$topic = new Topic;

if(isset($_POST['do_create'])){
    
    
    //Create Validator Object
    $validate = new Validator(); //Validator class doesn't have a constructor, hence ().
    
    //Create Data Array
    $data = array();
    $data['title'] = $_POST['title'];
    $data['body'] = $_POST['body'];
    $data['category_id'] = $_POST['category'];
    $data['user_id'] = getUser()['user_id'];
    $data['create_date'] = date("Y-m-d H:i:s");
    
    echo $data['title'];
    //Required fields
    $field_array = array('title', 'category', 'body');
    
    if($validate->isRequired($field_array)){
        //Register User
        if($topic->create($data)){
            redirect('index.php', 'Your topic has been created', 'success');
        } else {
            redirect('topic.php', 'Something went wrong with your creation', 'error');
        }
        
    }  else {
        redirect('create.php', 'Please fill in all the required fields', 'error');
    }
    
}


// Get Template & Assign vars (Getting Template Obj)
$template = new Template('templates/create.php');

// Display Template (output Template Obj)
echo $template;    
?>
