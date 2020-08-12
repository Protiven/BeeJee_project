<?php
function getConfig(){
    return array(
        'db_host' => 'localhost',
        'db_name' => 'mvc_site',
        'db_user' => 'root',
        'db_password' => '',
    );
}

abstract class db {
    private static $connection;

    public static function isConnected() {
        return self::$connection;
    }

    public static function getConnection() {
        if(!self::$connection){
            $cfg = getConfig();
            $db_host = $cfg['db_host'];
            $db_name = $cfg['db_name'];

            $dsn = "mysql:hosts=$db_host;dbname=$db_name";

            self::$connection = new PDO($dsn, $cfg['db_user'], $cfg['db_password']); 
        }
        return self::$connection;
    }

    public static function tryAuthorization($user_name, $password){
        if(self::isConnected()) {
            $expr = self::$connection->prepare("SELECT * FROM `userslist` WHERE user = $user AND password = $password");

            if($expr){
                $result = $expr->execute();

                if($result){    
                    $_SERVER['admin'] = 1;            
                    return true;
                }
            }
            else{ return false; }
        }
        else { return false; }
    }

    private static function getNecRequest(&$params){
        if($params === NULL)
            return "SELECT * FROM `taskslist` ORDER BY id DESC";
        switch (count($params)){
            case 0:
                return  "SELECT * FROM `taskslist` ORDER BY id DESC";
            break;
            case 1:
                return "SELECT * FROM `taskslist` ORDER BY id DESC";
            break;
            case 3:
                $support = $params[1];
                if($params[0] === "sortUp")
                    return "SELECT * FROM `taskslist` ORDER BY $support DESC";
                else if($params[0] === "sortDown")
                    return "SELECT * FROM `taskslist` ORDER BY $support ASC";
                array_shift($params);
                array_shift($params);
                return NULL;
            break;     
            default:
            return NULL;           
        }
    }

    public static function requestListOfTasks($params){
        $sql = self::getNecRequest($params);


        if(self::isConnected() && $sql) {
            $expr = self::$connection->prepare($sql);

            if($expr){
                $result = $expr->execute();
                if($result){
                    $TasksList = array();
                    $i = 0;
                         

                    while($row = $expr->fetch()){
                        $TasksList[$i]['id'] = $row['id'];
                        $TasksList[$i]['email']= $row['email'];
                        $TasksList[$i]['text_task']= $row['text_task'];                    
                        $TasksList[$i]['stat'] = $row['stat'];
                        $TasksList[$i]['user'] = $row['user'];
                        $i++;
                    }
                    
                    return $TasksList;
                }
            }
            else{ return false; }
        }
        else { return false; }
    }

    public static function requestTask($id){
        if(self::isConnected()) {
            $expr = self::$connection->prepare("SELECT * FROM `taskslist` WHERE id = $id");

            if($expr){
                $result = $expr->execute();

                if($result){
                    $TasksList = array();
                    $i = 0;
                         
                    $row = $expr->fetch();
                    return $row;
                }
            }
            else{ return false; }
        }
        else { return false; } 
    }

    public static function editTask(){






        
    }
}
?>