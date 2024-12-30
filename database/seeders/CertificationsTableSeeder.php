<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CertificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('certifications')->delete();
        
        \DB::table('certifications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'GST 101',
                'description' => 'General Studies. Use of English 1',
                'is_active' => 1,
                'details' => 'General Studies. Use of English 1',
                'user_id' => 1,
                'section_id' => 1,
                'created_at' => '2023-06-04 06:31:39',
                'updated_at' => '2023-06-04 06:31:39',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'GST 109',
                'description' => 'General Studies. Basic Igbo Studies 1',
                'is_active' => 1,
                'details' => 'General Studies. Basic Igbo Studies 1',
                'user_id' => 1,
                'section_id' => 1,
                'created_at' => '2023-06-04 06:32:22',
                'updated_at' => '2023-06-04 06:32:22',
            ),
        ));
        
        
    }
}