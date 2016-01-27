<?php 

define('_root',$_SERVER['DOCUMENT_ROOT']);
require (_root.'/PHPApps/Forum/core/init.php');

?>

<?php 
// Create Topic Object
$topic = new Topic;

// Get ID from URL
$topic_id = $_GET['topic'];

// Id has to be passed, as the all DB Model queries need it
if(!$topic_id){
    header("Location: error.php");
}

// Process reply
if(isset($_POST['edit_content'])){
    // Create Data Array
    $data = array();
    $data['topic_id'] = $_GET['topic'];
    $data['body'] = $_POST['body'];
    // Getiing values from the SESSION vars
    $data['user_id'] = getUser()['user_id'];
    
    // Create Validator Object
    $validate = new Validator();
    
    // Required fields
    $field_array = array('body');
    
    if($validate->isRequired($field_array)){
        // Save Reply
        if($topic->update($data)){
            redirect('topic.php?id='.$topic_id, 'Your post has succesfully saved', 'success');
        } else {
            redirect('topic.php?id='.$topic_id, 'Something went wrong with your edit', 'error');
        }
        
    } else {
        redirect('topic.php?id='.$topic_id, 'Your edit form is blank', 'error');
    }
    
}


// Get Template & Assign vars (Getting Template Obj)
$template = new Template('templates/editp.php');

//print_r($topic->getTopic($topic_id));
// Assign vars
$template->topicId = $topic_id;
$template->MainTopic = $topic->getTopic($topic_id);
$template->replies = $topic->getReplies($topic_id);
// Setting the Page left-hand side title  
$template->title = $topic->getTopic($topic_id)->title;

// Display Template (output Template Obj)
echo $template;    
?>

