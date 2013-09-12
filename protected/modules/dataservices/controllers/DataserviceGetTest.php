<?php 

require_once 'PHPUnit/Extensions/Database/TestCase.php';
require_once 'testfiles/iArticleDao.php';
require_once 'testfiles/articleDAO.php';
require_once 'testfiles/PHPUnitExtensionsDatabaseOperationMySQL55Truncate.php';
class DataserviceGetTest extends PHPUnit_Extensions_Database_TestCase
{
	// constructor of the test suite
	
	
	/**
	 * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
	 */
	public function getConnection()
	{
		$pdo = new PDO("mysql:host=192.168.1.251;dbname=accelerator","root", "root");
	
		return $this->createDefaultDBConnection($pdo,
				"accelerator");
	}
	public function getDataSet() {
		return $this->createXMLDataSet("seed.xml");
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
	/*public function testInsertArticle() {
		$article = new ArticleDAO();
		$article->insert(array(
				"username" => "PHPsadasdNew",
				"password" => "PHPWEWEWE",
				"email" => "piyushddddd@neova.com",
	
	
		));
	}*/
	
	/*
	 *  this is to insert and test the select with respect to xml files*/
	public function testSaveArticle() {
		$article = new ArticleDAO();		
		$article->save(array(
				"username" => "PHPsadasdNew",
				"password" => "PHPWEWEWE",
				"email" => "piyushddddd@neova.com",
				
	
		));
		$resultingTable = $this->getConnection()->createQueryTable("users","SELECT * FROM users");
		
		$expectedTable = $this->createXmlDataSet("expectedArticles.xml")->getTable("users");
		$this->assertTablesEqual($expectedTable,$resultingTable);
		
	}
	
	/*public function testUpdateArticle() {
		$article = new ArticleDAO();
		$article->update(array(
				"id" => '1',
				"username" => "PHP",
				"password" => "PHP",
				"email" => "piyush@neova.com123111",
	
	
		));
	}
	public function testDeleteArticle() {
		$article = new ArticleDAO();
		$article->delete(array(
				"id" => '2',
		));
	}
	*/
	
	
	
	
	
	
}
?>
