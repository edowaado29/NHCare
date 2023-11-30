<?php 

$conn = mysqli_connect("localhost", "tifcmyho_nhcare", "@JTIpolije2023", "tifcmyho_nhcare");

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

    public function update_data($updateQuery){
        global $conn;
        $result = mysqli_query($conn, $updateQuery);
        return $result;
    }

    public function delete_data($deleteQuery) {
        global $conn;
        $result = mysqli_query($conn, $deleteQuery);
        return $result;
    }
}
?>

