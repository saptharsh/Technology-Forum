<?php 

define('_root',$_SERVER['DOCUMENT_ROOT']);
require (_root.'/PHPApps/Forum/core/init.php');

?>

<?php

// Create a Topic Object
$topic = new Topic();

// Get User from URL
$user_id = isset($_GET['user']) ? $_GET['user'] : NULL;

// Get Category from URL
$category = isset($_GET['category']) ? $_GET['category'] : NULL;

// Get Template & Assign vars (Getting Template Obj)
$template = new Template('templates/topics.php');

// Assign Template Vars
if(isset($user_id)){
    
    $template->topics = $topic->getByUser($user_id);
} 
//print_r($topic->getByUser($user_id));

// Assign Template Vars
if(isset($category)){
    
    $template->topics = $topic->getByCategory($category);
    $template->title = "Posts In " . $topic->getCategory($category)->name;
} 

// Checks if the GET var is set
if(!isset($category) && !isset($user_id)){
    
    $template->topics = $topic->getAllTopics();
}

foreach ($topic->getByUser($user_id) as $aryKey) {
    
    //echo $aryKey->username;
    $template->title = "User Name: ".$aryKey->username;
    break;
    
}
$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();

// Display Template (output Template Obj)
echo $template;
    
?>