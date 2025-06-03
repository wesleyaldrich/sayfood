<?php
$events = [
    [
        'title' => 'Flavor & Favor',
        'host' => 'by Chef Renatta Moeloek',
        'location' => 'Yogyakarta',
        'date' => 'April 2025',
        'participants' => '1,350',
        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
        'badge' => 'Popular'
    ],
    [
        'title' => 'Flavor & Favor',
        'host' => 'by Chef Renatta Moeloek',
        'location' => 'Yogyakarta',
        'date' => 'April 2025',
        'participants' => '2,480',
        'image' => 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
        'badge' => 'Trending'
    ],
    [
        'title' => 'Flavor & Favor',
        'host' => 'by Chef Renatta Moeloek',
        'location' => 'Yogyakarta',
        'date' => 'April 2025',
        'participants' => '980',
        'image' => 'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
        'badge' => 'New'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flavor & Favor Events</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            padding: 2rem;
        }
        
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .event-card {
            width: 100%;
            max-width: 320px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: white;
            position: relative;
        }
        
        .image-container {
            position: relative;
            height: 240px;
        }
        
        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .image-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            color: white;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
        }

        .shape-container {
            position: relative;
            height: 90px;
            width: 100%;
            margin-top: 10px;
        }
        
        .circle {
            width: 70px;
            height: 70px;
            background-color: #333333;
            border-radius: 50%;
            position: absolute;
            left: 0;
            bottom: 0;
            z-index: 2;
            border: 4px solid #EE8D4A;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
        }
        
        .circle-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
        
        .circle img {
            height: 22px;
            width: auto;
            margin-bottom: 2px;
        }
        
        .circle-text {
            color: white;
            text-align: center;
            line-height: 1.1;
            font-size: 8px;
            font-family: Arial, sans-serif;
            width: 100%;
        }
        
        .number {
            font-weight: bold;
            font-size: 10px;
            margin-top: 1px;
        }
        
        .participants-text {
            font-size: 7px;
        }
        
        .rectangle { 
            width: calc(100% - 30px);
            height: 60px;
            background-color: #333333;
            border-radius: 15px;
            position: absolute;
            left: 35px;
            bottom: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-left: 45px;
            padding-right: 10px;
            box-sizing: border-box;
            color: white;
            font-family: Arial, sans-serif;
        }
        
        .rectangle .row {
            width: 100%;
            margin: 0;
            display: flex;
            justify-content: space-between;
        }
        
        .rectangle .col {
            padding: 0 3px;
            flex: 1;
            min-width: 0;
        }
        
        .rectangle p {
            margin: 0;
            font-size: 11px;
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: flex;
            align-items: center;
        }
        
        .rectangle p:first-child {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 2px;
        }
        
        .icon {
            margin-right: 5px;
            font-size: 10px;
            width: 12px;
            text-align: center;
        }
        
        /* Badge styles */
        .event-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #EE8D4A;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            z-index: 2;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .badge-popular {
            background-color: #EE8D4A;
        }
        
        .badge-trending {
            background-color: #4A8DEE;
        }
        
        .badge-new {
            background-color: #4AEE8D;
        }
    </style>
</head>
<body>
    <div class="cards-container">
        <?php foreach ($events as $event): ?>
        <div class="event-card">
            <?php if (isset($event['badge'])): ?>
                <div class="event-badge badge-<?php echo strtolower($event['badge']); ?>">
                    <?= $event['badge'] ?>
                </div>
            <?php endif; ?>
            <div class="image-container">
                <img src="<?= $event['image'] ?>" alt="<?= $event['title'] ?>" class="event-image">
                <div class="image-content">
                     <div class="shape-container">
                        <div class="circle">
                            <div class="circle-content">
                                <img src="{{ asset('assets/participant_logo.png') }}" alt="Logo">
                                <div class="circle-text number"><?= $event['participants'] ?></div>
                                <div class="circle-text participants-text">participants</div>
                            </div>
                        </div>
                        <div class="rectangle">
                            <div class="row">
                                <div class="col">
                                    <p><?= $event['title'] ?></p>
                                    <p><?= $event['host'] ?></p>
                                </div>
                                <div class="col">
                                    <p><i class="fas fa-map-marker-alt icon"></i><?= $event['location'] ?></p>
                                    <p><i class="far fa-calendar-alt icon"></i><?= $event['date'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>