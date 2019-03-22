<?php

class Database{
    
    private $hostname;
    private $dbname;
    private $user;
    private $pass;

    function __construct($hostname = "", $dbname = "", $user = "", $pass = "") {
        $this->$hostname = $hostname;
        $this->$dbname = $dbname;
        $this->$user = $user;
        $this->$pass = $pass;
        
        
        //Test connessione database
        

        $connection = new PDO ("mysql:host=$hostname;dbname=$dbname", $user, $pass);
        $connection = null;
    }
    
    function __destruct() {
        echo "<pre>" . var_dump($this->$hostname) . "</pre>";
        echo "<pre>" . var_dump($this->$dbname) . "</pre>";
        echo "<pre>" . var_dump($this->$user) . "</pre>";
        echo "<pre>" . var_dump($this->$pass) . "</pre>";
        
    }

    public function printAll() {
        
        echo "<pre>" . print_r($this) . "</pre>";
        // echo "<pre>" . var_dump($hostname) . "</pre>";
        // echo "<pre>" . var_dump($this->$dbname) . "</pre>";
        // echo "<pre>" . var_dump($this->$user) . "</pre>";
        // echo "<pre>" . var_dump($this->$pass) . "</pre>";
        
    }

    function getCredentials() {
        echo $hostname;
        echo $dbname;
        echo $user;
        echo $pass;
    }

    private function connect() {
        

        return new PDO ("mysql:host=".$this->$hostname.";dbname=".$this->$dbname, $user, $pass);
    }

    function getPassengerHashedPassword($email = "") {
        echo $this->$hostname;
        echo $this->$dbname;
        echo $this->$user;
        echo $this->$pass;
        
        print_r("mysql:host=".$hostname.";dbname=".$this->$dbname.$user.$pass);
        try{
            
            //$connection = $this->connect();
            $connection = new PDO ("mysql:host=".$this->$hostname.";dbname=".$this->$dbname, $user, $pass);
        }
        catch (PDOException $exception ) {
            echo "WTF!";
            die();
        }
        $stmt = "SELECT password_passeggero
                FROM RPASSEGGERI
                WHERE email = ?";

        $p_stmt = $connection->prepare($stmt);
        $p_stmt->execute([$email]);
        
        $password = $p_stmt->fetch(PDO::FETCH_ASSOC)['password_passeggero'];

        $connection = null;
        return $password;
    }
}
$hostname = "localhost";
$dbname = "carpooling"; 
$user = "phpmyadmin"; 
$pass = "Simone@2";


try {

    $connection = new PDO ("mysql:host=$hostname;dbname=$dbname", $user, $pass);
}
catch(PDOException $exception) {
    print("Errore connessione");
    die();
}
?>