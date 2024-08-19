<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
    <script>
            $(document).ready(function() {
                <?php if ($this->session->flashdata('message')): ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: '<?php echo $this->session->flashdata('message'); ?>',
                        confirmButtonText: 'OK'
                    });
                <?php endif; ?>
            });
        </script>
        <h1>Listagem de Usuários</h1>
        <div class="d-flex justify-content-between col-md-12">
            <div class="mb-2 d-flex" style="width:50%;"> 
                    <input type="text" id="filtro"  class="form-control col-md-6" placeholder="Digite o nome do usuário para pesquisar" value="<?php echo $this->input->get('filtro'); ?>">
                </div>
                <div class="mb-1"> 
                    <a href="<?php echo site_url('usuarios/manutencao'); ?>" class="btn btn-success">Adicionar Usuário</a>
                </div>
            </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Situação</th>
                    <th>Data de Admissão</th>
                    <th>Data de Cadastro</th>
                    <th>Data de Atualização</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="tabela-usuario">
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nome']; ?></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td><?php echo $usuario['situacao'] == "A" ? "Ativo" : "Inativo"; ?></td>
                        <td class="data-admissao" data-date="<?php echo $usuario['data_admissao']; ?>"></td>
                        <td class="data-cadastro" data-date="<?php echo $usuario['data_hora_cadastro']; ?>"></td>
                        <td class="data-atualizacao" data-date="<?php echo $usuario['data_hora_atualizacao']; ?>"></td>
                        <td>
                            <a href="<?php echo site_url('usuarios/manutencao/'.$usuario['id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="<?php echo site_url('usuarios/excluir/'.$usuario['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            function formataData(date) {
                    return moment(date).format('DD/MM/YYYY');
            }

            function formataDataHora(dateTime) {
                if(dateTime == null){
                    return '';
                }
                return moment(dateTime).format('DD/MM/YYYY HH:mm:ss');
            }

            function carregaDados(data) {
                var rows = '';
                $.each(data, function(index, usuario) {
                    rows += '<tr>';
                    rows += '<td>' + usuario.id + '</td>';
                    rows += '<td>' + usuario.nome + '</td>';
                    rows += '<td>' + usuario.email + '</td>';
                    rows += '<td>' + usuario.situacao + '</td>';
                    rows += '<td>' + formataData(usuario.data_admissao) + '</td>';
                    rows += '<td>' + formataDataHora(usuario.data_hora_cadastro) + '</td>';
                    rows += '<td>' + formataDataHora(usuario.data_hora_atualizacao) + '</td>';
                    rows += '<td>';
                    rows += '<a href="<?php echo site_url('usuarios/manutencao/'); ?>' + usuario.id + '" class="btn btn-warning btn-sm">Editar</a> ';
                    rows += '<a href="<?php echo site_url('usuarios/excluir/'); ?>' + usuario.id + '" class="btn btn-danger btn-sm" onclick="return confirm(\'Tem certeza que deseja excluir este usuário?\')">Deletar</a>';
                    rows += '</td>';
                    rows += '</tr>';
                });
                $('#tabela-usuario').html(rows);
            }
            function carregaTabela() {
                $.ajax({
                    url: '<?php echo site_url('usuarios/pesquisarUsuario'); ?>',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        carregaDados(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao carregar dados iniciais:', error);
                    }
                });
            }
            carregaTabela();

            $('#filtro').on('input', function() {
                var filtroQuery = $(this).val();
                
                $.ajax({
                    url: '<?php echo site_url('usuarios/pesquisarUsuario'); ?>',
                    method: 'GET',
                    data: { filtro: filtroQuery },
                    dataType: 'json',
                    success: function(data) {
                        carregaDados(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao buscar dados:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>
