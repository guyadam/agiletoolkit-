<?php
class Frontend extends ApiFrontend {
    function init(){
        parent::init();

        $this->addLocation('../atk4-addons',array(
                    'php'=>array(
                        'mvc',
                        'misc/lib',
                        )
                    ))
            ->setParent($this->pathfinder->atk_location);

        $this->add('jUI');
        $this->js()->_load('atk4_univ');
        $this->dbConnect();

        $this->auth=$this->add('RentalAuth');
        $this->auth->allow('demo','demo');

        $menu = $this->add('Menu',null,'Menu');
        if($this->auth){
            $menu->addMenuItem('Home','video');
            $menu->addMenuItem('account');
            $menu->addMenuItem('logout');
        }else{
            $menu->addMenuItem('Home','index');
        }
    }
}
