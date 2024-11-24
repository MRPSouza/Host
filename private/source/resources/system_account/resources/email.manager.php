<?php
class EMAIL_MANAGER 
{
    private $db;
    private $banned_domains = [];
    private $verification_config;
    private $smtp_config;

    public function __construct() 
    {
        $this->db = new CONNECT_DATABASE('dbmc_system_account');
        $this->load_config();
    }

    private function load_config() 
    {
        $email_config = parse_ini_file(__DIR__ . '/../config/email.ini', true);
        $smtp_config = parse_ini_file(__DIR__ . '/../config/smtp.ini', true);
        
        if (!$email_config || !$smtp_config) {
            throw new Exception('Erro ao carregar configurações de email');
        }
        
        $this->banned_domains = $email_config['banned_domains']['domains'];
        $this->verification_config = $email_config['verification'];
        $this->smtp_config = $smtp_config['smtp'];
    }

    private function smtp_connect() 
    {
        $errno = 0;
        $errstr = '';
        
        // Primeiro conecta sem TLS
        $smtp = stream_socket_client(
            "tcp://{$this->smtp_config['host']}:{$this->smtp_config['port']}", 
            $errno, 
            $errstr, 
            30
        );

        if (!$smtp) {
            throw new Exception("Erro de conexão SMTP ($errno): $errstr");
        }

        // Habilita modo de debug
        $debug = true;
        if ($debug) error_log("Conectado ao servidor SMTP");

        $this->get_smtp_response($smtp);

        // EHLO inicial
        if ($debug) error_log("Enviando EHLO inicial");
        fwrite($smtp, "EHLO " . $this->smtp_config['host'] . "\r\n");
        $this->get_smtp_response($smtp);

        // Inicia STARTTLS
        if ($debug) error_log("Iniciando STARTTLS");
        fwrite($smtp, "STARTTLS\r\n");
        $this->get_smtp_response($smtp);

        // Habilita criptografia TLS
        if ($debug) error_log("Habilitando criptografia TLS");
        stream_socket_enable_crypto($smtp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);

        // EHLO novamente após TLS
        if ($debug) error_log("Enviando EHLO após TLS");
        fwrite($smtp, "EHLO " . $this->smtp_config['host'] . "\r\n");
        $this->get_smtp_response($smtp);

        // AUTH LOGIN
        if ($debug) error_log("Iniciando autenticação");
        fwrite($smtp, "AUTH LOGIN\r\n");
        $this->get_smtp_response($smtp);
        
        if ($debug) error_log("Enviando usuário");
        fwrite($smtp, base64_encode($this->smtp_config['username']) . "\r\n");
        $this->get_smtp_response($smtp);
        
        if ($debug) error_log("Enviando senha");
        fwrite($smtp, base64_encode($this->smtp_config['password']) . "\r\n");
        $this->get_smtp_response($smtp);

        if ($debug) error_log("Autenticação concluída");

        return $smtp;
    }

    private function get_smtp_response($smtp) 
    {
        $response = '';
        while ($str = fgets($smtp, 515)) {
            $response .= $str;
            error_log("Resposta SMTP: " . trim($str)); // Log de debug
            if (substr($str, 3, 1) == " ") break;
        }
        
        $code = substr($response, 0, 3);
        if ($code < 200 || $code >= 400) {
            throw new Exception("Erro SMTP: " . trim($response));
        }
        
        return $response;
    }

