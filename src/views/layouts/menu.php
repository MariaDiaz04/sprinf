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

      <?= $this->menuByRol($_SESSION['rol_id']) ?>

    </ul>
  </aside>