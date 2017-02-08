# tracker
### Email : alinasiri1367@gmail.com
This is first my package repository

----------


**Installation**:

Run below statements on your terminal :

STEP 1 : 

    composer require "alinasiri/tracker":"dev-master"
    
STEP 2 : Add `provider` and `facade` in config/app.php

    'providers' => [
      ...
     \Tracker\TrackerServiceProvider::class, // <-- add this line at the end of provider array
    ],


    'aliases' => [
      ...
      'Tracker'=>\Tracker\facade\TrackerFacade::class, // <-- add this line at the end of aliases array
    ]

Step 3:  

    php artisan migrate

----------------------------------------
:)
