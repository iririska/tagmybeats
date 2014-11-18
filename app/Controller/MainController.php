<?php
class MainController extends AppController {
	var $uses = array('Siteuser','Task');

	/*
	function delete() {
		$del = (int)$_GET['id'];
		$this->Serie->deleteAll(array('id'=>$del));
	}

	function edit() {
		$this->set('Updated','');
		if (!empty($this->data)) 
		{
			$data = array('id'=>$this->data['formdata']['id'],'name'=> $this->data['formdata']['name'], 'translit'=>$this->data['formdata']['translit'], 'descr'=>$this->data['formdata']['description'], 'image'=>$this->data['formdata']['pic'] );
			$this->Serie->save($data);
			
		
			$this->set('Updated','Updated!');
		}

		if ($_GET['id']) 
		{
			$this->set('Ed', $this->Serie->find('all', array('conditions'=> array('id' => $_GET['id']) ) ));
		}

	}
	*/

	function logout() { 
        $this->Session->destroy(); 
  	}

	function check() {
		$rez = False;
		$userid = $this->Session->read('User');
		if ($userid) {
			$rez = $this->Siteuser->find('first',array('conditions' => array('Siteuser.id =' => $userid ) ) );
		} //else {die();}

		//print_r($this->request['data']['email']);
		$secret = '';
		if ($this->request['data']['posted']=='posted') {
			$tagfile = pathinfo($this->request->params['form']['tagfile']['name']);
			$mainfile = pathinfo($this->request->params['form']['mainfile']['name']);
	        $manext = strtolower($mainfile['extension']);
	        $tagext = strtolower($tagfile['extension']);
		
			if (in_array($manext, array('mp3','wav')) == False) {
			    echo("main file extension is wrong!. ");die();
			}
			
		    if ((in_array($tagext, array('mp3','wav')) == False) and ($this->request['data']['tagtext']=='')) {
			    echo("tag file extension is wrong!. And Tag text is empty ");die();
			}
			
			if ($this->request['data']['tagtext']!='') {
			    $tagext = "mp3";
            } else if($this->request->params['form']['tagfile']['size']==0) {
			    echo("bad tagfile");die();
			}
			
			if($this->request->params['form']['mainfile']['size']==0) {
			    echo("bad mainfile");die();
			}
			if ($this->request['data']['delay'] < 1) {
			    echo("delay must be > 0"); die();
			}
	        if ($this->request['data']['repeat'] < 1) {
			    echo("repeat must be > 0"); die();
			}
	        if ($this->request['data']['start'] < 0) {
			    echo("start must be => 0"); die();
			}	
			//genarate new names
			$rndstr1 = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyz0123456789' ) , 0 , 6); 
	        $newmainname = $rndstr1.".".$manext;
			$rndstr1 = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyz0123456789' ) , 0 , 6); 
			$newtagname = $rndstr1.".".$tagext;
			$rndstr1 = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyz0123456789' ) , 0 , 6);
			$outfile = $rndstr1.".".$manext;

			$registred = False;
		
			if ($rez == False) {
				//registration
			    $email = $this->request['data']['email'];
			    if (filter_var($email, FILTER_VALIDATE_EMAIL) == False) {
			        echo("bad email!. ");die();
			    }
		
	            $same = $this->Siteuser->find('count',array('conditions' => array('Siteuser.email =' => $email ) ) );
			    if ($same>0) {
			        echo("This email is already in use. Find your login link"); die();
			    } 
				//generate secret
			    $secret = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyz0123456789' ) , 0 , 6); 
			    $newData = array("email" =>$email, "keycode" => $secret );
			    //echo $secret;
				$this->Siteuser->create();
				$rez = $this->Siteuser->save($newData);
				$userid = $this->Siteuser->getInsertID();
				$this->Session->write('User', $userid);
				mail($email,"login link", "login link: http://tagmybeats.com/login?id=".$secret);
				//echo $userid;
				//email here
			}
		}
		
		if ($this->request['data']['posted']=='posted') {
			if  (move_uploaded_file($this->request->params['form']['mainfile']['tmp_name'], "/".BEATTAGGER_DIR."/test/upload/".$newmainname)) { 
	    		if ($this->request['data']['tagtext']=='') {
				    if (move_uploaded_file($this->request->params['form']['tagfile']['tmp_name'], "/".BEATTAGGER_DIR."/test/upload/".$newtagname)) {
						//ok
						$tagfilename = $this->request->params['form']['tagfile']['name'];
					} else { 
						die();
					}
				} else {   
					$tagfilename = $this->request['data']['tagtext'];
				    $reztag = file_get_contents("http://translate.google.com/translate_tts?tl=en&q=".urlencode($this->request['data']['tagtext']));
					if (strlen($reztag)>1) {
				        $r = fopen("/".BEATTAGGER_DIR."/test/upload/".$newtagname,"a");
					    fwrite($r,$reztag);
					    fclose($r);
					}
				}
			
			    //echo('ok');
				 $task = array("user"=> $userid,
			        "mainfile" => "upload/".$newmainname,
					"tagfile" => "upload/".$newtagname,
					"mainfile_name" => $this->request->params['form']['mainfile']['name'],
					"tagfile_name" => $tagfilename,
					"delay" => $this->request['data']['delay'],
					"times" => $this->request['data']['repeat'],
			        "out_file" => $outfile,
					"addtime" => date('Y-m-d H:i'),
					"ip" => $this->request->clientIp(),
					"start" => $this->request['data']['start'],
		        );
				
				$this->Task->create();
				$this->Task->save($task);
			}
        }
		if ($userid=='') {
		    echo('bad!'); die();
		}
		//load all tasks from user
		$alltasks = $this->Task->find('all',array('conditions' => array('Task.user =' => $userid ) ) );
		$this->set('tasks',$alltasks);
		$this->set('secret',$secret);
		$this->set('rez',$rez);
		//print_r($rez);
		//$secret

	}

	function login() {
	    //var $uses = array('Siteuser');
		$rez = $this->Siteuser->find('first',array('conditions' => array('Siteuser.keycode =' => $this->request['url']['id'] ) ) );
		//print_r($rez);
	    if (count($rez)>0) {
		    //echo $rez['Siteuser']['id'];
			$this->Session->write('User', $rez['Siteuser']['id']);
			$this->redirect( array('controller' => 'main', 'action' => 'index')   ); //echo 99;
		} else {
		    echo('bad!'); die();
		}
	}

	function index() {
		//$this->logout();exit;
	    $userid = $this->Session->read('User');
        $rez = False;
		if ($userid) {
		    //echo('ok!');
			$rez = $this->Siteuser->find('first',array('conditions' => array('Siteuser.id =' => $userid ) ) );
			//print_r($rez);
		}
		$this->set('rez',$rez);
	}
		
    function ajax() {
        $this->layout = '';
		$userid = $this->Session->read('User');
	    if ($userid) {
            $alltasks = $this->Task->find('all',array('conditions' => array('Task.user =' => $userid ) ) );
            $this->set('tasks',$alltasks);
	    } 
    }
}

?>