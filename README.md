# umentor
Respositório Umentor

## Instruções de Configuração

1. **Script de Criação da Base de Dados**

   O script para criação da base de dados e da tabela de usuários está localizado em: \application\db\db_script.sql

2. **Configuração da Conexão com a Base de Dados**

A configuração da conexão com a base de dados deve ser ajustada no arquivo: \application\config\database.php

    Atualize os seguintes parâmetros conforme necessário:

    'username' => '',
    'password' => '',
    'database' => '',

3. **Configuração da URL**

A configuração da URL do projeto deve ser ajustada no arquivo: \application\config\config.php

    $config['base_url'] = 'http://localhost/umentor/';