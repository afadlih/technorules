<?php

class auth_controller {
    private $userModel;
    
    public function __construct(User $userModel) {
        session_start();
        $this->userModel = $userModel;
    }
    
    public function login($username, $password) {
        if (empty($username) || empty($password)) {
            $_SESSION['error'] = "Username dan password harus diisi";
            header("Location: /login");
            exit();
        }
        
        $user = $this->userModel->login($username, $password);
        
        if ($user) {
            $role = $this->userModel->getUserRole($user['id']);
            
            switch ($role) {
                case 'admin':
                    header("Location: /admin/dashboard");
                    break;
                case 'dosen':
                    header("Location: /dosen/dashboard");
                    break;
                case 'dosen_dpa':
                    header("Location: /dosen/dpa/dashboard");
                    break;
                case 'dosen_komdis':
                    header("Location: /dosen/komisi-disiplin/dashboard");
                    break;
                case 'mahasiswa':
                    header("Location: /mahasiswa/dashboard");
                    break;
            }
            exit();
        } else {
            $_SESSION['error'] = "Username atau password salah";
            header("Location: /login");
            exit();
        }
    }
}

?>