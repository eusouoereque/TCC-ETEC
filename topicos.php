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
    $sql = "SELECT *  FROM topico 
            ORDER BY id DESC";

        $assuntos = $mysqli->query($sql);
    ?>
    <div class="container mb-4">
        <h1 class="text-center"><b>Tópicos</b></h1>
        <hr class="hrrrr">
        </hr>

        <button data-toggle='modal' data-target='#modalAddAssunto' class="btn btn-primary mb-3">
            <a class='fs-6 a-sem' >Adicionar Tópico</a>
        </button>

        <table class="table table-striped table-bordered" id="table_assuntos">

            <thead>
                <tr>
                    <th class="text-center" scope="col-1">#</th>
                    <th class="text-center" scope="col-2">Tópico</th>
                    <th class="text-center" scope="col-1">Ativo?</th>
                    <th class="text-center" scope="col-1">Ação</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($assuntos)) {
                    $id = $user_data['id'];
                    $ativo = $user_data['ativo'];
                    if($ativo == 1){
                        $ativo_result = "SIM";
                    }else{
                        $ativo_result = "NÃO";
                    }
                ?>
                    <tr class=' text-center align-middle'>
                        <td><?php echo $user_data['id']; ?></td>          
                        <td><?php echo $user_data['topico']; ?></td>
                        <td><?php echo $ativo_result; ?></td>
                        <td>
                            <button onclick=" editAssunto(<?php echo $id; ?>)" class="btn btn-sm btn-danger">
                                <a class='a-sem' style="font-size: 1rem; color:white;">Editar</a>
                            </button>
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>
        




        


    </div>
    <!-- MODAL ADICIONAR TOPICO -->
<div class="modal fade" id="modalAddAssunto" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class=" fs-2 modal-title"><b>Adicionar Tópico</b></h4>
      </div>

      <div class="modal-body">

        <form action="action/salvar_topico.php" method="post">

          <div class="container">
            <label class="  fs-4"><b>Tópico</b></label>
            <input type="text" name="topicoNav" id="topicoNav" class="caixinhanav" placeholder="Digite o nome do tópico" required>

            <label class="  fs-4"><b>Ativo?</b></label>
            <select name="ativoTopicoNav" id="ativoTopicoNav" class="caixinhanav" required>
              <option value="1">Sim</option>
              <option value="0">Não</option>
              <option value="" selected disabled>Selecione uma opção</option>
            </select>

          </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger  botaofecharnav" data-dismiss="modal">Fechar</button>
        <button type="submit" value="enviar_topico" name="enviar_topico" class=" botaonav">Enviar</button>
      </div>

      </form>

    </div>
  </div>
</div>

<!-- MODAL EDITAR TOPICO -->
<div class="modal fade" id="modalEditAssunto" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class=" fs-2 modal-title"><b>Editar Tópico</b></h4>
      </div>

      <div class="modal-body">  
        <span id='msgAlertErrorEdit'></span>
        <form id="form-edit-assunto" method="post">

          <div class="container">
            <input type="text" class="caixinhanav " hidden name="idAssuntoEdit" id="idAssuntoEdit" >

            <label class="  fs-4"><b>Tópico</b></label>
            <input type="text" name="assuntoEdit" id="assuntoEdit" class="caixinhanav" placeholder="Digite o nome do tópico" required>

            <label class="  fs-4"><b>Ativo?</b></label>
            <select name="ativoAssuntoEdit" id="ativoAssuntoEdit" class="caixinhanav" required>
              <option value="1">Sim</option>
              <option value="0">Não</option>
              <option value="" selected disabled>Selecione uma opção</option>
            </select>

          </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger  botaofecharnav" data-dismiss="modal">Fechar</button>
        <button type="submit" value="edit_topico" name="edit_topico" class=" botaonav" onclick="setInterval('atualizar()', 2000)">Enviar</button>
      </div>

      </form>

    </div>
  </div>
</div>




    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#table_assuntos').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                },
            });
        });
    </script>

<script>
        const editModal = new bootstrap.Modal(document.getElementById("modalEditAssunto"));
        async function editAssunto(id) {
            //console.log("Editar: " + id);
            const dados = await fetch('componentes/selecionar_assunto.php?id=' + id);
            const resposta = await dados.json();
            console.log(resposta);

            editModal.show();

            document.getElementById("idAssuntoEdit").value = resposta['id'];
            document.getElementById("assuntoEdit").value = resposta['topico'];
            document.getElementById("ativoAssuntoEdit").value = resposta['ativo'];
            
        }

        const formEditAssunto = document.getElementById("form-edit-assunto");
        if(formEditAssunto){
            formEditAssunto.addEventListener("submit", async(e) => {
                e.preventDefault();
                const dadosForm = new FormData(formEditAssunto);

                const dados = await fetch("componentes/editar_assunto.php", {
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