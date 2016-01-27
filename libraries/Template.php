<?php

/*
 * Creates a template/view object
 */
class Template {

    // Path to template
    protected $template;
            
    // Variables passed in
    protected $vars = array();
    
    public function __construct($template) {
        
        $this->template = $template;
    }

    // Get template variables
    public function __get($key) {
        
        //echo "Getting '$key'\n";
        return $this->vars[$key];
    }
    
    // Set template variables
    public function __set($key, $value) {
        
        
        $this->vars[$key] = $value;
        //echo "Setting '$this->vars[$key]' to '$value'\n";
    }
    
    // Convert Object to String
    public function __toString() {
        
        extract($this->vars);
        // chdit => Change Dir
        chdir(dirname($this->template));
        // on => Output Buffer, the output from the App is stored in the buffer and is not rendered to users
        ob_start();
        
        include basename($this->template);
        
        return ob_get_clean();
    }
    
    
    
    
    
    
    
    
    
}