    public function send_verification_email($email, $token) 
    {
        try {
            $verification_url = "https://matheusrpsouza.com/verify_email.php?token=" . urlencode($token);
            $boundary = 'b' . bin2hex(random_bytes(16));
            
            $headers = [
                'MIME-Version: 1.0',
                'Content-Type: multipart/alternative; boundary=' . $boundary,
                'From: ' . $this->smtp_config['from_name'] . ' <hello@matheusrpsouza.com>',
                'To: ' . $email,
                'Subject: =?UTF-8?B?' . base64_encode("Verificação de E-mail") . '?=',
                'Date: ' . date('r')
            ];

            // Conteúdo do email
            $text_message = "Por favor, acesse o link para verificar seu e-mail: {$verification_url}\n";
            $text_message .= "Este link expira em {$this->verification_config['expiration_hours']} horas.";

            $html_message = "
            <html>
            <head>
                <title>Verificação de E-mail</title>
            </head>
            <body>
                <h2>Confirme seu e-mail</h2>
                <p>Por favor, clique no link abaixo para verificar seu e-mail:</p>
                <p><a href='{$verification_url}'>{$verification_url}</a></p>
                <p>Este link expira em {$this->verification_config['expiration_hours']} horas.</p>
            </body>
            </html>";

            $message = "--" . $boundary . "\r\n";
            $message .= "Content-Type: text/plain; charset=UTF-8\r\n";
            $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $message .= chunk_split(base64_encode($text_message)) . "\r\n";

            $message .= "--" . $boundary . "\r\n";
            $message .= "Content-Type: text/html; charset=UTF-8\r\n";
            $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $message .= chunk_split(base64_encode($html_message)) . "\r\n";

            $message .= "--" . $boundary . "--";

            error_log("Iniciando envio de email para: " . $email);
            $smtp = $this->smtp_connect();

            error_log("Enviando MAIL FROM");
            fwrite($smtp, "MAIL FROM: <" . $this->smtp_config['from_email'] . ">\r\n");
            $this->get_smtp_response($smtp);

            error_log("Enviando RCPT TO");
            fwrite($smtp, "RCPT TO: <" . $email . ">\r\n");
            $this->get_smtp_response($smtp);

            error_log("Enviando DATA");
            fwrite($smtp, "DATA\r\n");
            $this->get_smtp_response($smtp);

            error_log("Enviando conteúdo do email");
            fwrite($smtp, implode("\r\n", $headers) . "\r\n\r\n");
            fwrite($smtp, $message . "\r\n.\r\n");
            $this->get_smtp_response($smtp);

            error_log("Finalizando conexão");
            fwrite($smtp, "QUIT\r\n");
            fclose($smtp);

            error_log("Email enviado com sucesso");
            return true;

        } catch (Exception $e) {
            error_log("Erro detalhado ao enviar email: " . $e->getMessage());
            throw new Exception("Erro ao enviar email: " . $e->getMessage());
        }
    }

    public function is_domain_banned($email) 
    {
        $domain = substr(strrchr($email, "@"), 1);
        return in_array(strtolower($domain), array_map('strtolower', $this->banned_domains));
    }

    public function generate_verification_token() 
    {
        return bin2hex(random_bytes(32));
    }

    public function save_verification_token($email, $token) 
    {
        $expiration = date('Y-m-d H:i:s', strtotime("+{$this->verification_config['expiration_hours']} hours"));
        
        $sql = "INSERT INTO tb_email_verification (email_str, token_str, expiration_dt) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $email, $token, $expiration);
        return $stmt->execute();
    }

    public function verify_email($token) 
    {
        $sql = "SELECT email_str, expiration_dt 
                FROM tb_email_verification 
                WHERE token_str = ? AND verified = 0 
                AND expiration_dt > NOW()";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return false;
        }

        $row = $result->fetch_assoc();
        
        // Marca o email como verificado
        $sql_update = "UPDATE tb_email SET verified = 1 
                      WHERE email_str = ?";
        $stmt_update = $this->db->prepare($sql_update);
        $stmt_update->bind_param("s", $row['email_str']);
        
        // Marca o token como usado
        $sql_token = "UPDATE tb_email_verification 
                     SET verified = 1 
                     WHERE token_str = ?";
        $stmt_token = $this->db->prepare($sql_token);
        $stmt_token->bind_param("s", $token);

        return $stmt_update->execute() && $stmt_token->execute();
    }
}
?>