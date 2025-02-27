<?php
session_start();
require_once '../../config.php';

// Check session role
function checkAdminRole() {
    if(!isset($_SESSION['Admin'])) {
        echo '<script>alert("Anda tidak memiliki akses!");window.location="index.php"</script>';
        exit;
    }
}

// Get user data
function getUserData($config, $id) {
    try {
        $sql = "SELECT * FROM user WHERE id_user = ?";
        $row = $config->prepare($sql);
        $row->execute(array($id));
        return $row->fetch();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Add new user
function tambahUser($config, $data) {
    try {
        $nama = htmlentities($data['nama']);
        $username = htmlentities($data['username']);
        $password = md5(htmlentities($data['password'])); // Encrypt password
        $alamat = htmlentities($data['alamat']);
        $tlp = htmlentities($data['no_telp']);
        $email = htmlentities($data['email']);
        $role = htmlentities($data['role']);
        
        $sql = "INSERT INTO user (nama, username, password, alamat, no_telp, email, role) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $row = $config->prepare($sql);
        $row->execute([$nama, $username, $password, $alamat, $tlp, $email, $role]);
        
        return true;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Edit user profile
function editProfile($config, $data) {
    try {
        $id = htmlentities($data['id']);
        $nama = htmlentities($data['nama']);
        $alamat = htmlentities($data['alamat']);
        $tlp = htmlentities($data['no_telp']);
        $email = htmlentities($data['email']);
        
        $sql = 'UPDATE user SET nama=?, alamat=?, no_telp=?, email=? WHERE id_user=?';
        $row = $config->prepare($sql);
        $row->execute([$nama, $alamat, $tlp, $email, $id]);
        
        return true;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Update user photo
function updatePhoto($config, $files, $data) {
    try {
        $allowedImageType = array("image/gif", "image/JPG", "image/jpeg", "image/pjpeg", "image/png", "image/x-png");
        $maxSize = 4096; // 4MB
        
        if ($files['foto']["error"] > 0) {
            throw new Exception("Error in File");
        }
        
        if (!in_array($files['foto']["type"], $allowedImageType)) {
            throw new Exception("Only JPG, PNG and GIF files are allowed");
        }
        
        if (round($files['foto']["size"] / 1024) > $maxSize) {
            throw new Exception("File size must not exceed 4MB");
        }
        
        $target_path = '../../assets/img/user/';
        $target_file = $target_path . basename($files['foto']['name']);
        
        if (file_exists($target_file)) {
            throw new Exception("File already exists");
        }
        
        if(move_uploaded_file($files['foto']['tmp_name'], $target_file)) {
            // Remove old photo
            if(!empty($data['foto2']) && file_exists($target_path . $data['foto2'])) {
                unlink($target_path . $data['foto2']);
            }
            
            $sql = 'UPDATE user SET gambar=? WHERE id_user=?';
            $row = $config->prepare($sql);
            $row->execute([$files['foto']['name'], $data['id']]);
            
            return true;
        }
        
        return false;
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Delete user
function hapusUser($config, $id) {
    try {
        $sql = "DELETE FROM user WHERE id_user = ?";
        $row = $config->prepare($sql);
        $row->execute([$id]);
        return true;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Display all users
function tampilUsers($config) {
    try {
        $sql = "SELECT * FROM user ORDER BY id_user DESC";
        $row = $config->prepare($sql);
        $row->execute();
        return $row->fetchAll();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Main process
checkAdminRole();

// Handle different actions based on GET parameters
if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'tambah':
            if(tambahUser($config, $_POST)) {
                echo '<script>window.location="../../index.php?page=user&success=tambah-data"</script>';
            }
            break;
            
        case 'edit':
            if(editProfile($config, $_POST)) {
                echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
            }
            break;
            
        case 'upload-foto':
            if(updatePhoto($config, $_FILES, $_POST)) {
                echo '<script>window.location="../../index.php?page=user&success=edit-foto"</script>';
            }
            break;
            
        case 'hapus':
            if(hapusUser($config, $_GET['id'])) {
                echo '<script>window.location="../../index.php?page=user&success=hapus-data"</script>';
            }
            break;
    }
}
?>
