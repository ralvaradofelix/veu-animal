<?php
/**
 * Helper de Form
 */
class HelpForm
{
    public static function validEmail($email) {
        return preg_match('/^[A-Za-z0-9_.-]+@[A-Za-z0-9_.-]+\.[A-Za-z0-9_]+$/',$email);
    }
    
    public static function validImage( $name ) {
        $extensions = array('jpg','jpeg','gif','png','tif','bmp');
        
        return true;
    }
}

