# tracker
### Email : alinasiri1367@gmail.com
This is first my package repository

----------


**Installation**:

Run below statements on your terminal :

STEP 1 : 

    composer require "alinasiri/tracker":"1.1.0"
    
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

# Usage

###Put the following code to run count

```
{{ Tracker::count() }}
```

###Concepts

####Applied methods

```
onlineVisitors(60) // show online visitors in 60 seconds ago

visits('all') //Total Views- Other parameters : today,yesterday,default=all

visitors('all') //Number of visitors- Other parameters : today,yesterday,default=all

subDayVisits($day) //The number of hits in $day days -integer

subDayVisitors($day)

```
