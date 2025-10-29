<?php
/** @var string $empresa */
?>
   <?php
      require_once __Dir__ . '/../templates/alertas.php';
    
    ?>
<main class="auth">
<div class="formulario-enviar-link">
    <h2 class="auth__heading">Enviar Link de Planilla - <?= ucwords(str_replace('-', ' ', $empresa)) ?></h2>

    <form method="POST" >
        <label for="correo" >Correo del trabajador:</label>
        <input type="email" name="correo" id="correo" required>

        <button type="submit">Enviar Link</button>
    </form>
</div>
</main>