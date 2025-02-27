<?php
@ob_start();
session_start();
if (isset($_POST['proses'])) {
    require 'config.php';

    $username = strip_tags($_POST['user']);
    $password = strip_tags($_POST['pass']);
    
    $sql = 'SELECT * FROM user WHERE username = ? AND password = md5(?)';
    $row = $config->prepare($sql);
    $row->execute([$username, $password]);
    $jum = $row->rowCount();
    
    if ($jum > 0) {
        $hasil = $row->fetch();
        $_SESSION['user'] = $hasil;
        $_SESSION['role'] = $hasil['role'];
        
        switch($hasil['role']) {
            case 'Superuser':
                $_SESSION['Superuser'] = true;
                echo '<script>alert("Login Sukses");window.location="View/superuser/superuser_dashboard.php"</script>';
                break;
            case 'Admin':
                $_SESSION['Admin'] = true;
                echo '<script>alert("Login Sukses");window.location="index.php"</script>';
                break;
            case 'Member':
                $_SESSION['Member'] = $hasil;
                $_SESSION['id_user'] = $hasil['id_user'];
                include 'template/sidebar_pegawai.php';
                echo '<script>alert("Login Sukses");window.location="index.php"</script>';
                break;
            default:
                echo '<script>alert("Role tidak valid");history.go(-1);</script>';
                break;
        }
    } else {
        echo '<script>alert("Login Gagal");history.go(-1);</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword">

    <title>Login To Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>
body {
    background: url('assets/img/toko.jpg') no-repeat center center fixed;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    margin: 0;
    font-family: Arial, sans-serif;
    background-color : ( 0,0,0,0,5);
}

.login-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    max-width: 400px;
    padding: 20px;
    margin-top: -50px;
}

.form-login {
    max-width: 320px;
    width: 100%;
    background: rgba(0, 0, 0, 0.6); /* Background gelap transparan */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 15px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.form-login-heading {
    margin: 0;
    padding: 20px;
    text-align: center;
    background: #ff0000;
    border-radius: 15px 15px 0 0;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-wrap {
    padding: 30px;
}

.form-control {
    width: 100%;
    margin-bottom: 15px;
    height: 40px;
    background: transparent;
    border: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
    color: white;
    font-size: 14px;
    padding: 8px 0;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.form-control:focus {
    outline: none;
    border-bottom-color: #ff0000;
}

.btn-primary {
    background-color: #ff0000;
    border: none;
    padding: 12px;
    font-weight: bold;
    width: 100%;
    color: white;
    border-radius: 5px;
    margin-top: 20px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #e60000;
}
</style>
<body>

    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

    <div class="login-container">
        <form class="form-login" method="POST">
            <h2 class="form-login-heading">
                <img src="assets/img/logosrc.png" alt="SRC LOGO">
            </h2>
            <div class="login-wrap">
                <input type="text" class="form-control" name="user" placeholder="Username" autofocus>
                <input type="password" class="form-control" name="pass" placeholder="Password">
                <button class="btn btn-primary" name="proses" type="submit">
                    <i class="fa fa-lock"></i> SIGN IN
                </button>
            </div>
        </form>
    </div>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
