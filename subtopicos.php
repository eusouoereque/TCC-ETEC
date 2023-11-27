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
    $sql = "SELECT subt.id, subt.subtopico, subt.ativo, topi.topico, prio.prioridade FROM subtopico subt
            JOIN topico topi
            ON topi.id = subt.id_topico
            JOIN prioridade prio
            ON prio.id = subt.id_prioridade
            ORDER BY subt.id DESC";

    $funcionalidades = $mysqli->query($sql);
    ?>

    <div class="container mb-4">
        <h1 class="text-center"><b>Subtópicos</b></h1>
        <hr class="hrrrr"></hr>

        <button data-toggle='modal' data-target='#modalCadFunc' class="btn btn-primary mb-3">
            <a class='fs-6 a-sem' style="color:white;" >Adicionar Subtópico</a>
        </button>

        <table class="table table-striped table-bordered" id="table_funcionalidades">

            <thead>
                <tr>
                    <th class="text-center ms-1" scope="col-1">#</th>
                    <th class="text-center" scope="col-2">Tópico</th>
                    <th class="text-center" scope="col-2">Subtópico</th>    
                    <th class="text-center" scope="col-1">Prioridade</th>
                    <th class="text-center" scope="col-2">Ativo</th>
                    <th class="text-center " scope="col-1">Ação</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($funcionalidades)) {
                    $ativo = $user_data['ativo'];
                    $id = $user_data['id'];
                    if ($ativo != 0) {
                        $ativo_result = "SIM";
                    } else {
                        $ativo_result = "NÃO";
                    }
                ?>
                    <tr class='text-center align-middle'>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $user_data['topico']; ?></td>          
                        <td><?php echo $user_data['subtopico']; ?></td>          
                        <td><?php echo $user_data['prioridade']; ?></td>
                        <td><?php echo $ativo_result; ?></td>
                        <td>
                            <button onclick=" editFuncionalidade(<?php echo $id; ?>)" class="btn btn-sm btn-danger">
                                <a class='a-sem' style="font-size: 1rem; color:white;">Editar</a>
                            </button>
                        </td>
                    </tr>



                <?php } ?>




            </tbody>

        </table>
    </div>


    <!-- MODAL ADICIONAR SUBTOPICO -->
    <div class="modal fade" id="modalCadFunc" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class=" fs-2 modal-title"><b>Adicionar Subtópico</b></h4>
                </div>

                <div class="modal-body">

                    <form action="action/salvar_subtopico.php" method="post">

                    <div class="container">
                        
                        <label class=" fs-4" id="labelAssunto"><b>Tópico</b></label>
                        <select class="caixinhanav" name="topicoSubtopicoNav" id="topicoSubtopicoNav" style="width: 100%; height: 40px; font-size: 25px; border-radius: 10px; border: solid 2.5px; margin-bottom: 10px; padding: 4px; font-size: 1.3rem;" required>
                        <?php
                        $result_topico = "SELECT * FROM topico WHERE ativo = 1 ORDER BY topico";
                        $resultado_topico = mysqli_query($mysqli, $result_topico);
                        while ($row_topico = mysqli_fetch_assoc($resultado_topico)) {
                            echo "<option value='" . $row_topico['id'] . "'> " . $row_topico['topico'] . "</option>";
                        }
                        ?>
                        <option value="" selected disabled>Selecione uma opção</option>
                        </select>
                
                        <label class="  fs-4"><b>Subtópico</b></label>
                        <input type="text" name="subtopicoNav" id="subtopicoNav" class="caixinhanav" placeholder="Nome do Subtópico" required>

                        <label class=" fs-4"><b>Prioridade</b></label>
                        <select class="caixinhanav" name="subtopicoPrioridadeNav" id="subtopicoPrioridadeNav" required>
                        <option value="3">Baixa</option>
                        <option value="2">Média</option>
                        <option value="1">Alta</option>
                        <option value="" selected disabled>Selecione uma opção</option>
                        </select>

                        <label class="  fs-4"><b>Ativo?</b></label>
                        <select name="ativoSubtopicoNav" id="ativoSubtopicoNav" class="caixinhanav" required>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                        <option value="" selected disabled>Selecione uma opção</option>
                        </select>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger  botaofecharnav" data-dismiss="modal">Fechar</button>
                    <button type="submit" value="enviar_subtopico" name="enviar_subtopico" class="btn  botaonav">Enviar</button>
                </div>

                </form>

            </div>
        </div>
    </div>
    
    
    <!-- MODAL EDITAR SUBTOPICO -->
    <div class="modal fade" id="modalEditFunc" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class=" fs-2 modal-title"><b>Editar Subtópico</b></h4>
                </div>

                <div class="modal-body">
                    <span id='msgAlertErrorEdit'></span>
                    <form id="form-edit-funcionalidade" method="post">

                    <div class="container">

                        <input type="text" class="caixinhanav " hidden name="idFuncEdit" id="idFuncEdit" >

                        <label class=" fs-4" id="labelAssunto"><b>Tópico</b></label>
                        <select class="caixinhanav" name="topicoFuncEdit" id="topicoFuncEdit" required>
                        <?php
                        $result_topico = "SELECT * FROM topico WHERE ativo = 1 ORDER BY topico";
                        $resultado_topico = mysqli_query($mysqli, $result_topico);
                        while ($row_topico = mysqli_fetch_assoc($resultado_topico)) {
                            echo "<option value='" . $row_topico['id'] . "'> " . $row_topico['topico'] . "</option>";
                        }
                        ?>
                        <option value="" selected disabled>Selecione uma opção</option>
                        </select>

                        <label class="  fs-4"><b>Subtópico</b></label>
                        <input type="text" name="funcEdit" id="funcEdit" class="caixinhanav" placeholder="Nome do Subutópico" required>

                        <label class=" fs-4" id="labelPrioridade"><b>Prioridade</b></label>
                        <select class="caixinhanav" name="funcPrioridadeEdit" id="funcPrioridadeEdit" required>
                        <option value="3">Baixa</option>
                        <option value="2">Media</option>
                        <option value="1">Alta</option>
                        <option value="" selected disabled>Selecione uma opção</option>
                        </select>

                        <label class="  fs-4"><b>Ativo?</b></label>
                        <select name="ativoFuncEdit" id="ativoFuncEdit" class="caixinhanav" required>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                        <option value="" selected disabled>Selecione uma opção</option>
                        </select>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger  botaofecharnav" data-dismiss="modal">Fechar</button>
                    <button type="submit" value="enviar_subtopico" name="enviar_subtopico" class="btn  botaonav" onclick="setInterval('atualizar()', 2000)">Enviar</button>
                </div>

                </form>

            </div>
        </div>
    </div>











    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#table_funcionalidades').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                },
            });
        });
    </script>

