<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    //MATERI FILE STORAGE - Konfigurasi File Storage
    'default' => env('FILESYSTEM_DISK', 'local'), //defaultnya kita ambil dari evironment variables, kalo tidak ada maka default-nya 'local'

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    //MATERI FILE STORAGE - File System
    'disks' => [

        'local' => [ //ini untuk konfigurasi evironment yg local (kalo upload ke File Storage local)
            'driver' => 'local',
            'root' => storage_path('app'), //storage_path() itu maksudnya path keberadaan folder storage
            'throw' => false, //ditambah dengan app maka path-nya menuju storage/app
        ],

        'public' => [ //ini kalo upload ke File Storage public
            'driver' => 'local', 
            'root' => storage_path('app/public'), //berdasarkan aturan storage_path() sama seperti di atas, maka path-nya menuju storage/app/public 
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [ //ini untuk Amazon S3
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    //MATERI FILE STORAGE - Storage Link
    'links' => [ //ini untuk konfigurasi symbolic links, jadi public_path() itu maksudnya path folder public
        public_path('storage') => storage_path('app/public'), //di folder public akan membuat symbolic link bernama "storage" dan akan masuk ke app/public
        //pas pakai php artisan storage:link, maka fie yg dari storage/app/public akan dibuatkan link-nya di public/storage
        //kita bisa bikin lebih dari 1 symbolic link sekaligus karena bentuk dari key "links" adalah array
    ],

];
