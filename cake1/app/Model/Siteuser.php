<?
class Siteuser extends AppModel {
    public $name = 'Siteuser';
	public $useTable = 'user';
	   public $hasMany = array(
        'Task' => array(
            'foreignKey' => 'user',
        ));
// /home/beattagger/public_html/test/upload
	
}

?>