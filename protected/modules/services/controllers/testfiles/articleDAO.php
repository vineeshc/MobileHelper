<?php
require_once 'iArticleDao.php';
class ArticleDAO implements IArticleDAO
{
  /* */ public function save($article) {
        $db = new PDO(
            "mysql:host=192.168.1.251;dbname=accelerator", 
            "root", "Neova@2013");

        $stmt = $db->prepare("INSERT INTO users (username,password,email) value (:username,:password,:email)");        
        $stmt->execute($article);                 
        return true;
    }
    /* */ 
    public function insert($article) {
    $db = new PDO(
    		"mysql:host=192.168.1.251;dbname=accelerator",
    		"root", "Neova@2013");
    
    $stmt = $db->prepare("INSERT INTO users (username,password,email) value (:username,:password,:email)");
    $stmt->execute($article);
    return true;
    }
   
    
    public function update($article) {
    	
    	$db = new PDO(
    			"mysql:host=192.168.1.251;dbname=accelerator",
    			"root", "Neova@2013");    
    	
    	$stmt = $db->prepare("UPDATE users SET username = :username, password = :password, email = :email  WHERE id = :id ");    	
    	$stmt->execute($article);
    	return true;
    }
    
    public function delete($article) {
    	 
    	$db = new PDO(
    			"mysql:host=192.168.1.251;dbname=accelerator",
    			"root", "Neova@2013");
    	 
    	$stmt = $db->prepare("DELETE FROM users  WHERE id = :id ");
    	$stmt->execute($article);
    	return true;
    }
    public function getArticles($sectionId){
    }
    
    public function getSingleArticle($article) { 
		
    	$db = new PDO(
    			"mysql:host=192.168.1.251;dbname=accelerator",
    			"root", "Neova@2013");   	
    	
    	$stmt = $db->prepare("SELECT * FROM users");    	
    	$rs = $stmt->execute($article);    	
    	print_r($rs);
    	exit;
    	    	
    	return true;
    }
    
    
  /* public function getSingleRecord($article){  
    	$db = new PDO(
    	"mysql:host=192.168.1.251;dbname=accelerator",
    	"root", "Neova@2013");    	
    	$stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    	$result =  $stmt->execute($article);
    	return true;
    	
    }*/
}
?>
