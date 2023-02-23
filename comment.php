<?php
// print_r($_POST);
// die();
//  $a = $_SERVER['PHP_SELF'];
//  $pee = explode("=", $a);
if (isset($_POST['id_post'] )){
    require "koneksi.php";

    $id_komentar= null;
    $id_status_komentar = $_POST['id_post'];
    $nama_komentar = $_POST['nama_komentar'];
    $komentar = $_POST['komentar'];

    if(empty($komentar)){
    header("Location: index.php");
    }else{
    $stmt = $conn->prepare('INSERT INTO komentar VALUES (:id_komentar ,:id_status_komentar, :nama_komentar, :komentar)');
    $res = $stmt->execute(array(':id_komentar' => $id_komentar ,':id_status_komentar'=>$id_status_komentar,':nama_komentar'=> $nama_komentar, ':komentar' => $komentar
    ));

            if($res){
            header("Location: index.php");
            }
            $conn = null;
            exit();
        }
    }else {
        echo "Sama aja";    }

?>
