<main class= "auth">
    <h2 class="auth__heading"> <?php echo $titulo; ?> </h2>
    <p class="auth__texto"> Coloca tu nuevo password</p>

         <?php 
        require_once __Dir__ . '/../templates/alertas.php';
        ?>


<?php if($token_valido) { ?>

        <form method=POST  class="formulario">
            <div class="formulario__campo">
            <label for="password" class="formulario__label"> Nuevo password</label>
            <input
            type="password"
            class= "formulario__input"
            placeholder="Tu nuevo password"
            id="password"
            name="password"
            >
            </div>
        

            <input type="submit" class="formulario__boton" value= "Guardar Password">

        </form>
<?php }  ?>
        <div class="acciones">
                    <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar Sesión</a>
                    <a href="/registro" class="acciones__enlace">¿Aun no tienes cuenta? Obtener una</a>
                </div>



</main>