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
    $sql = "SELECT *  FROM empresa emp
            ORDER BY id_empresa DESC";

        $empresas = $mysqli->query($sql);
    ?>
    <div class="container mb-4">
        <h1 class="text-center"><b>Empresas</b></h1>
        <hr class="hrrrr">
        </hr>

        <button data-toggle='modal' data-target='#modalcademp' class="btn btn-primary mb-3">
            <a class='fs-6 a-sem' >Cadastrar empresas</a>
        </button>

        <table class="table table-striped table-bordered" id="table_empresas">

            <thead>
                <tr>
                    <th class="text-center" scope="col-1">#</th>
                    <th class="text-center" scope="col-1">Nome Fantasia</th>
                    <th class="text-center" scope="col-2">Razão Social</th>
                    <th class="text-center" scope="col-2">CNPJ</th>
                    <th class="text-center" scope="col-1">Data Cadastro</th>
                    <th class="text-center" scope="col-1">Ativo?</th>
                    <th class="text-center" scope="col-1">Ação</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($empresas)) {
                    $date = $user_data['data'];
                    $data = date_create($date);
                    $data_formatada = date_format($data, 'd/m/Y - H:i');
                    $ativo = $user_data['ativo'];
                    $id = $user_data['id_empresa'];
                    if($ativo == 1){
                        $ativo_result = "SIM";
                    }else{
                        $ativo_result = "NÃO";
                    }
                ?>
                    <tr class='text-center'>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $user_data['empresa']; ?></td>
                        <td><?php echo $user_data['razao_social']; ?></td>                 
                        <td><?php echo $user_data['cnpj']; ?></td>
                        <td><?php echo $data_formatada; ?></td>
                        <td><?php echo $ativo_result; ?></td>
                        <td>
                            <button onclick="editEmpresa(<?php echo $id; ?>)" class="btn btn-sm btn-danger">
                                <a class='a-sem' style="font-size: 1rem; color:white;">Editar</a>
                            </button>
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>
        




        


    </div>
    <!-- MODAL CADASTRAR EMPRESA -->
    <div class="modal fade" id="modalcademp" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class=" fs-2 modal-title"><b>Cadastrar Empresa</b></h4>
                </div>

                <div class="modal-body">

                    <form action="action/salvar_empresa.php" method="post">
                        <div class="container">
                            <label class="  fs-4"><b>Nome Fantasia</b></label>
                            <input type="text" name="empresaNav" id="empresaNav" class="caixinhanav" placeholder="Nome da empresa" required>

                            <label class="  fs-4"><b>Razão social</b></label>
                            <input type="text" name="razaoSocialNav" id="razaoSocialNav-social" class="caixinhanav" placeholder="Razão social" required>

                            <label class=" fs-4"><b class="">CNPJ</b></label>
                            <input type="text" name="cnpjNav" minlength="14" maxlength="14" id="cnpjNav" class="caixinhanav" placeholder="Digite o CNPJ (sem '.' e '/')" required>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger  botaofecharnav" data-dismiss="modal">Fechar</button>
                    <button type="submit" value="enviar_empresa" name="enviar_empresa" class=" botaonav">Enviar</button>
                </div>

                </form>

            </div>
        </div>
    </div>

    <!-- MODAL EDITAR EMPRESA -->
    <div class="modal fade" id="modalEditEmpresa" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class=" fs-2 modal-title"><b>Editar Empresa</b></h4>
                </div>

                <div class="modal-body">
                    <span id='msgAlertErrorEdit'></span>
                    <form id="form-edit-empresa" method="post">
                        <div class="container">

                            <input type="text" class="caixinhanav " name="idEmpresaEdit" hidden id="idEmpresaEdit" >

                            <label class="  fs-4"><b>Nome Fantasia</b></label>
                            <input type="text" name="empresaEdit" id="empresaEdit" class="caixinhanav" placeholder="Nome da empresa" required>

                            <label class="  fs-4"><b>Razão social</b></label>
                            <input type="text" name="razaoSocialEdit" id="razaoSocialEdit" class="caixinhanav" placeholder="Razão social" required>

                            <label class=" fs-4"><b class="">CNPJ</b></label>
                            <input type="text" name="cnpjEdit" minlength="14" maxlength="14" id="cnpjEdit" class="caixinhanav" placeholder="Digite o CNPJ (sem '.' e '/')" required>

                            <label class="  fs-4"><b>Ativo?</b></label>
                                <select name="ativoEmpresaEdit" id="ativoEmpresaEdit" class=" caixinhanav" required>
                                    <option selected value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger  botaofecharnav" data-dismiss="modal">Fechar</button>
                    <button type="submit" value="enviar_empresa" name="enviar_empresa" class=" botaonav" onclick="setInterval('atualizar()', 2000)">Enviar</button>
                </div>

                </form>

            </div>
        </div>
    </div>




    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#table_empresas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                },
            });
        });
    </script>

    <script>
        const editModal = new bootstrap.Modal(document.getElementById("modalEditEmpresa"));
        async function editEmpresa(id) {
            //console.log("Editar: " + id);
            const dados = await fetch('componentes/selecionar_empresa.php?id=' + id);
            const resposta = await dados.json();
            console.log(resposta);

            editModal.show();

            document.getElementById("idEmpresaEdit").value = resposta['id_empresa'];
            document.getElementById("empresaEdit").value = resposta['empresa'];
            document.getElementById("razaoSocialEdit").value = resposta['razao_social'];
            document.getElementById("cnpjEdit").value = resposta['cnpj'];
            document.getElementById("ativoEmpresaEdit").value = resposta['ativo'];
            // document.getElementById("nivelUsuarioEdit").value = resposta['descricao'];
            
        }

        const formEditEmpresa = document.getElementById("form-edit-empresa");
        if(formEditEmpresa){
            formEditEmpresa.addEventListener("submit", async(e) => {
                e.preventDefault();
                const dadosForm = new FormData(formEditEmpresa);

                const dados = await fetch("componentes/editar_empresa.php", {
                    method: "POST",
                    body: dadosForm
                });

                console.log(dados);

                const resposta = await dados.json();

                if(resposta['status']){
                    document.getElementById("msgAlertErrorEdit").innerHTML = resposta['msg']
                }else{
                    document.getElementById("msgAlertErrorEdit").innerHTML = resposta['msg']
                }


            });
        }

    </script>
    <script>
        function atualizar(){
            window.location.reload();
        }
    </script>

</body>

</html>