<?php

    //Packages
    include('Connection.php');

    class Crud{

        //INSERT
        public static function insert($table_name,$columns,$values){
            //sql statement
            $sql="INSERT INTO ".$table_name." (";
            //forming column within ()
            $sql=$sql.$columns[0];
            for($i=1;$i<count($columns);$i++){
                $sql=$sql.",".$columns[$i];
            }
            //forming values within ()
            $sql=$sql.") VALUES (";
            $sql=$sql."'".$values[0]."'";
            for($i=1;$i<count($values);$i++){
                $sql=$sql.",'".$values[$i]."'";
            }
            $sql=$sql.");";

            if($GLOBALS['connection']->query($sql)){
                //Insertion successfull
                return $GLOBALS['connection']->insert_id;
            }else{
                //something went wrong
                return false;
            }
        }

        //UPDATE
        public static function update($table_name,$id,$columns,$values){
            //sql statement
            $sql="UPDATE ".$table_name." SET ";
            //forming key value pair
            $iteration=count($values);
            for($i=0;$i<$iteration-1;$i++){
                $sql=$sql.$columns[$i]."='".$values[$i]."',";
            }
            $sql=$sql.$columns[$iteration-1]."='".$values[$iteration-1]."' WHERE id='".$id."';";
 
            if($GLOBALS['connection']->query($sql)){
                //Updation successfull
                return true;
            }else{
                //something went wrong
                return false;
            }
        }

        //DELETE
        public static function delete($table_name,$id){
            $sql="DELETE FROM ".$table_name." WHERE id=".$id;

            if($GLOBALS['connection']->query($sql)){
                //Deletion successfull
                return true;
            }else{
                //something went wrong
                return false;
            }
        }

        //SELECT
        //One
        public static function select_one($table_name,$id){
            $sql="SELECT * FROM ".$table_name." WHERE id=".$id.";";

            $result=$GLOBALS['connection']->query($sql);
            if($result->num_rows>0){
                return $result;
            }else{
                //no data available
                return false;
            }
        }
        //All
        public static function select_all($table_name){
            $sql="SELECT * FROM ".$table_name." ORDER BY id DESC;";
            
            $result=$GLOBALS['connection']->query($sql);
            if($result->num_rows>0){
                return $result;
            }else{
                //no data available
                return false;
            } 
        }
        //Contraint
        public static function select_constraint($table_name,$constraint){
            $sql="SELECT * FROM ".$table_name." ".$constraint." ORDER BY id DESC;";
            
            $result=$GLOBALS['connection']->query($sql);

            if($result->num_rows>0){
                return $result;
            }else{
                //no data available
                return false;
            }
        }
        //Custom
        public static function custom_query($sql){
            $result=$GLOBALS['connection']->query($sql);

            if($result->num_rows>0){
                return $result;
            }else{
                //no data available
                return false;
            }
        }

        public static function count_all($table_name){
            $sql="SELECT COUNT(*) AS count FROM ".$table_name.";";

            $result=$GLOBALS['connection']->query($sql);
            if($result->num_rows>0){
                return $result->fetch_assoc()['count'];
            }else{
                //no data available
                return false;
            }
        }

        public static function count_constraint($table_name,$constraint){
            $sql="SELECT COUNT(*) AS count FROM ".$table_name." ".$constraint.";";

            $result=$GLOBALS['connection']->query($sql);
            if($result->num_rows>0){
                return $result->fetch_assoc()['count'];
            }else{
                //no data available
                return false;
            }
        }
    }

?>