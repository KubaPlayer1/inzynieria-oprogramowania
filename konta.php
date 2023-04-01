<?php
    require_once('tables.php');
    class konta extends table{
        private $username;
        private $email;
        private $password;
        
        function __construct($column_names, $username, $email, $password){
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            parent::setColumn_names($column_names);
        }

        function getColumn_variables(){
            return "'". $this->username . "','" . $this->email . "','" . $this->password . "'";
        }

        function getEmail(){
            return $this->email;
        }

        function getPassword(){
            return $this->password;
        }
    }
?>