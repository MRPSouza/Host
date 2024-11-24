<?php
class PASSWORD_VALIDATOR 
{
    private $prohibited_passwords = [];

    public function __construct() 
    {
        $this->load_prohibited_passwords();
    }

    private function load_prohibited_passwords() 
    {
        // Define o caminho base para os arquivos
        $base_path = dirname(__DIR__); // Volta um diretório acima de resources

        // Carrega senhas vazadas
        $leaked_path = $base_path . '/prohibited passwords/leaked.passwords.ini';
        if (file_exists($leaked_path)) {
            $leaked_passwords = file($leaked_path);
            if ($leaked_passwords) {
                foreach ($leaked_passwords as $password) {
                    $password = trim($password);
                    if (!empty($password) && !str_starts_with($password, '[')) {
                        $this->prohibited_passwords[] = strtolower($password);
                    }
                }
            }
        }

        // Carrega senhas fracas
        $weak_path = $base_path . '/prohibited passwords/weak.passwords.ini';
        if (file_exists($weak_path)) {
            $weak_passwords = file($weak_path);
            if ($weak_passwords) {
                foreach ($weak_passwords as $password) {
                    $password = trim($password);
                    if (!empty($password) && !str_starts_with($password, '[')) {
                        $this->prohibited_passwords[] = strtolower($password);
                    }
                }
            }
        }

        // Se nenhuma senha foi carregada, lança uma exceção
        if (empty($this->prohibited_passwords)) {
            throw new Exception("Não foi possível carregar as listas de senhas proibidas.");
        }
    }

    public function is_password_prohibited($password) 
    {
        return in_array(strtolower($password), $this->prohibited_passwords);
    }
}
?> 