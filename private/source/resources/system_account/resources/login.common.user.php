<?php

require_once __DIR__ . '/connect.database.php';
require_once __DIR__ . '/cookie.manager.php';
require_once __DIR__ . '/../lib/hash.generator.php';

class LOGIN
{
    private $db;
    private $tb_user;
    private $tb_email;
    private $tb_password;
    private $cookie_manager;

    public function __construct()
    {
        $this->db = new CONNECT_DATABASE('dbmc_system_account');
        $this->tb_user = 'tb_user';
        $this->tb_email = 'tb_email';
        $this->tb_password = 'tb_password';
        $this->cookie_manager = new COOKIE_MANAGER();
    }

    public function login($input_identificador, $input_password)
    {
        $input_identificador = htmlspecialchars(strip_tags($input_identificador));
        $input_password = htmlspecialchars(strip_tags($input_password));
        
        try {
            $input_user = '';
            $input_email = '';

            if (strpos($input_identificador, '@') !== false) { 
                // Caso seja email
                $sql = "SELECT u.userName_str, e.email_str 
                       FROM {$this->tb_user} u 
                       INNER JOIN {$this->tb_email} e ON u.id = e.user_fk 
                       WHERE e.email_str = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("s", $input_identificador);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 0) {
                    return 'Usuário ou email não encontrado!';
                }

                $row = $result->fetch_assoc();
                $input_email = $input_identificador;
                $input_user = $row['userName_str'];
            } else { 
                // Caso seja nome de usuário
                $sql = "SELECT u.userName_str, e.email_str 
                       FROM {$this->tb_user} u 
                       INNER JOIN {$this->tb_email} e ON u.id = e.user_fk 
                       WHERE u.userName_str = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("s", $input_identificador);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 0) {
                    return 'Usuário ou email não encontrado!';
                }

                $row = $result->fetch_assoc();
                $input_user = $input_identificador;
                $input_email = $row['email_str'];
            }

            // Busca o hash e salt da senha
            $sql_tb_password = "SELECT hashPass_str, password_salt 
                              FROM {$this->tb_password} 
                              WHERE email_fk = (SELECT id FROM {$this->tb_email} WHERE email_str = ?)";
            $stmt_password = $this->db->prepare($sql_tb_password);
            $stmt_password->bind_param("s", $input_email);
            $stmt_password->execute();
            $result_tb_password = $stmt_password->get_result();

            if ($result_tb_password->num_rows === 0) {
                return 'Senha incorreta!';
            }

            $password_row = $result_tb_password->fetch_assoc();
            $hash = $password_row['hashPass_str'];
            $password_salt = $password_row['password_salt'];

            // Gera o hash da senha fornecida
            $input_hash = $password_salt . HASH_SALT_PREFIX . strtolower($input_email) . $input_password . strtolower($input_user) . HASH_SALT_SUFFIX;

            if (password_verify($input_hash, $hash)) {
                // Busca o ID do usuário
                $sql = "SELECT u.id, u.userName_str 
                       FROM {$this->tb_user} u 
                       INNER JOIN {$this->tb_email} e ON u.id = e.user_fk 
                       WHERE e.email_str = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("s", $input_email);
                $stmt->execute();
                $user_result = $stmt->get_result()->fetch_assoc();

                // Define os cookies
                $this->cookie_manager->set_auth_cookies([
                    'id' => $user_result['id'],
                    'username' => $user_result['userName_str']
                ]);

                return [
                    'status' => 'success',
                    'message' => 'Login bem-sucedido!'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Senha incorreta!'
                ];
            }

        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => "Erro: " . $e->getMessage()
            ];
        }
    }

    public function logout()
    {
        $this->cookie_manager->clear_auth_cookies();
        return [
            'status' => 'success',
            'message' => 'Logout realizado com sucesso!'
        ];
    }

    public function check_auth()
    {
        return $this->cookie_manager->validate_auth_cookies();
    }
}
?>