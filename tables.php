<?php
    class table{
        private $column_names;
        private $column_values;


        function __construct($column_names, $column_values){
            $this->column_names = $column_names;
            $this->column_values = $column_values;
        }

        function getColumn_names(){
            return implode(',',$this->column_names);
        }

        function setColumn_names($column_names){
            $this->column_names = $column_names;
        }

        function getColumn_variables(){
            return $this->column_values;
        }

        function setColumn_variables($column_values){
            $this->column_values = $column_values;
        }
    }
?>