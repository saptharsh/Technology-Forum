<?php

class User {

    // Init DB variable
    private $db;
    
    function __construct() {
        
        $this->db = new Database;
    }

    // Register User
    public function register($data) {
        
        // Insert query
        $this->db->query('INSERT INTO users (name, email, avatar, username, password, about, last_activity)
                          VALUES (:name, :email, :avatar, :username, :password, :about, :last_activity)');
        
        // :name, :email, :avatar, :username, :password, :about, :last_activity => placeholders
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':avatar', $data['avatar']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':about', $data['about']);
        $this->db->bind(':last_activity', $data['last_activity']);
        
        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
        
    }
    
    // Upload user Avatar
    public function uploadAvatar() {
        
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $tenp = explode(".", $_FILES["avatar"]["name"]);
        $extension = end($tenp);
        
        if((($_FILES["avatar"]["type"] == "image/gif")
            || ($_FILES["avatar"]["type"] == "image/jpeg")
            || ($_FILES["avatar"]["type"] == "image/jpg")
            || ($_FILES["avatar"]["type"] == "image/pjpeg")
            || ($_FILES["avatar"]["type"] == "image/x-png")
            || ($_FILES["avatar"]["type"] == "image/png")) 
            && ($_FILES["avatar"]["size"] < 5000000)  
            && in_array($extension, $allowedExts))    {
            
            if($_FILES["avatar"]["error"] > 0) {
                redirect('register.php', $_FILES["avatar"]["error"], 'error');
            } else {
                
                if(file_exists("images/avatars/" . $_FILES["avatar"]["name"]))  {
                    redirect('register.php', 'File already exixts', 'error');
                } else {
                    move_uploaded_file($_FILES["avatar"]["tmp_name"], "images/avatars/" . $_FILES["avatar"]["name"]);
                    //redirect('register.php', 'File uploaded successfully', 'success');
                    return true;
                }
            }   
        } else{
            redirect('register.php', 'Invalid File Type', 'error');
        }
    }
    
    // User login
    public function login($username, $password) {
        
        $this->db->query("SELECT * FROM users
                            WHERE username = :username
                            AND password = :password
                        ");
        
        // Bind values
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);
        
        $row = $this->db->single();
        
        // Check rows
        if($this->db->rowCount() > 0){
            $this->setUserData($row);
            return true;
        }  else {
            return FALSE;
        }
        
    }
    
    // Set users data
    private function setUserData($row) {
        
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_id'] = $row->id;
        $_SESSION['username'] = $row->username;
        $_SESSION['name'] = $row->name;
    }
    
    // User logout
    public function logout() {
        
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['name']);
        return TRUE;
    }
    
    // Getting total number of users
    public function getTotalUsers() {
        
        $this->db->query("SELECT * FROM users");
        $rows = $this->db->resultSet();
        return $this->db->rowCount();
    }
    
    
}




