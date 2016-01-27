<?php 

define('_root',$_SERVER['DOCUMENT_ROOT']);
require (_root.'/PHPApps/Forum/core/init.php');

?>

<?php 
// Create Topic Object
$topic = new Topic;

// Get ID from URL
$reply_id = $_GET['reply'];
$topic_id = $_GET['topic'];

//echo $topic_id;
// Id has to be passed, as the all DB Model queries need it
//if(!$reply_id){
    //header("Location: error.php");
//}

// Process reply
if(isset($_POST['edit_reply'])){
    // Create Data Array
    $data = array();
    $data['id'] = $_GET['reply'];
    $data['body'] = $_POST['body'];
    $data['user_id'] = getUser()['user_id'];
    
    // Create Validator Object
    $validate = new Validator();
    
    // Required fields
    $field_array = array('body');
    
    if($validate->isRequired($field_array)){
        // Save Reply
        if($topic->updateReply($data)){
            redirect('topic.php?id='.$topic_id, 'Your reply has been saved', 'success');
        } else {
            redirect('topic.php?id='.$topic_id, 'Something went wrong with your reply', 'error');
        }
        
    } else {
        redirect('topic.php?id='.$topic_id, 'Your reply form is blank', 'error');
    }
    
}


// Get Template & Assign vars (Getting Template Obj)
$template = new Template('templates/editr.php');

// Assign vars
$template->topicId = $topic_id;
$template->replyId = $reply_id;
//print_r($template->replyId);
$template->MainTopic = $topic->getTopic($topic_id);
$template->replies = $topic->getReplies($topic_id);

// Get replies of the present user
//$template->replies = $topic->getSingleReply();
 
// Setting the Page left-hand side title  
$template->title = $topic->getTopic($topic_id)->title;

// Display Template (output Template Obj)
echo $template;    
?>

