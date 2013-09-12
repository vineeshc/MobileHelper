<?php
interface IArticleDao
{
    // here is the new method for saving	
	public function insert($article); // for insert test
    public function save($article); //save and select for match
    public function update($article); // for update test
    public function delete($article); // for delete test    
    
   // public function getArticles($article);
    

    // already implemented in the first article
  //  public function getSingleRecord($sectionId);
   // public function getAll();
}
?>