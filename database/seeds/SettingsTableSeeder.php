<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'key'           => 'website_title',
            'name'          => 'WebsiteTitle',
            'description'   => 'WebsiteTitle',
            'value'         => 'My WebSite Title/Name',
            'field'         => '{"name":"value","label":"Value", "title":"Motto value" ,"type":"text"}',
            'is_active'        => 1,

        ]);   
        
        DB::table('settings')->insert([
            'key'           => 'contact_email',
            'name'          => 'Contact form email address',
            'description'   => 'The email address that all emails from the contact form will go to.',
            'value'         => 'admin@updivision.com',
            'field'         => '{"name":"value","label":"Value", "title":"Contact CC" ,"type":"text"}',
            'is_active'        => 1,
        ]);

        DB::table('settings')->insert([
            'key'           => 'contact_cc',
            'name'          => 'Contact form CC field',
            'description'   => 'Email adresses separated by comma, to be included as CC in the email sent by the contact form.',
            'value'         => '',
            'field'         => '{"name":"value","label":"Value", "title":"Contact CC" ,"type":"text"}',
            'is_active'        => 1,

        ]);

        DB::table('settings')->insert([
            'key'           => 'contact_bcc',
            'name'          => 'Contact form BCC field',
            'description'   => 'Email adresses separated by comma, to be included as BCC in the email sent by the contact form.',
            'value'         => '',
            'field'         => '{"name":"value","label":"Value","type":"email"}',
            'is_active'        => 1,

        ]);

        DB::table('settings')->insert([
            'key'           => 'motto',
            'name'          => 'Motto',
            'description'   => 'Website motto',
            'value'         => 'this is the value',
            'field'         => '{"name":"value","label":"Value", "title":"Motto value" ,"type":"textarea"}',
            'is_active'        => 1,

        ]);
        
        DB::table('settings')->insert([
            'key'           => 'backend_theme',
            'name'          => 'Backend Theme',
            'description'   => 'Backend Theme',
            'value'         => 'default',
            'field'         => '{"name":"value","label":"Value", "title":"Backend Theme" ,"type":"text"}',
            'is_active'        => 1,
        ]);       
        
        DB::table('settings')->insert([
            'key'           => 'frontend_theme',
            'name'          => 'Frontend Them',
            'description'   => 'Frontend Them',
            'value'         => 'default',
            'field'         => '{"name":"value","label":"Value", "title":"frontend theme " ,"type":"text"}',
            'is_active'        => 1,
        ]);        
        
        DB::table('settings')->insert([
            'key'           => 'backend_route',
            'name'          => 'Backend Route',
            'description'   => 'Backend Route',
            'value'         => 'cpanel',
            'field'         => '{"name":"value","label":"Value", "title":"Route " ,"type":"text"}',
            'is_active'        => 1,
        ]);          
        
     
    }
}
