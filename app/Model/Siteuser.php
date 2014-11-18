<?
class Siteuser extends AppModel {
    public $name = 'Siteuser';
	public $useTable = 'user';
	   public $hasMany = array(
        'Task' => array(
            'foreignKey' => 'user',
        ));
// /".BEATTAGGER_DIR."/test/upload
	
}

?>