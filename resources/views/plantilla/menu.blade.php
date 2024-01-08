<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
           TURISMO
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('departamento')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Departamentos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('empleado')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Empleados</p>
            </a>
          </li>
      
        </ul>
      </li>
     
         
    </ul>
  </nav>