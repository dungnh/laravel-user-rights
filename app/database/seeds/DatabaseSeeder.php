<?php

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        $this->call('AdminUserSeed');
    }


}


class AdminUserSeed extends Seeder {
    public function run() {
        DB::table('admin_users')->truncate();
        DB::table('admin_groups')->truncate();
        DB::table('admin_user_groups')->truncate();
        $group = new AdminGroup(['name' => 'Administrator']);
        $group->description = '';
        $group->permissions = '';
        $group->save();
        $admin = new AdminUser(array(
            'email' => 'admin@admin.com',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'password' => '123456',
            'is_supper' => true,
        ));
        $admin->save();
        $my = new AdminUser(array(
            'email' => 'jonh@gmail.com',
            'first_name' => 'Danien',
            'last_name' => 'Jonh Deep',
            'password' => '123456'
        ));
        $my->save();
        $admin->groups()->attach($group->id);
    }


}


class ResourceSeeder extends Seeder {
    public function run() {
        //resource parten
        $resources = [
            'manage_article' => [
                'create_article' => ['admin.articles.create', 'admin.article.store'],
                'edit_article' => ['admin.articles.edit', 'admin.articles.update']
            ]
        ];
    }


}

