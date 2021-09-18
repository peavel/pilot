<?php

use Illuminate\Database\Seeder;
use PEAVEL\Pilot\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => __('pilot::seeders.data_types.user.singular'),
                'display_name_plural'   => __('pilot::seeders.data_types.user.plural'),
                'icon'                  => 'pilot-person',
                'model_name'            => 'PEAVEL\\Pilot\\Models\\User',
                'policy_name'           => 'PEAVEL\\Pilot\\Policies\\UserPolicy',
                'controller'            => 'PEAVEL\\Pilot\\Http\\Controllers\\PilotUserController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => __('pilot::seeders.data_types.menu.singular'),
                'display_name_plural'   => __('pilot::seeders.data_types.menu.plural'),
                'icon'                  => 'pilot-list',
                'model_name'            => 'PEAVEL\\Pilot\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => __('pilot::seeders.data_types.role.singular'),
                'display_name_plural'   => __('pilot::seeders.data_types.role.plural'),
                'icon'                  => 'pilot-lock',
                'model_name'            => 'PEAVEL\\Pilot\\Models\\Role',
                'controller'            => 'PEAVEL\\Pilot\\Http\\Controllers\\PilotRoleController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
