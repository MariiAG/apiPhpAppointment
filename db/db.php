<?php 
    $pdo=null;
    $host="localhost";
    $user="root";
    $password="";
    $db="appointmentapp";
    

    function connect() {
        try{
            $GLOBALS['pdo']=new PDO("mysql:host=".$GLOBALS['host'].";dbname=".$GLOBALS['db']."", $GLOBALS['user'], $GLOBALS['password']);
            $GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            print "Error!: No se pudo conectar a la bd ".$bd."<br/>";
            print "\nError!: ".$e."<br/>";
            die();
        }
    }

    function disconnect(){
        $GLOBALS['pdo']=null;
    }

    function methodGet($query){
        try{
            connect();
            $sentence=$GLOBALS['pdo']->prepare($query);
            $sentence->setFetchMode(PDO::FETCH_ASSOC);
            $sentence->execute();
            disconnect();
            return $sentence;
        }catch(Exception $e){
            die("Error: ".$e);
        }
    }

    function methodPost($query, $queryAutoIncrement){
        try{
            connect();
            $sentence=$GLOBALS['pdo']->prepare($query);
            $sentence->execute();
            $idAutoIncrement=methodGet($queryAutoIncrement)->fetch(PDO::FETCH_ASSOC);
            $result=array_merge($idAutoIncrement, $_POST);
            $sentence->closeCursor();
            disconnect();
            return $result;
        }
        catch (Exception $e){
            die("Error: ".$e);
        }  
    }

    function methodPut($query){
        try{
            connect();
            $sentence=$GLOBALS['pdo']->prepare($query);
            $sentence->execute();
            $result=array_merge($_GET, $_POST);
            $sentence->closeCursor();
            disconnect();
            return $result;
        }
        catch (Exception $e){
            die("Error: ".$e);
        } 
    }

    function methodDelete($query){
        try{
            connect();
            $sentence=$GLOBALS['pdo']->prepare($query);
            $sentence->execute();
            $sentence->closeCursor();
            disconnect();
            return $_GET['id'];
        }
        catch (Exception $e){
            die("Error: ".$e);
        } 
    }

?>