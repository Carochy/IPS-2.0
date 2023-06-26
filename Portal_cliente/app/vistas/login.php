<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
  <div class="container">
    <h2>Iniciar sesión</h2>
    <form method="post" action="index.php">
      <div class="form-group">
        <label for="username">Usuario</label>
        <input type="text" id="username" name="username" placeholder="Ingresa tu usuario" required >
      </div>

      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required autocomplete="off">
      </div>
      <!-- <input type="submit" class="btn" name="btnIngresar" Value = "Iniciar sesión"> -->
      <button type="submit" name="btnIngresar">Iniciar sesión</button> 
    </form>
  </div>
</body>
</html>
