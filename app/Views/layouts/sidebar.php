<?php

$user = session()->get('user');
$roleId = $user['role_id'] ?? null;

$menus = \Config\Menu::getSidebar($roleId);
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="/dashboard" class="brand-link">
        <img src="<?= base_url('logo.png') ?>" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Pusat7</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <?php foreach ($menus as $menu): ?>

                    <?php if (isset($menu['children'])): ?>

                        <li class="nav-item has-treeview <?= ($navbar ?? '') == $menu['group'] ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon <?= $menu['icon'] ?>"></i>
                                <p>
                                    <?= $menu['title'] ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <?php foreach ($menu['children'] as $child): ?>
                                    <li class="nav-item">
                                        <a href="<?= $child['url'] ?>"
                                            class="nav-link <?= ($active ?? '') == $child['key'] ? 'active' : '' ?>">

                                            <i class="nav-icon <?= $child['icon'] ?? 'far fa-circle' ?>"></i>
                                            <p><?= $child['title'] ?></p>

                                        </a>
                                    </li>
                                <?php endforeach; ?>

                            </ul>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a href="<?= $menu['url'] ?>"
                                class="nav-link <?= ($active ?? '') == $menu['key'] ? 'active' : '' ?>">
                                <i class="nav-icon <?= $menu['icon'] ?>"></i>
                                <p><?= $menu['title'] ?></p>
                            </a>
                        </li>

                    <?php endif; ?>

                <?php endforeach; ?>

            </ul>
        </nav>
    </div>

</aside>