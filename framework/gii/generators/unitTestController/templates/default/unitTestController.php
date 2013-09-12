<?php
/**
 * This is the template for generating a controller class file.
 * The following variables are available in this template:
 * - $this: the ControllerCode object
 */
?>
<?php  echo "<?php\n"; ?>
ob_start();
<?php
// print_r($this->tableSchema->primaryKey)
//print_r($this);
?>

class <?php echo strtolower($this->model)."TestController" ?> extends CDbTestCase { <?php echo "\n"; ?>

	// constructor of the test suite
	
	public function testactionPost<?php echo $this->modelClass; ?>() {  // test case for inserting new record	
	$res = <?php echo $this->controllerClass ?>::actionPost<?php echo $this->model?>(
	$_POST['<?php echo $this->model?>'] =  array(
			<?php foreach( $this->tableSchema->columns as $key=>$value): ?>
				<?php if($key != $this->tableSchema->primaryKey){?>
				<?php echo " '$key' => '$key',\n"; ?>
				<?php } ?>
			<?php endforeach; ?>	
		));
		$res = ob_get_contents();
		$result = json_decode($res,1);		
		ob_clean();		
		$this->assertEquals($result['resultStatus'],1);
		
	}
	
	
	public function testactionPut<?php echo $this->model?>() {  // test case for deleting a record
		$testController = new <?php echo $this->model?>Controller();
		$res = $testController->actionPut<?php echo $this->model?>(
				$_POST['<?php echo $this->model?>'] =   array(
			<?php foreach( $this->tableSchema->columns as $key=>$value): ?>
				<?php if($key == $this->tableSchema->primaryKey)
				{?>
				<?php echo "'".$this->tableSchema->primaryKey."'"."=>'". $this->operate_id."',";
				}
				else	{?>
				
				<?php echo " '$key' => '$key',\n"; ?>
				<?php } ?>
			<?php endforeach; ?>	
		));		
		$res = ob_get_contents();				
		$result = json_decode($res,1);
				
		ob_clean();		
		$this->assertEquals($result['resultStatus'],1);
	
	}
	
	public function testactionDelete<?php echo $this->modelClass; ?>() {  // test case for deleting a record
		$testController = new <?php echo $this->model?>Controller();		
		$res = $testController->actionDelete<?php echo $this->model?>(
				$_POST['<?php echo $this->model?>'] =  array(
						'<?php echo $this->tableSchema->primaryKey ?>' =>  '<?php echo $this->operate_id;?>',
						
				));
	
		$res = ob_get_contents();
		$result = json_decode($res,1);
		ob_clean();
		$this->assertEquals($result['resultStatus'],1);
	
	}
	
	
}
