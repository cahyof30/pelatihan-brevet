<!-- Sidebar -->
<ul class="navbar-nav bg-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <!-- <i class="fa-solid fa-file-invoice-dollar"></i> -->
            <img src="<?= base_url('assets/images/logo.png') ?>" class="img-top-logo" alt="">
            <style>
                .img-top-logo {
                    width: 85%;
                }

                .bg-sidebar {
                    background-image: linear-gradient(75deg, #EF3C6A, #E71F41);
                }
            </style>
        </div>
        <div class="sidebar-brand-text mx-3">Master<br>Accounting</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- QUERY MENU -->
    <!-- Tampilkan menu untuk admin dan member -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`, `menu`
                    FROM `user_menu` JOIN `user_access_menu`
                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC
                    ";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>


    <!-- LOOPING MENU -->

    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        <!-- Siapkan Sub-Menu sesuai menu -->
        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT *
                         FROM `user_sub_menu` JOIN `user_menu`
                         ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                         WHERE `user_sub_menu`.`menu_id` = $menuId
                         AND `user_sub_menu`.`is_active` = 1";

        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php foreach ($subMenu as $sm) : ?>
            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
            <?php endforeach; ?>

            <!-- Divider -->
            <hr class="sidebar-divider mt-3">

        <?php endforeach; ?>


        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                <i class="fa-solid fa-user-times"></i>
                <span>Logout</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
</ul>