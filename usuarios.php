<?php
include 'componentes/protect.php';
if(isset($_SESSION['mensagem'])){
    ?>
    <script>
        window.onload = function(){
            alert("<?php echo $_SESSION['mensagem'];?>")
        }
    </script>
    <?php
}
 unset($_SESSION['mensagem']);


include 'bd/conexao.php';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imagens/favicon.ico" type="image/x-icon">
    <title>Sistemax Sistemas</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/meu-ticket.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">

    <?php
    include 'componentes/navbar.php';
    $sql = "SELECT *  FROM usuario user
            JOIN empresa emp
            ON emp.id_empresa = user.id_empresa_usuario
            JOIN nivel niv
            ON niv.id = user.id_nivel
            ORDER BY user.id_user DESC";

    $usuarios = $mysqli->query($sql);
    ?>
    <div class="container mb-4">
        <h1 class="text-center"><b>Usuários</b></h1>
        <hr class="hrrrr">
        </hr>

        <button data-toggle='modal' data-target='#modalcaduser' class="btn btn-primary mb-3">
            <a class='fs-6 a-sem' style="color:white;" >Cadastrar Usuário</a>
        </button>

        <table class="table table-striped table-bordered" id="table_usuarios">

            <thead>
                <tr>
                    <th class="text-center ms-1" scope="col-1">#</th>
                    <th class="text-center" scope="col-2">Nome</th>
                    <th class="text-center" scope="col-2">Empresa</th>
                    <th class="text-center" scope="col-2">E-mail</th>
                    <th class="text-center" scope="col-1">Data criação</th>
                    <th class="text-center" scope="col-1">Nivel</th>
                    <th class="text-center" scope="col-1">Ativo</th>
                    <th class="text-center " scope="col-1">Ação</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($usuarios)) {
                    $date = $user_data['data_criacao_user'];
                    $data = date_create($date);
                    $data_formatada = date_format($data, 'd/m/Y - H:i');
                    $ativo = $user_data['ativo_user'];
                    $id = $user_data['id_user'];
                    if ($ativo != 0) {
                        $ativo_result = "SIM";
                    } else {
                        $ativo_result = "NÃO";
                    }
                ?>
                    <tr class='text-center align-middle'>
                        <td><?php echo $id; ?></td>          
                        <td><?php echo $user_data['nome']; ?></td>
                        <td><?php echo $user_data['empresa']; ?></td>
                        <td><?php echo $user_data['email']; ?></td>
                        <td><?php echo $data_formatada; ?></td>
                        <td><?php echo $user_data['descricao']; ?></td>
                        <td><?php echo $ativo_result; ?></td>
                        <td>
                            <button onclick=" editUser(<?php echo $id; ?>)" class="btn btn-sm btn-danger">
                                <a class='a-sem' style="font-size: 1rem; color:white;">Editar</a>
                            </button>
                        </td>
                    </tr>



                <?php } ?>




            </tbody>

        </table>

        <!-- MODAL EDITAR USUARIO -->
        <div class="modal fade" id="editUser" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class=" fs-2 modal-title"><b>Editar Usuário</b></h4>
                    </div>

                    <div class="modal-body">
                        <span id='msgAlertErrorEdit'></span>
                        <form id="form-edit-user" method="POST">

                            <div class="container d-flex flex-column">
    
                                <input type="text" class="caixinhanav " name="idUsuarioEdit" hidden id="idUsuarioEdit" >
                                <label class=" fs-4"><b>Nome</b></label>
                                <input type="text" class="caixinhanav " name="nomeUsuarioEdit" id="nomeUsuarioEdit" placeholder="Nome do usuário" required>
                                <!-- -->
                                <label class=" fs-4" id="labelEmpresa"><b>Empresa</b></label>
                                <select class="caixinhanav" type='text' name="empresaUsuarioEdit" id="empresaUsuarioEdit" required>                                
                                    
                                    <?php
                                    $result_empresa = "SELECT * FROM empresa ORDER BY empresa";
                                    $resultado_empresa = mysqli_query($mysqli, $result_empresa);
                                    while ($row_empresa = mysqli_fetch_assoc($resultado_empresa)) {
                                        
                                    ?>
                                        <option value='<?php echo $row_empresa['id_empresa']; ?>'><?php echo $row_empresa['empresa']; ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- -->
                                <label class=" fs-4"><b>E-mail</b></label>
                                <input type="text" class="caixinhanav " name="emailUserEdit" id="emailUserEdit" placeholder="E-mail do usuário">
                                <label class=" fs-4" id="labelNivel"><b>Nivel</b></label>
                                <select class=" caixinhanav" name="nivelUsuarioEdit" id="nivelUsuarioEdit" required>
                                    <?php
                                    $result_nivel = "SELECT * FROM nivel ORDER BY descricao";
                                    $resultado_nivel = mysqli_query($mysqli, $result_nivel);
                                    while ($row_nivel = mysqli_fetch_assoc($resultado_nivel)) {
                                    ?>
                                        <option value='<?php echo $row_nivel['id']; ?>'><?php echo $row_nivel['descricao']; ?> </option>;
                                    <?php
                                    }
                                    ?>
                                    <option value="" selected disabled>Selecione uma opção</option>
                                </select>

                                <label class="  fs-4"><b>Ativo?</b></label>
                                    <select name="ativoUserEdit" id="ativoUserEdit" class=" caixinhanav" required>
                                    <option selected value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                                
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger  botaofecharnav" data-dismiss="modal">Fechar</button>
                        <button type="submit" value="enviar_usuario" name="enviar_usuario"class="btn  botaonav" onclick="setInterval('atualizar()', 2000)">Enviar</button>
                    </div>

                    </form>

                </div>
            </div>
        </div>






    </div>
    <!-- MODAL CADASTRAR USUARIO -->
    <div class="modal fade" id="modalcaduser" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class=" fs-2 modal-title"><b>Cadastrar Usuário</b></h4>
                </div>

                <div class="modal-body">

                    <form action="action/salvar_usuario.php" method="post">

                        <div class="container d-flex flex-column">
                            <label class=" fs-4"><b>Nome</b></label>
                            <input type="text" class="caixinhanav " name="nomeUsuarioNav" id="nomeUsuarioNav" placeholder="Nome do usuário" required>
                            <label class=" fs-4"><b>E-mail</b></label>
                            <input type="text" class="caixinhanav " name="emailUser" id="emailUser" placeholder="E-mail do usuário">
                            <label class=" fs-4" ><b>Empresa</b></label>
                            <select class=" caixinhanav" type='text' name="empresaUsuarioNav" id="empresaUsuarioNav" style="width: 100%; height: 40px; font-size: 25px; border-radius: 10px; border: solid 2.5px; margin-bottom: 10px; padding: 4px; font-size: 1.3rem;" required>
                                <?php
                                $result_empresa = "SELECT * FROM empresa ORDER BY empresa";
                                $resultado_empresa = mysqli_query($mysqli, $result_empresa);
                                while ($row_empresa = mysqli_fetch_assoc($resultado_empresa)) {
                                ?>
                                    <option value='<?php echo $row_empresa['id_empresa']; ?>'><?php echo $row_empresa['empresa']; ?> </option>;
                                <?php
                                }
                                ?>
                                <option value="" selected disabled>Selecione uma opção</option>
                            </select>
                            <label class=" fs-4" ><b>Nivel</b></label>
                            <select class=" caixinhanav" name="nivelUsuarioNav" id="nivelUsuarioNav" required>
                                <?php
                                $result_nivel = "SELECT * FROM nivel ORDER BY descricao";
                                $resultado_nivel = mysqli_query($mysqli, $result_nivel);
                                while ($row_nivel = mysqli_fetch_assoc($resultado_nivel)) {
                                ?>
                                    <option value='<?php echo $row_nivel['id']; ?>'><?php echo $row_nivel['descricao']; ?> </option>;
                                <?php
                                }
                                ?>
                                <option value="" selected disabled>Selecione uma opção</option>
                            </select>
                            <label class=" fs-4"><b>Senha</b></label>
                            <input type="password" minlength="8" name="senhaUsuarioNav" id="senhaUsuarioNav" class="caixinhanav " placeholder="Digite a senha" required>
                            <label class=" fs-4"><b>Confirmar senha</b></label>
                            <input type="password" minlength="8" name="confirmaSenhaUsuarioNav" id="confirmaSenhaUsuarioNav" onchange="confereSenha()" class=" caixinhanav" placeholder="Confirme a senha" required>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger  botaofecharnav" data-dismiss="modal">Fechar</button>
                    <button type="submit" value="enviar_usuario" name="enviar_usuario" onchange="confereSenha()" class="btn  botaonav">Enviar</button>
                </div>

                </form>

            </div>
        </div>
    </div>






    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#table_usuarios').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                },
            });
        });
    </script>

    <script>
        const editModal = new bootstrap.Modal(document.getElementById("editUser"));
        async function editUser(id) {
            //console.log("Editar: " + id);
            const dados = await fetch('componentes/selecionar_user.php?id=' + id);
            const resposta = await dados.json();
            console.log(resposta);

            editModal.show();

            document.getElementById("idUsuarioEdit").value = resposta['id_user'];
            document.getElementById("nomeUsuarioEdit").value = resposta['nome'];
            document.getElementById("emailUserEdit").value = resposta['email'];
            document.getElementById("empresaUsuarioEdit").value = resposta['id_empresa'];            
            document.getElementById("nivelUsuarioEdit").value = resposta['id'];
            // document.getElementById("labelEmpresa").innerHTML = "Empresa (" + resposta['empresa'] + ")";
            // document.getElementById("labelNivel").innerHTML = "Nivel (" + resposta['descricao'] + ")";
        }

        const formEditUser = document.getElementById("form-edit-user");
        if(formEditUser){
            formEditUser.addEventListener("submit", async(e) => {
                e.preventDefault();
                const dadosForm = new FormData(formEditUser);

                const dados = await fetch("componentes/editar_user.php", {
                    method: "POST",
                    body: dadosForm
                });

                console.log(dados);

                const resposta = await dados.json();

                if(resposta['status']){
                    document.getElementById("msgAlertErrorEdit").innerHTML = resposta['msg'];
                }else{
                    document.getElementById("msgAlertErrorEdit").innerHTML = resposta['msg'];
                }


            });
        }

    </script>
    <script>
        function atualizar(){
            window.location.reload();
        }
    </script>
    <script type="text/javascript">
        //Cadastrar
        $(document).ready(function() {
            $('#empresaUsuarioNav').select2({
                dropdownParent: $('#modalcaduser'),
                language: "pt"
            });
        });
        
    </script>



</body>

</html>