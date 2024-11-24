<?php
class COOKIE_MANAGER 
{
    private $cookie_prefix = 'MCAUTH_';
    private $cookie_path = '/';
    private $cookie_domain;
    private $secure = true; // Força HTTPS
    private $httponly = true;
    private $samesite = 'Strict';
    private $expiration = 1800; // 30 minutos em segundos

    public function __construct() 
    {
        $this->cookie_domain = $_SERVER['HTTP_HOST'];
    }

    public function set_auth_cookies($user_data) 
    {
        $token = $this->generate_token();
        $user_id = $this->encrypt_data($user_data['id']);
        $username = $this->encrypt_data($user_data['username']);
        
        // Cookie principal de autenticação
        $this->set_cookie('TOKEN', $token);
        
        // Cookies com dados do usuário
        $this->set_cookie('UID', $user_id);
        $this->set_cookie('UNAME', $username);
        
        return $token;
    }

    public function clear_auth_cookies() 
    {
        $this->delete_cookie('TOKEN');
        $this->delete_cookie('UID');
        $this->delete_cookie('UNAME');
    }

    private function set_cookie($name, $value) 
    {
        $options = [
            'expires' => time() + $this->expiration,
            'path' => $this->cookie_path,
            'domain' => $this->cookie_domain,
            'secure' => $this->secure,
            'httponly' => $this->httponly,
            'samesite' => $this->samesite
        ];

        setcookie(
            $this->cookie_prefix . $name,
            $value,
            $options
        );
    }

    private function delete_cookie($name) 
    {
        $options = [
            'expires' => time() - 3600,
            'path' => $this->cookie_path,
            'domain' => $this->cookie_domain,
            'secure' => $this->secure,
            'httponly' => $this->httponly,
            'samesite' => $this->samesite
        ];

        setcookie(
            $this->cookie_prefix . $name,
            '',
            $options
        );
    }

    private function generate_token() 
    {
        return bin2hex(random_bytes(32));
    }

    private function encrypt_data($data) 
    {
        $key = $this->get_encryption_key();
        $iv = random_bytes(16);
        $encrypted = openssl_encrypt(
            $data,
            'AES-256-CBC',
            $key,
            0,
            $iv
        );
        return base64_encode($iv . $encrypted);
    }

    private function decrypt_data($encrypted_data) 
    {
        $key = $this->get_encryption_key();
        $decoded = base64_decode($encrypted_data);
        $iv = substr($decoded, 0, 16);
        $encrypted = substr($decoded, 16);
        return openssl_decrypt(
            $encrypted,
            'AES-256-CBC',
            $key,
            0,
            $iv
        );
    }

    private function get_encryption_key() 
    {
        // Idealmente, esta chave deve vir de uma variável de ambiente ou arquivo de configuração seguro
        return hash('sha256', 'MatheusC❤️Souza_COOKIE_KEY', true);
    }

    public function validate_auth_cookies() 
    {
        $token = $_COOKIE[$this->cookie_prefix . 'TOKEN'] ?? null;
        $user_id = $_COOKIE[$this->cookie_prefix . 'UID'] ?? null;
        $username = $_COOKIE[$this->cookie_prefix . 'UNAME'] ?? null;

        if (!$token || !$user_id || !$username) {
            return false;
        }

        try {
            $decrypted_user_id = $this->decrypt_data($user_id);
            $decrypted_username = $this->decrypt_data($username);

            return [
                'id' => $decrypted_user_id,
                'username' => $decrypted_username
            ];
        } catch (Exception $e) {
            return false;
        }
    }
}
?> 