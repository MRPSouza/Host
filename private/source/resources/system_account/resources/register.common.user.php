<?php

require_once __DIR__ . '/connect.database.php';
require_once __DIR__ . '/password.validator.php';
require_once __DIR__ . '/../lib/hash.generator.php';
require_once __DIR__ . '/email.manager.php';

class REGISTER 
{
    private $db;
    private $tb_user;
    private $tb_email;
    private $tb_password;
    private $password_validator;
    private $email_manager;

    public function __construct()
    {
        $this->db = new CONNECT_DATABASE('dbmc_system_account');
        $this->tb_user = 'tb_user';
        $this->tb_email = 'tb_email';
        $this->tb_password = 'tb_password';
        $this->password_validator = new PASSWORD_VALIDATOR();
        $this->email_manager = new EMAIL_MANAGER();
    }

    public function register($username, $email, $password, $force = false)
    {
        $username = htmlspecialchars(strip_tags($username));
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars(strip_tags($password));

        // Verifica domínio banido
        if ($this->email_manager->is_domain_banned($email)) {
            return [
                'status' => 'error',
                'message' => 'Este domínio de e-mail não é permitido.'
            ];
        }

        // Verifica se a senha está na lista de senhas proibidas
        if (!$force && $this->password_validator->is_password_prohibited($password)) {
            return [
                'status' => 'warning',
                'message' => 'Esta senha é considerada insegura por ser muito comum ou já ter sido vazada. Se desejar continuar mesmo assim, preencha o formulário novamente e clique no botão "Cadastrar mesmo assim".',
                'data' => [
                    'username' => $username,
                    'email' => $email
                ]
            ];
        }

        try {
            // Verifica se o usuário já existe
            $sql = "SELECT id FROM {$this->tb_user} WHERE userName_str = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            if ($stmt->get_result()->num_rows > 0) {
                return "Nome de usuário já existe!";
            }

            // Verifica se o email já existe
            $sql = "SELECT id FROM {$this->tb_email} WHERE email_str = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            if ($stmt->get_result()->num_rows > 0) {
                return "Email já cadastrado!";
            }

            // Inicia a transação
            $this->db->begin_transaction();

            // Insere o usuário
            $sql = "INSERT INTO {$this->tb_user} (userName_str) VALUES (?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Obtém o ID do usuário inserido
            $user_id = $stmt->insert_id;
            if (!$user_id) {
                throw new Exception("Erro ao inserir usuário");
            }

            // Insere o email
            $sql = "INSERT INTO {$this->tb_email} (email_str, user_fk) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("si", $email, $user_id);
            $stmt->execute();
            
            // Obtém o ID do email inserido
            $email_id = $stmt->insert_id;
            if (!$email_id) {
                throw new Exception("Erro ao inserir email");
            }

            // Gera salt aleatório
            $password_salt = bin2hex(random_bytes(16));

            // Gera o hash da senha
            $password_hash = $password_salt . HASH_SALT_PREFIX . strtolower($email) . $password . strtolower($username) . HASH_SALT_SUFFIX;
            $hashed_password = password_hash($password_hash, PASSWORD_DEFAULT);

            // Insere a senha
            $sql = "INSERT INTO {$this->tb_password} (hashPass_str, password_salt, email_fk) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssi", $hashed_password, $password_salt, $email_id);
            $stmt->execute();

            // Gera e salva token de verificação
            $token = $this->email_manager->generate_verification_token();
            $this->email_manager->save_verification_token($email, $token);

            // Envia e-mail de verificação
            if (!$this->email_manager->send_verification_email($email, $token)) {
                throw new Exception("Erro ao enviar e-mail de verificação");
            }

            // Confirma a transação
            $this->db->commit();

            return [
                'status' => 'success',
                'message' => 'Cadastro realizado! Por favor, verifique seu e-mail para ativar sua conta.'
            ];

        } catch (Exception $e) {
            // Em caso de erro, desfaz todas as alterações
            $this->db->rollback();
            return [
                'status' => 'error',
                'message' => 'Erro ao registrar usuário: ' . $e->getMessage()
            ];
        }
    }
}
?>
