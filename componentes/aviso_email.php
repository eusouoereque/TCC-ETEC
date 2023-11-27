<?php
include 'componentes/protect.php';
include 'bd/conexao.php';

if (!isset($_SESSION)) {
    session_start();
}
?>

    <?php

    $id = $_SESSION['user'];
    $sql = "SELECT * FROM usuario WHERE id_user='$id'";
    $query = mysqli_query($mysqli, $sql);
    $result = mysqli_fetch_assoc($query);
    $email = $result['email'];

    // print_r($email);

    if (empty($email)) {
    ?>

        <div class="modal" id="EmailModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <label class="fonte3 fs-4"><b>Cadastre seu e-mail</b></label>
                        <button type="button" class="btn btn-close" data-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                    <form action="action/salvar_email.php" method="post">
                        <input type="email" class="caixinhanav fonte3" name="emailUsuario" id="emailUsuario" placeholder="E-mail" required>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" value="enviar_email" name="enviar_email" class="btn fonte3 botaonav">Enviar</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $("#EmailModal").modal('show');
            });
        </script>

    <?php
    } else {
        // echo 'Tudo OK!!';
    }
    ?>
