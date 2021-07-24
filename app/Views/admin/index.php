<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>


    <?php
    $password = 'supersecretpassword';
    $hash = password_hash($password, PASSWORD_BCRYPT);
    echo $hash;
    echo strlen($hash);
    echo "<br>";

    if (password_verify($password, $hash)) {
        echo 'The password is valid';
    } else {
        echo 'Invalid password';
    }

    // $data = 'adi Keren';
    // echo $data;
    // echo '<br>';

    // $str = hash("sha256", $data);
    // echo $str;
    // echo '<br>';
    //
    // $test = password_hash($data, PASSWORD_BCRYPT);
    // $test1 = password_hash($data, PASSWORD_BCRYPT);

    // echo '<br>';
    // echo $test;
    // // echo '<br>';
    // // echo $test1;

    // // $test = password_needs_rehash($data, PASSWORD_BCRYPT);
    // // // $test1 = password_needs_rehash($data, PASSWORD_BCRYPT);

    // $cek = password_verify($data, $test);

    // if ($cek) {
    //     echo "ea";
    // } else {
    //     echo "woi";
    // }
    ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->