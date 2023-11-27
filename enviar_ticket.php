<?php
    header("Content-type: text/html; charset=utf-8");
    include 'componentes/protect.php';
    include 'bd/conexao.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imagens/favicon.ico" type="image/x-icon">
    <title>Sistemax Sistemas</title>
    
    <style>.carregando{color:#ff0000; font-size: 1.7rem; display: none;}</style>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/enviar-cliente.css">
    <script src="js/contador_caracteres.js" defer></script>

</head>

<body style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
    <?php
        include 'componentes/navbar.php';
    ?>
    <div class="container">
        <div class="row text-center">
            <h1 class="fs-1"><b>Enviar Ticket</b></h1>
        </div>
        <div class="row justify-content-center">
            <hr class="hrrrr"></hr>
        </div>
        <form action="action/salvar_ticket.php" method="post">
            <div class="row d-flex justify-content-center">
                <div class="col-6 text-center">
                    <label class=" fs-2"><b>Tópico</b></label>
                    <select class="caixinhanav mb-4" name="topico" id="topico"required>
                        <?php   
                            $result_topico = "SELECT * FROM topico WHERE ativo = 1 ORDER BY topico";
                            $resultado_topico = mysqli_query($mysqli, $result_topico);
                            while($row_topico = mysqli_fetch_assoc($resultado_topico)){ 
                                echo "<option value='" . $row_topico['id'] . "'> " . $row_topico['topico'] . "</option>";
                            }
                        ?>
                        <option value="" selected disabled>Selecione uma opção</option>
                    </select>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-6 d-flex flex-column text-center">
                    <label class="fs-3 "><b>Subtópico</b></label>
                    <span class="carregando">Carregando, aguarde...</span>
                    <select class="caixinhanav mb-4" name="subtopico" id="subtopico" required>
                        <option value="nada" selected disabled>Selecione uma opção</option>
                    </select>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-6 text-center">
                    <label class="fs-2 "><b>Título</b></label>
                    <input type="text" maxlength="50" name="titulo" id="titulo"  class="caixinhanav mb-4" placeholder="Ex: Não consigo emitir NF-e" required>
                </div>
            </div>    
            <div class="row d-flex justify-content-center">
                <div class="col-6 text-center">
                    <label class="fs-3 "><b>Detalhes</b></label>
                    <textarea name="detalhes" id="detalhes" rows="5" cols="75" class="caixinhanav2 mb-4" placeholder="Detalhe mais sobre o seu problema!" required></textarea>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-4">
                <div class="d-grid gap-2">
                        <button class="btn btn-primary  fs-4 mb-4" name="btnenviar" id="btnenviar" type="submit">Enviar Ticket</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
		$(function(){
			$('#topico').change(function(){
				if( $(this).val() ) {
					$('#subtopico').hide();
					$('.carregando').show();
					$.getJSON('subtopico_post.php?search=',{topico: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="" disabled>Escolha Subtopico</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id + '">' + j[i].nome_subtopico + '</option>';
						}	
						$('#subtopico').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#subtopico').html('<option value="" >– Escolha Subtopico –</option>');
				}
			});
		});
	</script>
    <script>
        function enviarticket(){
          alert("Ticket enviado com sucesso! Por favor aguarde.");          
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#subtopico').select2({
                language: "pt"
            });
        });
        $(document).ready(function() {
            $('#topico').select2({
                language: "pt"
            });
        });
    </script>
</body>
</html>