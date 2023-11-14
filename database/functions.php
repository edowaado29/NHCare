<?php 

$conn = mysqli_connect("localhost", "root", "", "db_nhcare");

class Functions {

    public function get_data($getData){
        global $conn;
        $result = mysqli_query($conn, $getData);
        return $result;
    }

}

?>