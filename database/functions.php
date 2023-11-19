<?php 

$conn = mysqli_connect("localhost", "root", "", "db_nhcare");

class Functions {

    public function get_data($getData){
        global $conn;
        $result = mysqli_query($conn, $getData);
        return $result;
    }
    public function insert_data($insertQuery){
        global $conn;
        $result = mysqli_query($conn, $insertQuery);
        return $result;
    }

    public function delete_data($table, $condition) {
        global $conn;
        $deleteQuery = "DELETE FROM $table WHERE $condition";
        $result = mysqli_query($conn, $deleteQuery);
        return $result;
    }
}
?>

