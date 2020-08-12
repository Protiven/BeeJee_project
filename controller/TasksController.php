<?php

class TasksController{

    public function actionEdit($id){

    }
    
    public function actionView($params){
        //global $list_of_tasks;
        //$list_of_tasks = db::requestListOfTasks($params);
        
        if($params === NULL)
            $params = 0;
        autoload::loadObject("MainPage");
    }
}
?>