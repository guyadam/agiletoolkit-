<?php
class page_mgr extends Page {
    function init(){
        parent::init();

        $tabs=$this->add('Tabs');
        $crud=$tabs->addTab('Customers')->add('CRUD');
        $crud->setModel('Customer');
        if($crud->grid){
            $crud->grid->addColumn('prompt','set_password');
            if($_GET['set_password']){
                $auth = $this->add('RentalAuth');
                $model = $auth->getModel()->loadData($_GET['set_password']);
                $enc_p = $auth->encryptPassword($_GET['value'],$model->get('email'));
                $model->set('password',$enc_p)->update();
                $this->js()->univ()->successMessage('Changed password for '.$model->get('email'))
                    ->execute();
            }
        }

        $tabs->addTab('Movies')->add('CRUD')->setModel('Movie');
        $tabs->addTab('DVDs')->add('CRUD')->setModel('DVD');
        $tabs->addTab('Rentals')->add('CRUD')->setModel('Rental');
    }
}
