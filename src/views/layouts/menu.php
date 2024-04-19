  <!-- Menu -->

  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="<?= APP_URL . $this->Route('home') ?>" class="app-brand-link">
        <span class="app-brand-logo demo">
          <img src="<?= APP_URL ?>assets/img/illustrations/logoUptaeb.png" height="60" alt="View uptaeb">

        </span>
        <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform: uppercase;">PNFI</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

      <!-- Dashboard -->
      <li class="menu-item <?= $this->currentPath() == 'home' ? 'active' : '' ?>">
        <a href="<?= APP_URL . $this->Route('home') ?>" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Inicio</div>
        </a>
      </li>
      <?php if ($_SESSION['rol_id'] <= 1) : ?>

        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Personas</span>
        </li>
        <li class="menu-item <?= $this->currentPath() == 'profesores' ? 'active' : '' ?>">
          <a href="<?= APP_URL .  $this->Route('profesores') ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-group"></i>
            <div data-i18n="Analytics">Docentes</div>
          </a>
        </li>
        <li class="menu-item <?= $this->currentPath() == 'estudiantes' ? 'active' : '' ?>">
          <a href="<?= APP_URL .  $this->Route('estudiantes') ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-face"></i>
            <div data-i18n="Analytics">Estudiantes</div>
          </a>
        </li>


        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Organización Docente</span>
        </li>
        <li class="menu-item <?= $this->currentPath() == 'seccion' ? 'active' : '' ?>">
          <a href="<?= APP_URL .  $this->Route('seccion') ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-grid"></i>
            <div data-i18n="Analytics">Secciones</div>
          </a>
        </li>
        <li class="menu-item <?= in_array('materias', $this->fullPath()) ? 'open' : '' ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book"></i>
            <div data-i18n="Authentications">Unidades Curriculares</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?= in_array('materias', $this->fullPath()) && in_array('TR1', $this->fullPath()) ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('materias/TR1') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto I</div>
              </a>
            </li>
            <li class="menu-item <?= in_array('materias', $this->fullPath()) && in_array('TR2', $this->fullPath()) ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('materias/TR2') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto II</div>
              </a>
            </li>
            <li class="menu-item <?= in_array('materias', $this->fullPath()) && in_array('TR3', $this->fullPath()) ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('materias/TR3') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto III</div>
              </a>
            </li>
            <li class="menu-item <?= in_array('materias', $this->fullPath()) && in_array('TR4', $this->fullPath()) ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('materias/TR4') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto IV</div>
              </a>
            </li>

          </ul>
        </li>

        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Consejo Comunal</span>
        </li>
        <li class="menu-item <?= $this->currentPath() == 'consejoComunal' ? 'active' : '' ?>">
          <a href="<?= APP_URL .  $this->Route('consejoComunal') ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-group"></i>
            <div data-i18n="Analytics">Consejo Comunal</div>
          </a>
        </li>
        <li class="menu-item <?= $this->currentPath() == 'sector' ? 'active' : '' ?>">
          <a href="<?= APP_URL .  $this->Route('sector') ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-map-pin"></i>
            <div data-i18n="Analytics">Sector</div>
          </a>
        </li>

        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Baremos</span>
        </li>
        <li class="menu-item <?= in_array($this->currentPath(), ['baremos', 'dimensiones', 'indicadores']) ? 'open' : '' ?>">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-poll"></i>
            <div data-i18n="Analytics">Baremos</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?= $this->currentLastPath() == 'TR1' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('baremos/TR1') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto I</div>
              </a>
            </li>
            <li class="menu-item <?= $this->currentLastPath() == 'TR2' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('baremos/TR2') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto II</div>
              </a>
            </li>
            <li class="menu-item <?= $this->currentLastPath() == 'TR3' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('baremos/TR3') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto III</div>
              </a>
            </li>
            <li class="menu-item <?= $this->currentLastPath() == 'TR4' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('baremos/TR4') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto IV</div>
              </a>
            </li>

          </ul>
        </li>
        <li class="menu-item <?= $this->currentPath() == 'proyectos' ? 'active' : '' ?>">
          <a href="<?= APP_URL .  $this->Route('proyectos') ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-code"></i>
            <div data-i18n="Analytics">Proyectos</div>
          </a>
        </li>
        <li class="menu-item <?= $this->currentPath() == 'historico' ? 'active' : '' ?>">
          <a href="<?= APP_URL .  $this->Route('historico') ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-receipt"></i>
            <div data-i18n="Analytics">Historico</div>
          </a>
        </li>
        

        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Reportes</span>
        </li>
        <li class="menu-item <?= in_array('reportes', $this->fullPath()) ? 'open' : '' ?>">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-poll"></i>
            <div data-i18n="Analytics">Reportes</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?= $this->currentLastPath() == 'reportesn' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('reportesn') ?>" class="menu-link">
                <div data-i18n="Basic">Proyectos aprobados con filtro</div>
              </a>
            </li>
            <li class="menu-item <?= $this->currentLastPath() == 'reporte_aprobado' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('reporte-aprobado') ?>" class="menu-link">
                <div data-i18n="Basic">Proyectos aprobados general</div>
              </a>
            </li>
            <li class="menu-item <?= $this->currentLastPath() == 'reporte_municipio' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('reporte-municipio') ?>" class="menu-link">
                <div data-i18n="Basic">Proyectos por municipios</div>
              </a>
            </li>
            <!--<li class="menu-item <?= $this->currentLastPath() == 'notasu' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('notasu') ?>" class="menu-link">
                <div data-i18n="Basic">Notas Unidad Curricular</div>
              </a>
            </li-->


          </ul>
        </li>













        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Administración</span>
        </li>
        <!-- Layouts -->

        <li class="menu-item <?= in_array($this->currentPath(), ['bitacora', 'acciones',  'permisos', 'modulos']) ? 'open' : '' ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div data-i18n="Authentications">Seguridad</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?= $this->currentPath() == 'bitacora' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('bitacora') ?>" class="menu-link">
                <div data-i18n="Basic">Bitácora</div>
              </a>
              <li class="menu-item <?= $this->currentPath() == 'acciones' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('acciones') ?>" class="menu-link">
                <div data-i18n="Basic">Bitacora Acciones</div>
              </a>
            </li>
            </li>
            <li class="menu-item <?= $this->currentPath() == 'permisos' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('permisos') ?>" class="menu-link">
                <div data-i18n="Basic">Permisos</div>
              </a>
            </li>
          </ul>
        </li>
        <!-- MANTENIMIENTO -->
        <li class="menu-item <?= in_array($this->currentPath(), ['configuracion', 'respaldo']) ? 'open' : '' ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-data"></i>
            <div data-i18n="Layouts">Mantenimiento</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item <?= $this->currentPath() == 'respaldo' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('respaldo') ?>" class="menu-link">
                <div data-i18n="Without menu">Respaldo</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- CONFIGURACION DEL SISTEMA -->
        <li class="menu-item <?= in_array($this->currentPath(), ['configuracion', 'respaldo']) ? 'open' : '' ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-cog"></i>
            <div data-i18n="Layouts">Configuración</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item <?= $this->currentPath() == 'configuracion' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('configuracion/aperturar-periodo') ?>" class="menu-link">
                <div data-i18n="Without menu">Aperturar Lapso</div>
              </a>
            </li>
          </ul>
        </li>
        <!-- AYUDA -->
        <li class="menu-item <?= in_array($this->currentPath(), ['configuracion', 'respaldo']) ? 'open' : '' ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-help-circle"></i>
            <div data-i18n="Layouts">Ayuda</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item <?= $this->currentPath() == 'respaldo' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('respaldo') ?>" class="menu-link">
                <div data-i18n="Without menu">Manual de Usuario</div>
              </a>
            </li>

          




                <li class="menu-item <?= in_array($this->currentPath(), ['bitacora', 'permisos', 'modulos']) ? 'open' : '' ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div data-i18n="Authentications">Seguridad</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?= $this->currentPath() == 'bitacora' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('bitacora') ?>" class="menu-link">
                <div data-i18n="Basic">Bitacora</div>
              </a>
            </li>
            <li class="menu-item <?= $this->currentPath() == 'permisos' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('permisos') ?>" class="menu-link">
                <div data-i18n="Basic">Permisos</div>
              </a>
            </li>
            <li class="menu-item <?= $this->currentPath() == 'modulos' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('modulos') ?>" class="menu-link">
                <div data-i18n="Basic">Modulo</div>
              </a>
            </li>

          </ul>
        </li>





            <li class="menu-item <?= $this->currentPath() == 'respaldo' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('respaldo') ?>" class="menu-link">
                <div data-i18n="Without menu">Manual del Sistema</div>
              </a>
            </li>
          </ul>
        </li>
      <?php endif ?>
      <?php if ($_SESSION['rol_id'] == 2) : ?>
        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Organización Docente</span>
        </li>
        <li class="menu-item <?= $this->currentPath() == 'seccion' ? 'active' : '' ?>">
          <a href="<?= APP_URL .  $this->Route('seccion') ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-grid"></i>
            <div data-i18n="Analytics">Secciones</div>
          </a>
        </li>

        <li class="menu-item <?= in_array('materias', $this->fullPath()) ? 'open' : '' ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book"></i>
            <div data-i18n="Authentications">Unidades Curriculares</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?= in_array('materias', $this->fullPath()) && in_array('TR1', $this->fullPath()) ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('materias/TR1') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto I</div>
              </a>
            </li>
            <li class="menu-item <?= in_array('materias', $this->fullPath()) && in_array('TR2', $this->fullPath()) ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('materias/TR2') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto II</div>
              </a>
            </li>
            <li class="menu-item <?= in_array('materias', $this->fullPath()) && in_array('TR3', $this->fullPath()) ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('materias/TR3') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto III</div>
              </a>
            </li>
            <li class="menu-item <?= in_array('materias', $this->fullPath()) && in_array('TR4', $this->fullPath()) ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('materias/TR4') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto IV</div>
              </a>
            </li>

          </ul>
        </li>

        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Baremos</span>
        </li>
        <!-- <li class="menu-item <?= $this->currentPath() == 'dimensiones' ? 'active' : '' ?>">
        <a href="<?= APP_URL .  $this->Route('dimensiones') ?>" class="menu-link">
          <i class="menu-icon tf-icons bx bx-poll"></i>
          <div data-i18n="Analytics">Baremos</div>
        </a>
      </li> -->
        <li class="menu-item <?= in_array($this->currentPath(), ['baremos', 'dimensiones', 'indicadores']) ? 'open' : '' ?>">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-poll"></i>
            <div data-i18n="Analytics">Baremos</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?= $this->currentLastPath() == 'TR1' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('baremos/TR1') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto I</div>
              </a>
            </li>
            <li class="menu-item <?= $this->currentLastPath() == 'TR2' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('baremos/TR2') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto II</div>
              </a>
            </li>
            <li class="menu-item <?= $this->currentLastPath() == 'TR3' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('baremos/TR3') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto III</div>
              </a>
            </li>
            <li class="menu-item <?= $this->currentLastPath() == 'TR4' ? 'active' : '' ?>">
              <a href="<?= APP_URL . $this->Route('baremos/TR4') ?>" class="menu-link">
                <div data-i18n="Basic">Trayecto IV</div>
              </a>
            </li>

          </ul>
        </li>
        <li class="menu-item <?= $this->currentPath() == 'proyectos' ? 'active' : '' ?>">
          <a href="<?= APP_URL .  $this->Route('proyectos') ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-code"></i>
            <div data-i18n="Analytics">Proyectos</div>
          </a>
        </li>

      <?php endif ?>

    </ul>
  </aside>