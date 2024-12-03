<?php

class auth_controller {
    private $userModel;

    public function __construct($connection) {
        $this->userModel = new UserModel($connection);
    }

    public function login($username, $password) {
        session_start();

        $result = $this->userModel->login($username, $password);

        if ($result['status']) {
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['user_type'] = $result['user_type'];
            
            switch ($result['user_type']) {
                case 'mahasiswa':
                    $_SESSION['nama'] = $result['nama'];
                    header('Location: /mahasiswa/dashboard');
                    break;
                case 'dosen':
                    $_SESSION['nama'] = $result['nama'];
                    header('Location: /dosen/dashboard');
                    break;
                case 'admin':
                    header('Location: /admin/dashboard');
                    break;
            }
            exit;
        } else {
            $_SESSION['error'] = $result['message'];
            header('Location: login.php');
            exit;
        }
    }
}
?>