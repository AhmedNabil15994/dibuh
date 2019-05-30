<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Third Party Services
      |--------------------------------------------------------------------------
      |T his file is for main configuration for language system
      | 
      |
     */

    'available_locales' => [
        'ar'  => ['name' => 'Arabic','native_name' => 'العربية', 'dir' => 'rtl', 'txt_dir' => 'right', 'flag' => 'ar.png', 'regional' => 'ar_AE','is_active' => true, 'is_default' => true],
        'en' => ['name' => 'English','native_name' => 'English', 'dir' => 'ltr', 'txt_dir' => 'left', 'flag' => 'en.png', 'regional' => 'en_GB', 'is_active' => true, 'is_default' => false],
        'fr'   => ['name' => 'French','native_name' => 'français', 'dir' => 'ltr', 'txt_dir' => 'left', 'flag' => 'fr.png', 'regional' => 'fr_FR', 'is_active' => true, 'is_default' => false],
        'de'   => ['name' => 'German','native_name' => 'Deusch', 'dir' => 'ltr', 'txt_dir' => 'left', 'flag' => 'de.png', 'regional' => 'de_DE', 'is_active' => true, 'is_default' => false],        
    ],
    'default_locale' => 'ar',
];
