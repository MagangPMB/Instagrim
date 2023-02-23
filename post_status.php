<?php
include "koneksi.php";
   
if(isset($_POST['submit'])) {

    $nama_user = $_POST['nama_user'];  
    $caption = $_POST['caption']; 
    $countfiles = count($_FILES['files']['name']);
   
    $query = "INSERT INTO post_foto (nama_user,caption,nama,foto) VALUES(?,?,?,?)";
  
    $statement = $conn->prepare($query);
  

    for($i = 0; $i < $countfiles; $i++) {
  

        $filename = $_FILES['files']['name'][$i];
      

        $target_file = './img/'.$filename;
      
        $file_extension = pathinfo(
            $target_file, PATHINFO_EXTENSION);
             
        $file_extension = strtolower($file_extension);
      
        $valid_extension = array("png","jpeg","jpg");
      
        if(in_array($file_extension, $valid_extension)) {

            if(move_uploaded_file(
                $_FILES['files']['tmp_name'][$i],
                $target_file)
            ) {

                $statement->execute(
                    array($nama_user,$caption,$filename,$target_file));
            }
        }
    }
     
    header ("Location: index.php");
}
