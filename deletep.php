<?php 

define('_root',$_SERVER['DOCUMENT_ROOT']);
require (_root.'/PHPApps/Forum/core/init.php');

?>

<?php 
// Create Topic Object
$topic = new Topic;

// Getting the values posted from AJAX
$post_id = $_POST['postid'];

// Execute the function
$topic->deletePost($post_id);
$topic->deletePostsReplies($post_id);

?>

