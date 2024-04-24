<div>
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
    <span class="menu-header-text">Gestion Proyecto</span>
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
    </ul>
  </li>

</div>