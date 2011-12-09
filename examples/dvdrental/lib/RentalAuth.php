<?php
class RentalAuth extends BasicAuth {
    function init(){
        parent::init();
        $this->setModel('Model_Customer');
        $this->getModel()->addField('password')->system(true);

        $this->usePasswordEncryption('sha256/salt');
    }
    function check(){
        if(!$this->isLoggedIn()){
            $this->api->redirect('/');
        }
    }
    function verifyCredintials($email,$password){
        $model = $this->getModel()->loadBy('email',$email);
        if(!$model->isInstanceLoaded())return false;
        if($password == $model->get('password')){
            $this->addInfo($model->get());
			unset($this->info['password']);
            return true;
        }else return false;

    }
}
