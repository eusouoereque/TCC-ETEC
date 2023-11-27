<style>
  .pointer:hover{
    cursor: pointer;
  }
</style>

<?php
include 'protect.php';

$id = $_SESSION['user'];

$empresa = "SELECT *  FROM usuario user
  JOIN empresa emp
  ON emp.id_empresa = user.id_empresa_usuario
  WHERE user.id_user = " . " '$id' ";

$buscaEmpresa = $mysqli->query($empresa);
$dadosEmpresa = mysqli_fetch_assoc($buscaEmpresa)
?>

<link rel="stylesheet" href="css/navbar.css">

<div id="content">
  <nav class="navbar navbar-expand">
    <div class="container-fluid">
      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto d-flex justify-content-between" <li class="nav-item active">
          <a class="navbar-brand" style="width:30%" href="index.php"> <img src="imagens/logo_sistemax_branco_menor.png" alt="" class="medio"> </a>
          </li>
          <li class="nav-item pequeno">
            <a class="nav-link text-light" style="font-size: 1.7rem;" href="meu_ticket.php"><?php if ($_SESSION['nivel'] == 1) {
                                                                                              echo "Ver Tickets";
                                                                                            } else {
                                                                                              echo "Meus Tickets";
                                                                                            } ?></a>
          </li>
          <li class="nav-item pequeno">
            <?php
            if ($_SESSION['nivel'] == 1) {
            ?>
              <a class="nav-link text-light" style="font-size: 1.7rem;" href="enviar_ticket_adm.php">Enviar Ticket</a>
            <?php
            } else {
            ?>
              <a class="nav-link text-light" style="font-size: 1.7rem;" href="enviar_ticket.php">Enviar Ticket</a>
            <?php
            }
            ?>

          </li>
        </ul>
      </div>
      <button type="button" id="sidebarCollapse" class="btn btn-info" style="height: 45px; width: 50px; background-color:#0031a4; border:none;">
        <i class="fas fa-bars text-light"></i>
      </button>
    </div>
  </nav>
</div>

<nav id="sidebar">
  <div id="dismiss" class="mt-3 me-2">
    <i class="fas fa-arrow-right"></i>
  </div>
  <div class="sidebar-header">
    <h4>Bem vindo! <br> <?php echo $_SESSION['nome']; ?></h4>
    <h5 class="text-light"><?php echo $dadosEmpresa['empresa']; ?> </h5>
  </div>
  <ul class="list-unstyled components">
    <h5 class="ms-3">Menu Principal</h5>
    <li>
      <a class="ms-2 a-sem pequeno" href="meu_ticket.php"><?php if ($_SESSION['nivel'] == 1) {
                                                    echo "Ver Tickets";
                                                  } else {
                                                    echo "Meus Tickets";
                                                  } ?></a>
    </li>
    <li>
      <?php
        if ($_SESSION['nivel'] == 1) {
      ?>
        <a class=" ms-2 a-sem"  href="enviar_ticket_adm.php">Enviar Ticket</a>
      <?php
        } else {
      ?>
        <a class=" ms-2 a-sem"  href="enviar_ticket.php">Enviar Ticket</a>
      <?php
        }
      ?>
    </li>
    <li>
      <a class="ms-2 a-sem" href="index.php">Painel de controle</a>
    </li>
    <li>
    <?php
      $id_user = $_SESSION['user'];
    ?>
        <a class="ms-2 a-sem pointer" data-toggle='modal' data-target='#editConta'>Minha conta</a>
    </li>
  </ul>
  <?php
  if ($_SESSION['nivel'] == 1) {
    echo "<ul class='list-unstyled components adm'>
        <h5 class='ms-3' style='margin-top: -20px;'>Menu ADM</h5>
          <li>
            <a class='ms-2 a-sem' href='empresas.php'>Empresas</a>
          </li>
          <li>
            <a class='ms-2 a-sem' href='usuarios.php'>Usuários</a>
          </li>
          <li>
            <a class='ms-2 a-sem' href='topicos.php'>Tópicos</a>
          </li>
          <li>
            <a class='ms-2 a-sem' href='subtopicos.php'>Subtópicos</a>
          </li>
        </ul>";
  }
  ?>
  <ul class="list-unstyled CTAs logout">
    <li>
      <a class="btn btn-danger" href="componentes/logout.php" role="button">Encerrar Sessão</a>
    </li>
  </ul>
</nav>