<script>
        const editModal = new bootstrap.Modal(document.getElementById("modalEditFunc"));
        async function editFuncionalidade(id) {
            //console.log("Editar: " + id);
            const dados = await fetch('componentes/selecionar_funcionalidade.php?id=' + id);
            const resposta = await dados.json();
            console.log(resposta);

            editModal.show();

            document.getElementById("idFuncEdit").value = resposta['id'];
            document.getElementById("topicoFuncEdit").value = resposta['id_topico'];
            // document.getElementById("labelAssunto").innerHTML = "Assunto (" + resposta['topico'] + ")";
            document.getElementById("funcEdit").value = resposta['subtopico'];
            document.getElementById("funcPrioridadeEdit").value = resposta['id_prioridade'];
            // document.getElementById("labelPrioridade").innerHTML = "Prioridade (" + resposta['prioridade'] + ")"; 
            document.getElementById("ativoFuncEdit").value = resposta['ativo'];
            
        }

        const formEditFunc = document.getElementById("form-edit-funcionalidade");
        if(formEditFunc){
            formEditFunc.addEventListener("submit", async(e) => {
                e.preventDefault();
                const dadosForm = new FormData(formEditFunc);

                const dados = await fetch("componentes/editar_funcionalidade.php", {
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
    <script type="text/javascript">
        //Cadastrar
        $(document).ready(function() {
            $('#topicoSubtopicoNav').select2({
                dropdownParent: $('#modalCadFunc'),
                language: "pt"
            });
        });
        $(document).ready(function() {
            $('#nivelUsuarioNav').select2({
                dropdownParent: $('#modalcaduser'),
                language: "pt"
            });
        });
    </script>

</body>

</html>