<?php
    require_once('tables.php');
    require_once('konta.php');
    class Connect{


        public $Connect;
        function __construct(){
            $this->Connect = @new mysqli('localhost', 'root', '', 'baza');

            if ($this->Connect->connect_error) {
                die('Connection failed: ' . $this->Connect->connect_error);
            }
        }

        function add(table $Object){
            try{
                $sql = "INSERT INTO konta (".$Object->getColumn_names().") VALUES (".$Object->getColumn_variables().")";
                echo $sql."\n";
                if ($this->Connect->query($sql) == TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $this->Connect->error;
                }
           }
           catch(Throwable $e) {
               $trace = $e->getTrace();
               echo $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
           }
        }

        function show(konta $Object){
            $result = mysqli_query($this->Connect, "SELECT * FROM konta WHERE email = '".$Object->getEmail()."'");
            $resultCount = $result->num_rows;
            if($resultCount>=1){
                //$Connected = True;
                while($row=mysqli_fetch_array($result)){
                    $haslo = $row['password'];
                }

                if ($Object->getPassword() == $haslo){
                    echo "przeszlo";

                }else echo "Nie ma takiego uzytkownika!";
            }else echo "strawdz login lub haslo!";
        }

        function Close(){
            $this->Connect->close();
        }

        
    }

?>