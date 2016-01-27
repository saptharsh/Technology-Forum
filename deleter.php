<?php 

define('_root',$_SERVER['DOCUMENT_ROOT']);
require (_root.'/PHPApps/Forum/core/init.php');

?>

<?php 
// Create Topic Object
$topic = new Topic;

// Getting the values posted from AJAX
$reply_id = $_POST['replyid'];

// Execute the function
$topic->deleteReply($reply_id);

?>

