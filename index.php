<?php
require 'koneksi.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload foto dan komentar</title>
    <!-- <link rel="stylesheet" href="css/style.css">      -->

<body>

    <h2>
        <Instagrim class="bi bi-instagram">Instagrim</i>
    </h2>
    <form method='post' action='post_status.php' enctype='multipart/form-data'>
        <input type="text" class="nama_user" name="nama_user" placeholder="Nama">
        <br>
        <textarea name="caption" cols="50" rows="3" class="caption" placeholder="Posting Sesuatu"></textarea>
        <br>
        <label for="file[]">Masukkan gambar</label>
        <input type='file' name='files[]' multiple />

        <br>
        <input type='submit' value='Post' name='submit' />
    </form>

    <?php
    $stmt = $conn->prepare('SELECT * FROM post_foto');
    $stmt->execute();
    while ($data = $stmt->fetch()) {
        echo "<hr>";
    ?>

        <strong><?php echo $data['nama_user'] ?></strong>
        <br>
        <?php echo $data['caption'] ?>
        <br>
        <img src="<?= $data['foto'] ?>" width='200px' height='150px'>
        <br>
        <strong>Komentar yang ada</strong>
        <!-- <i class='fas fa-comment-dots' style='font-size:36px'></i> -->
        <?php
        $stmt1 = $conn->prepare("SELECT komentar.*, post_foto.id_post FROM komentar INNER JOIN post_foto
        ON post_foto.id_post = komentar.id_status_komentar WHERE id_post = :id_post");
        $stmt1->execute(array('id_post' => $data['id_post']));
        while ($komentar = $stmt1->fetch()) {
            echo "<br>";
            echo  "<strong>".$komentar['nama_komentar']. "<br>"."</strong>";
            echo  "<font color=blue>".$komentar['komentar'] . "<br>"."</font>";
        } ?>
        <form method="post" action="comment.php">
            <br>
            Tambahkan Komentar
            <br>
            <input type="text" class="nama_komentar" name="nama_komentar" placeholder="Nama">
            <br>
            <textarea type="text" name="komentar" cols="50" rows="3" maxlength="200" class="komentar" placeholder="Balas status <?php echo $data['nama_user'] ?>"></textarea>
            <input type="hidden" name="id_post" value="<?php echo $data['id_post'] ?>">
            <br>
            <input type="submit" value="Send">
            <hr>
        </form>
    <?php
    }
    ?>
</body>
</head>

</html>