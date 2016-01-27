<?php 

define('_root',$_SERVER['DOCUMENT_ROOT']);
require (_root.'/PHPApps/Forum/core/init.php');

?>

<?php 
// Create Topic Object
$topic = new Topic;

// Get ID from URL
$topic_id = $_GET['id'];

// Id has to be passed, as the all DB Model queries need it
//if(!$topic_id){
  //  header("Location: error.php");
//}

// Process reply
if(isset($_POST['do_reply'])){
    // Create Data Array
    $data = array();
    $data['topic_id'] = $_GET['id'];
    $data['body'] = $_POST['body'];
    $data['user_id'] = getUser()['user_id'];
    $data['create_date'] = date("Y-m-d H:i:s");
    // Create Validator Object
    $validate = new Validator();
    
    // Required fields
    $field_array = array('body');
    
    if($validate->isRequired($field_array)){
        // Save Reply
        if($topic->reply($data)){
            redirect('topic.php?id='.$topic_id, 'Your reply has been saved', 'success');
        } else {
            redirect('topic.php?id='.$topic_id, 'Something went wrong with your reply', 'error');
        }
        
    } else {
        redirect('topic.php?id='.$topic_id, 'Your reply form is blank', 'error');
    }
    
}


// Get Template & Assign vars (Getting Template Obj)
$template = new Template('templates/topic.php');

// Assign vars
$template->topicId = $topic_id;
$template->MainTopic = $topic->getTopic($topic_id);
$template->replies = $topic->getReplies($topic_id);

//print_r($topic->getReplies($topic_id));
// Setting the Page left-hand side title  
$template->title = $topic->getTopic($topic_id)->title;

// Display Template (output Template Obj)
echo $template;    
?>

