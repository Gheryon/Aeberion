<?php header('Location: ../Aeberion/vista/index.php'); ?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css"/>

    <title>Aeberion</title>
  </head>
  <body>
    <header>
      <h1 class="fw-bolder">Biblia de Aeberion</h1>
    </header>
    <!--<nav class="navigation">
      <div>Países</div>
      <div>Lugares</div>
      <div>Personas</div>
      <div>Cronologías</div>
      <div>Calendario</div>
      <div>Notas</div>
      <div>Enlaces</div>
    </nav>-->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark less-padding">
      <div class="container-fluid less-padding">
        <!--<a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>-->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Organizaciones políticas</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="#">Países</a></li>
                  <li><a class="dropdown-item" href="#">Cantones</a></li>
                  <li><a class="dropdown-item" href="#">Órdenes militares</a></li>
                  <li><a class="dropdown-item" href="nuevaOrganizacion.php">Nuevo</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Religiones</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="religiones.php">Hijos de los Dioses</a></li>
                  <li><a class="dropdown-item" href="#">Hijos del Profeta</a></li>
                  <li><a class="dropdown-item" href="#">Nómadas</a></li>
                </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Lugares</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Especies
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Elfos</a></li>
                <li><a class="dropdown-item" href="#">Enanos</a></li>
                <li><a class="dropdown-item" href="#">Humanos</a></li>
                <li><a class="dropdown-item" href="#">Semielfos</a></li>
                <li><a class="dropdown-item" href="#">Gnomos</a></li>
                <li><a class="dropdown-item" href="#">Dragones</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Personajes
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="personajes.php">Tabla de personajes</a></li>
                <li><a class="dropdown-item" href="createPersonaje.php">Añadir personaje</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/Aeberion/timelines.php">Cronologías</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Calendario</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Notas
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="notasNombres.html">Lista de nombres</a></li>
                <li><a class="dropdown-item" href="#">Apuntes</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/Aeberion/enlaces.php">Enlaces</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      Select image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload Image" name="submit">
    </form>
    <img src="/Aeberion/imagenes/Aeberion.jpeg" class="img-fluid" alt="Aeberion.jpeg">
    <!--<div class="navbar">
      <a href="#home">Home</a>
      <a href="#news">News</a>
      <div class="dropdown">
        <button class="dropbtn">Dropdown
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="#">Link 1</a>
          <a href="#">Link 2</a>
          <a href="#">Link 3</a>
        </div>
      </div>
    </div> -->
    <div class="row">
      <aside>
        <h2>Aside</h2>
      </aside>
      <section>
        <h2>Section</h2>
      </section>
    </div>
    <footer>
      <h2>Footer</h2>
    </footer>
    <!--JavaScript: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
