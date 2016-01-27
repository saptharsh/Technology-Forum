<?php 
// Index Controller
define('_root',$_SERVER['DOCUMENT_ROOT']);
require (_root.'/Forum/core/init.php');

?>

<?php 
// Create Topic Object
$topic = new Topic();

// Create User Object
$user = new User();


// Get Template & Assign vars (Getting Template Obj)
$template = new Template('templates/frontpage.php');

// Assign vars
$template->topics = $topic->getAllTopics();
$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();
$template->totalUsers = $user->getTotalUsers();

// Display Template (output Template Obj)
echo $template;    
?>