<!-- MODAL MINHA CONTA -->

<div class="modal fade" id="editConta" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class=" fs-2 modal-title"><b>Minha conta</b></h4>
                    </div>

                    <div class="modal-body">
                      <?php 
                        $sqlDadosUser = "SELECT id_user, nome, email ,empresa FROM usuario user
                        JOIN empresa emp
                        ON user.id_empresa_usuario = emp.id_empresa
                        WHERE id_user = $id_user";
                        $dadosUser = $mysqli->query($sqlDadosUser);
                        while ($user_data = mysqli_fetch_assoc($dadosUser)) {
                            $id_user = $user_data['id_user'];
                            $nome = $user_data['nome'];
                            $email = $user_data['email'];
                            $empresa = $user_data['empresa'];
                        }
                      
                      ?>


                        <form id="form-edit-conta" action="componentes/editar_conta.php" method="POST">

                            <div class="container d-flex flex-column">
    
                                <input type="text" class="caixinhanav" value="<?php echo $id_user; ?>" name="idUsuarioEditConta" hidden  id="idUsuarioEditConta" >

                                <label class=" fs-4"><b>Nome</b></label>
                                <input type="text" value="<?php echo $nome; ?>" class="caixinhanav " name="nomeEditConta1" id="nomeEditConta1" placeholder="Nome do usuário" disabled required>

                                <input type="text" value="<?php echo $nome; ?>" class="caixinhanav " name="nomeEditConta" id="nomeEditConta" placeholder="Nome do usuário" hidden required>
                                <!-- -->
                                <label class=" fs-4" id="labelEmpresa"><b>Empresa</b></label>
                                <input class="caixinhanav" value="<?php echo $empresa; ?>" type='text' name="empresaEditConta" disabled id="empresaEditConta" required>                                
                                <!-- -->
                                <label class=" fs-4"><b>E-mail</b></label>
                                <input type="text" class="caixinhanav" value="<?php echo $email; ?>" name="emailEditConta" id="emailEditConta" placeholder="E-mail do usuário">

                                <label class=" fs-4"><b>Senha atual</b></label>
                                <input type="password" class="caixinhanav " name="senhaEditConta" id="senhaEditConta" placeholder="Insira sua senha atual" required>

                                <label class=" fs-4"><b>Nova senha</b></label>
                                <input type="password" class="caixinhanav " name="SenhaNewEditConta" id="SenhaNewEditConta" placeholder="Insira sua nova senha"  required>

                                <label class=" fs-4"><b>Repita a nova senha</b></label>
                                <input type="password" class="caixinhanav " name="SenhaNewEditContaRep" id="SenhaNewEditContaRep" placeholder="Repita sua nova senha" onchange="confereSenhaEditarConta()" required>
                                
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger  botaofecharnav" data-dismiss="modal">Fechar</button>
                        <button type="submit" value="enviar_usuario" name="enviar_usuario" onchange="confereSenhaEditarConta()" class="btn  botaonav" >Enviar</button>
                    </div>
                    <!-- onclick="setInterval('atualizar()', 2000)" -->
                    </form>

                </div>
            </div>
        </div>

<!-- Page Content  -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<!-- Popper.JS -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#sidebar").mCustomScrollbar({
      theme: "minimal"
    });

    $('#dismiss, .overlay').on('click', function() {
      $('#sidebar').removeClass('active');
      $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function() {
      $('#sidebar').addClass('active');
      $('.overlay').addClass('active');
      $('.collapse.in').toggleClass('in');
      $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
  });
</script>


<script>
  function confereSenha() {
    const senha = document.querySelector('input[name=senhaUsuarioNav]');
    const confirma = document.querySelector('input[name=confirmaSenhaUsuarioNav]');
    if (confirma.value === senha.value) {
      confirma.setCustomValidity('');
    } else {
      confirma.setCustomValidity('As senhas não são iguais');
    }
  }
</script>

<script>
  function confereSenhaEditarConta() {
    const senhaConta = document.querySelector('input[name=SenhaNewEditConta]');
    const confirmaConta = document.querySelector('input[name=SenhaNewEditContaRep]');
    if (confirmaConta.value == senhaConta.value) {
      confirmaConta.setCustomValidity('');
    } else {
      confirmaConta.setCustomValidity('As senhas não são iguais');
    }
  }
</script>

<!-- MASCARA PARA CNPJ -->
<script src="js/contador_caracteres_cnpj.js" defer></script>
    