<?php
class AdmController extends AppController {
    var $uses = array('Siteuser','Task','Admuser');
    
    function admlogin() {
        $mdpass = md5($this->request->data('admpwd')); //die();
        $rez = $this->Admuser->find('first',array( 'conditions' => array('Admuser.pass =' => $mdpass) ));
        //print_r($rez);
        if (count($rez)>0) {
            $this->Session->write('Admin', 1);
        }
        $this->redirect( array('controller' => 'adm', 'action' => 'index')   );
        //echo count($rez['Admuser']); die();
        //die();
    }
        
        
    function exitadmin() {
        $this->Session->write('Admin', '');
        $this->redirect( array('controller' => 'adm', 'action' => 'index')   );
    }

    function index() {
        $rez = False;
        $userid = $this->Session->read('User');
        $admlogin = False;
        
        $adminid = $this->Session->read('Admin');
        if ($adminid) {
            $admlogin = True;
        }
        if ($userid) {
            $rez = $this->Siteuser->find('first',array('conditions' => array('Siteuser.id =' => $userid ) ) );
        }
        $fff = $this->Siteuser->find('all');
        //print_r($fff); die();
	
        //$alltasks = $this->Task->find('all');
        $this->set('admlogin',$admlogin);
        $this->set('tasks',$fff);
        $this->set('rez',$rez);
	}
    
    function ajaxdel() {
        $this->layout = '';
        $byemail = '';
        if (isset($this->request['url']['delete'])) {
            $todelete = $this->Task->find('first',array('conditions' => array('Task.id =' => $this->request['url']['delete'] ) ) );

            unlink("/".BEATTAGGER_DIR."/test/".$todelete['Task']['mainfile']);
            unlink("/".BEATTAGGER_DIR."/test/".$todelete['Task']['tagfile']); 
            unlink("/".BEATTAGGER_DIR."/test/upload/".$todelete['Task']['out_file']); 
            //die();
            $this->Task->delete(array("Task.id"=>$this->request['url']['delete']));
        }
	
        if (isset($this->request['url']['email'])) {
            $byemail = $this->request['url']['email'];
        }

        $fff = $this->Siteuser->find('all',array('conditions'=> array('Siteuser.email like'=> "%$byemail%") ) );
        $this->set('tasks',$fff);
    }
	
}
?>