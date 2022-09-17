<?php

use LDAP\Result;

class CommonCrudController{

    private $mysql  = '';
    private $result = [];
    private $conn   = false;  

    public function __construct(){
        if (!$this->conn) {
            $this->mysql = new mysqli('localhost', 'root', '', 'oop_project');
            if($this->mysql->connect_error){
                return false;
            }else{
                return true;
            }
        } else {
            return true;
        }
        

    }
    


    public function select($table_name,  $selectedFields = '*' , $whereClause= null){
        
        if ($whereClause != null) {
            $selectSql = " SELECT  $selectedFields FROM $table_name WHERE $whereClause";
        }else{
            $selectSql = " SELECT   $selectedFields  FROM $table_name";
        }


       

        if ($this->mysql->query($selectSql)) {

            $selectResults = $this->mysql->query($selectSql);
            $allResult = [];

        

            foreach ($selectResults as $key => $value) {
                $allResult[] = $value;
            }
            array_push($this->result, $allResult);
            
            return true;
        } else {
            array_push($this->result, $this->mysql->error);
            return false;
        }


        
        
    }

    public function create($table_name , $getFormData=array()){
       
     $table_columns_string = implode(",",array_keys($getFormData));
     $table_columns = $table_columns_string;
    
       
     $fieldsData = implode("','",$getFormData);
    //    echo "'".$stringData."'";

    $insertSql = "INSERT INTO $table_name($table_columns) VALUES ('$fieldsData')";
    

    if ($this->mysql->query($insertSql)) {
        array_push($this->result, "Insertion Successfull");
        return true;
    } else {
        array_push($this->result, $this->mysql->error);
        return false;
    }
    


    }

   
    public function update($table_name , $getFormDatas=[], $whereClause){
       
       $fieldValues = [];
       foreach ($getFormDatas as $key => $getFormData) {
        $fieldValues[] = "$key = '$getFormData'"; 
       } 
       
       $implodedValues = implode(", ", $fieldValues);
       

       $update_sql = "UPDATE $table_name SET $implodedValues WHERE $whereClause";

       if ($this->mysql->query($update_sql)) {
            array_push($this->result, "Update Successfull");
            return true;
        } else {
            array_push($this->result, $this->mysql->error);
            return false;
        }


    }


    public function delete($table_name ,  $pk_id){
        $delete_sql = "DELETE FROM $table_name WHERE id = $pk_id";

       if ($this->mysql->query($delete_sql)) {
            array_push($this->result, "Delete Successfull");
            return true;
        } else {
            array_push($this->result, $this->mysql->error);
            return false;
        }
    }


    public function resultDisplay(){
        $val = $this->result;
        $this->result = array();
        return $val;
    }


    public function __destruct()
    {
        if($this->conn){
            if($this->mysql->close()){
                $this->conn = false;
                return true;
            }else{
                return false;
            }
        }
    }
}





















?>