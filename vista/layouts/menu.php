<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../index.php" class="brand-link">
    <h2 class="brand-text text-center font-weight-light">Aeberion</h2>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa-solid fa-building-columns"></i>
            <p>Instituciones<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="paises.php?tipo_institucion=paises" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Países</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="paises.php?tipo_institucion=cantones" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Cantones</p>
              </a>
            </li>
            <li class="nav-item">
                <a href="paises.php?tipo_institucion=orden_militar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Órdenes militares</p>
                </a>
            </li>
            <li class="nav-item">
              <a href="paises.php?tipo_institucion=orden_magica" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Órdenes mágicas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="createInstitucion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nuevo</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-place-of-worship"></i>
            <p>Religiones<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="createReligion.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nueva religión</p>
              </a>
            </li>
            <div class="div" id="menu_religiones"></div>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa-solid fa-people-group"></i>
            <p>Personajes<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="personajes.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Personajes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="createPersonaje.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nuevo personaje</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa-solid fa-dna"></i>
            <p>Especies<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="createEspecie.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Nueva especie</p>
            </a>
          </li>
          <div class="div" id="menu_especies"></div>
          </ul>
        </li>
        <li class="nav-item">
          <a href="asentamientos.php" class="nav-link">
            <i class="nav-icon fa-solid fa-landmark"></i>
            <p>
              Asentamientos
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="lugares.php" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
            <p>
              Lugares
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="conflictos.php" class="nav-link">
            <!--<i class="nav-icon fa-solid fa-swords"></i>--
            <i class="nav-icon fa-sharp fa-solid fa-swords"></i>-->
            <i class="nav-icon fa-solid fa-shield-halved"></i>
            <p>
              Guerras y batallas
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="cronicas.php" class="nav-link">
            <i class="nav-icon fa-solid fa-book-open"></i>
            <p>
              Crónicas
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
              Calendario
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="timelines.php" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Cronologías
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="timeline.php" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Cronologías updated
            </p>
          </a>
        </li>
        <li class="nav-header">OTROS</li>
        <li class="nav-item">
          <a href="articulos.php" class="nav-link">
            <i class="nav-icon fa-solid fa-pencil"></i>
            <p>
              Apuntes
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="notasNombres.php" class="nav-link">
            <i class="nav-icon fa-solid fa-pencil"></i>
            <p>
              Lista de nombres
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="enlaces.php" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>Enlaces</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>