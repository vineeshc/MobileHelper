<?php 

require_once 'PHPUnit/Extensions/Database/TestCase.php';
require_once 'testfiles/iArticleDao.php';
require_once 'testfiles/articleDAO.php';
require_once 'testfiles/PHPUnitExtensionsDatabaseOperationMySQL55Truncate.php';
class ServiceTest extends PHPUnit_Framework_TestCase
{
	// constructor of the test suite
	
	
	/**
	 * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
	 */
	public function getConnection()
	{
		$pdo = new PDO("mysql:host=192.168.1.251;dbname=accelerator","root", "Neova@2013");
	
		return $this->createDefaultDBConnection($pdo,
				"accelerator");
	}
	
	public function getSetUpOperation() {
		// whether you want cascading truncates
		// set false if unsure
		$cascadeTruncates = false;
	
		return new PHPUnit_Extensions_Database_Operation_Composite(array(
				new PHPUnit_Extensions_Database_Operation_MySQL55Truncate($cascadeTruncates),
				PHPUnit_Extensions_Database_Operation_Factory::INSERT()
		));
	}
	
	public function testSaveArticle() {  // test case for inserting new record
		$article = new ArticleDAO();		
		$article->save(array(
				"username" => "PHPsadasdNew",
				"password" => "PHPWEWEWE",
				"email" => "piyushddddd@neova.com",
				
	
		));
	}
	
	public function testUpdateArticle() { // test case for updating any record
		$article = new ArticleDAO();
		$article->update(array(
				"id" => '60',
				"username" => "PHP",
				"password" => "PHP",
				"email" => "piyush@neova.com123",
	
	
		));
	}
	public function testDeleteArticle() { // test case for deleting record
		$article = new ArticleDAO();
		$article->delete(array(
				"id" => '62',
		));
	}
	
}
?>