<?php

class Topic {

    // Initialize the DB variable
    private $db;

    public function __construct() {

        $this->db = new Database;
    }

    /* index.php controller */

    // Get all topics
    public function getAllTopics() {

        $this->db->query("SELECT topics.*, users.username, users.avatar, categories.name
                            FROM topics
                            INNER JOIN users
                            ON topics.user_id = users.id
                            INNER JOIN categories
                            ON topics.category_id = categories.id
                            ORDER BY create_date DESC");

        // Assign Result Set
        $results = $this->db->resultSet();

        return $results;
    }

    // Get total number of Topics
    public function getTotalTopics() {

        $this->db->query('SELECT * FROM topics');
        $rows = $this->db->resultSet();

        // Before calling rowCount(), resultSet() should be called. As there is not execute() in rowCount()
        return $this->db->rowCount();
    }

    // Get total number of Categories
    public function getTotalCategories() {

        $this->db->query('SELECT * FROM categories');
        $rows = $this->db->resultSet();

        // Before calling rowCount(), resultSet() should be called. As there is not execute() in rowCount()
        return $this->db->rowCount();
    }

    // Get total number of Replies
    public function getTotalReplies($topic_id) {

        $this->db->query('SELECT * FROM replies WHERE topic_id =' . $topic_id);
        $rows = $this->db->resultSet();

        // Before calling rowCount(), resultSet() should be called. As there is not execute() in rowCount()
        return $this->db->rowCount();
    }

    /* topics.php controller */

    // Get Topics by Category
    public function getByCategory($category_id) {

        $this->db->query("SELECT topics.*, categories.*, users.username, users.avatar FROM topics
                            INNER JOIN categories
                            ON topics.category_id = categories.id
                            INNER JOIN users
                            ON topics.user_id=users.id
                            WHERE topics.category_id = :category_id			
                        ");

        $this->db->bind(':category_id', $category_id);

        //Assign Result Set
        $results = $this->db->resultset();

        return $results;
    }

    // Get Category By ID
    public function getCategory($category_id) {

        $this->db->query("SELECT * FROM categories WHERE id = :category_id
                        ");

        $this->db->bind(':category_id', $category_id);

        //Assign Row
        $row = $this->db->single();

        return $row;
    }

    // Get Topics By Username
    public function getByUser($user_id) {
        $this->db->query("SELECT topics.*, categories.*, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
						WHERE topics.user_id = :user_id
                		");
        
        $this->db->bind(':user_id', $user_id);

        //Assign Result Set
        $results = $this->db->resultset();

        return $results;
    }

    /* topic.php controller */

    // Get Topic by ID
    public function getTopic($id) {

        $this->db->query("SELECT topics.*, users.username, users.name, users.avatar FROM topics
                		INNER JOIN users
                        	ON topics.user_id = users.id
                    		WHERE topics.id = :id			
                            ");

        $this->db->bind(':id', $id);

        //Assign Row
        $row = $this->db->single();

        return $row;
    }

    // Get Topic Replies
    public function getReplies($topic_id) {

        $this->db->query("SELECT replies.*, users.name, users.email, users.avatar, users.username
                                FROM replies
                		INNER JOIN users
				ON replies.user_id = users.id
				WHERE replies.topic_id = :topic_id 
				ORDER BY create_date ASC	
                            ");

        $this->db->bind(':topic_id', $topic_id);

        // Assign Result Set
        $results = $this->db->resultset();

        return $results;
    }

    // Create Topic
    public function create($data) {
        // Insert Query
        $this->db->query("INSERT INTO topics (category_id, user_id, title, body, create_date)
                            VALUES (:category_id, :user_id, :title, :body, :create_date)");
        
        // Bind Values
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':create_date', $data['create_date']);
        
        // Execute 
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
        
    }
    
    // Add Reply 
    public function reply($data) {
        // Insert Query
        $this->db->query("INSERT INTO replies (topic_id, user_id, body, create_date)
                            VALUES (:topic_id, :user_id, :body, :create_date)");
        
        // Bind Values
        $this->db->bind(':topic_id', $data['topic_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':create_date', $data['create_date']);
        
        // Execute
        if($this->db->execute()){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // Update the POST
    public function update($data) {
        // Update Query
        $this->db->query("UPDATE topics SET body = :body WHERE id = :id");
        
        // Bind Values
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':id', $data['topic_id']);
        
        // Execute
        if($this->db->execute()){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // Update the Reply
    public function updateReply($data) {
        // Update reply query
        $this->db->query("UPDATE replies SET body = :body WHERE id = :id AND user_id = :user_id");
        
        // Bind Values
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':user_id', $data['user_id']);
        
        // Execute
        if($this->db->execute()){
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
    
    // Deleting specific REPLY
    public function deleteReply($data) {
        
        $this->db->query("DELETE FROM replies WHERE id = :replyid");
        
        // Bind Values, Custom defined function
        $this->db->bind(':replyid', $data);
        
        // Execute
        if($this->db->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // Deleting specific POST
    public function deletePost($data) {
        
        $this->db->query("DELETE FROM topics WHERE id = :postid");
        
        // Bind Values, Custom defined function
        $this->db->bind(':postid', $data);
        
        // Execute
        if($this->db->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // Deleting all the replies associated with the POST 
    public function deletePostsReplies($data) {
        
        $this->db->query("SELECT id FROM replies WHERE topic_id = :postid");
        
        // Bind Values, Custom defined function
        $this->db->bind(':postid', $data);
        
        $results = $this->db->resultSet();
        
        foreach ($results as $result) {
            
            $this->db->query("DELETE FROM replies WHERE id = :repliesid");
            
            $this->db->bind(':repliesid', $result->id);
            
            // Execute
            if($this->db->execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        
    }
    
}












