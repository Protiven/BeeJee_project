<?php 

function getRouters(){
    return array(
        'edit/([0-9]+)' => 'tasks/edit/$1',
        'tasks/sortUp/([a-zA-Z]{1,})/([0-9]{1,})' => 'tasks/view/sortUp/$1/$2',
        'tasks/sortDown/([a-zA-Z]{1,})/([0-9]{1,})' => 'tasks/view/sortDown/$1/$2',
        'tasks/([0-9]+)' => 'tasks/view/$1',
        'tasks' => 'tasks/view',
        '' => 'tasks/view',
    );
}

class Router
{
    private $routes;
    
    public function __construct()
    {
        $this->routes = getRouters();
    }

    private function getURI()
    {
        if(!empty($_SERVER["REQUEST_URI"])) {
            return trim($_SERVER["REQUEST_URI"], '/');
        }
    }


    public function run()
    {
        // Get request str
        $req = $this->getURI();

        // Check the request in this->routes
        foreach($this->routes as $key => $value) {
            // if true, find corresponding controller and action
            if(preg_match("~$key~", $req)){

                $segments = preg_replace("~$key~",$value, $req);
                $segments = explode('/', $segments);

                // load file of class controller's
                $name_controller = array_shift($segments).'Controller';
                $name_controller = ucfirst($name_controller);
            
                $action_name = 'action'. ucfirst(array_shift($segments));

                //var_dump($action_name);
                //var_dump($name_controller);
                //var_dump($segments);
                autoload::loadObject($name_controller);
                
                
                // Create object and calling correspoding action
                $controller = new $name_controller;
                //var_dump($action_name);
                $result = $controller->$action_name($segments);
                
                if($result != null)
                    break;
            }
        }

    }
}
?>