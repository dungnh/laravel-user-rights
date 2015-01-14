<?php $current = Route::currentRouteName() ?>
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">

        </div>
        <div class="pull-left info">
            <p><?php echo trans('messages.welcome_name', array('name' => Auth::admin()->get()->first_name . ' ' . Auth::admin()->get()->last_name)); ?></p>
        </div>
    </div>
    <ul class="sidebar-menu">
        <li class="active">
            <a href="<?php echo route('admin.root') ?>">
                <i class="fa fa-dashboard"></i> <span><?php echo trans('messages.dashboard'); ?></span>
            </a>
        </li>
        <?php if (in_array('admin.users.index', $allowed_routes) || in_array('admin.groups.index', $allowed_routes) || in_array('admin.groups.create', $allowed_routes) || in_array('admin.users.create', $allowed_routes)): ?>
            <li class="treeview <?php echo in_array($current, ['admin.users.index', 'admin.groups.index', 'admin.users.create', 'admin.users.edit']) ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span><?php echo trans('messages.manage_users'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (in_array('admin.users.index', $allowed_routes)): ?>
                        <li class="<?php echo $current == 'admin.users.index' ? 'active' : '' ?>">
                            <a href="{{route('admin.users.index')}}"><?php echo trans('messages.list_user'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array('admin.users.create', $allowed_routes)): ?>
                        <li class="<?php echo $current == 'admin.users.create' ? 'active' : '' ?>">
                            <a href="{{route('admin.users.create')}}"><?php echo trans('messages.create_user'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array('admin.groups.index', $allowed_routes)): ?>
                        <li class="<?php echo $current == 'admin.groups.index' ? 'active' : '' ?>">
                            <a href="{{route('admin.groups.index')}}"><?php echo trans('messages.list_group'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array('admin.groups.create', $allowed_routes)): ?>
                        <li class="<?php echo $current == 'admin.groups.create' ? 'active' : '' ?>">
                            <a href="{{route('admin.groups.create')}}"><?php echo trans('messages.create_group'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if (in_array('admin.language.translation', $allowed_routes)): ?>
            <li class="treeview <?php echo strpos($current, 'language') !== false ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-bell"></i>
                    <span><?php echo trans('messages.settings'); ?></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo $current == 'admin.language.index' ? 'active' : '' ?>">
                        <a href="<?php echo route('admin.language.index') ?>"><?php echo trans('messages.languages'); ?></a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</section>