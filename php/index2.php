<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="../css/index2.css" type="text/css">
    </head>

    <body>
        <main>
            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-Login">
                        <h3>¿Ya tienes cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button id="btn__iniciar-sesion">Iniciar sesión</button>
                    </div>
                    <div class="caja__trasera-Register">
                        <h3>¿Algunos cambios más?</h3>
                        <p>iniciar sesión con permiso autorisado</p>
                        <a href="../index.html">
                        <button>Inicio</button>
                    </a>
                    </div>
                </div>
                <div class="contenedor__login-register">
                    <form action="login.php" method="POST" class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <input type="text" placeholder="Correo Electronico" name="correo2">
                        <input type="password" placeholder="Contraseña" name="contrasena2">
                        <button>Entrar</button>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>