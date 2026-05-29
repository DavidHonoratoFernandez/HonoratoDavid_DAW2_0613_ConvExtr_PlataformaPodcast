<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Plataforma de Podcast</title>
</head>
<body>
    <h2>Crear Cuenta</h2>
    
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form action="index.php?controller=Auth&action=register" method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Registrarse</button>
    </form>
    
    <p>¿Ya tienes cuenta? <a href="index.php?controller=Auth&action=login">Inicia sesión</a></p>
</body>
</html>