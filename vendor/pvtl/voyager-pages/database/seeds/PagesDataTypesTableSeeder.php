<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class PagesDataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'pages');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'pages',
                'display_name_singular' => 'Page',
                'display_name_plural'   => 'Pages',
                'icon'                  => 'voyager-file-text',
                'model_name'            => 'Pvtl\\VoyagerPages\\Page',
                'controller'            => '\\Pvtl\\VoyagerPages\\Http\\Controllers\\PageController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        if ($dataType->exists) {
            $dataType->update([
                'model_name' => 'Pvtl\\VoyagerPages\\Page',
                'controller' => '\\Pvtl\\VoyagerPages\\Http\\Controllers\\PageController',
            ]);
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
