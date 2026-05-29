<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Plataforma de Podcast</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if(isset($_GET['success'])) echo "<p style='color:green;'>Registro completado. ¡Inicia sesión!</p>"; ?>

    <form action="index.php?controller=Auth&action=login" method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Entrar</button>
    </form>
    
    <p>¿No tienes cuenta? <a href="index.php?controller=Auth&action=register">Regístrate aquí</a></p>
</body>
</html>