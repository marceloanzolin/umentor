<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar/Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo isset($usuario) ? 'Editar Usuário' : 'Adicionar Usuário'; ?></h1>
        <form method="post" action="<?php echo isset($usuario) ? site_url('usuarios/salvar/'.$usuario['id']) : site_url('usuarios/salvar'); ?>">
        <input type="hidden" id="id" name="id" value="<?php echo isset($usuario) ? $usuario['id'] : null ?>">
        <div class="mb-3">
                <label for="nome" class="form-label required">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($usuario) ? $usuario['nome'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label required" >Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($usuario) ? $usuario['email'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="data_admissao" class="form-label required">Data de Admissão</label>
                <input type="date" class="form-control" id="data_admissao" name="data_admissao" value="<?php echo isset($usuario) ? $usuario['data_admissao'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="situacao" class="form-label">Situação</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="situacao_chk" name="situacao" value="A" <?php echo (isset($usuario) && $usuario['situacao'] === 'A') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="situacao_chk"><?php echo (isset($usuario) && $usuario['situacao'] === 'A') ? 'Ativo' : 'Inativo'; ?></label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="<?php echo site_url('usuarios'); ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
