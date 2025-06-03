<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combined Shape</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .shape-container {
            position: relative;
            height: 120px;
            width: 300px;
            margin: 40px;
        }
        
        .circle {
            width: 90px;
            height: 90px;
            background-color: #333333;
            border-radius: 50%;
            position: absolute;
            left: 0;
            z-index: 2;
            border: 5px solid #EE8D4A;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 8px 5px;
            box-sizing: border-box;
        }
        
        .circle-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }
        
        .circle img {
            height: 32px;
            width: auto;
            margin-bottom: 3px;
        }
        
        .circle-text {
            color: white;
            text-align: center;
            line-height: 1.1;
            font-size: 9px;
            font-family: Arial, sans-serif;
            width: 100%;
        }
        
        .number {
            font-weight: bold;
            font-size: 11px;
            margin-top: 2px;
        }
        
        .participants-text {
            font-size: 8px;
            margin-top: 1px;
        }
        
        .rectangle { 
            width: 400px;
            height: 80px;
            background-color: #333333;
            border-radius: 21.08px;
            position: absolute;
            left: 20px;
            top: 8px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-left: 75px;
            padding-right: 15px;
            box-sizing: border-box;
            color: white;
            font-family: Arial, sans-serif;
        }
        
        .rectangle .row {
            width: 100%;
            margin: 0;
        }
        
        .rectangle .col {
            padding: 0 5px;
        }
        
        .rectangle p {
            margin: 0;
            font-size: 12px;
            line-height: 1.3;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .rectangle p:first-child {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 3px;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="shape-container">
        <div class="circle">
            <div class="circle-content">
                <img src="{{ asset('assets/participant_logo.png') }}" alt="Logo">
                <div class="circle-text number">1,350</div>
                <div class="circle-text participants-text">participants</div>
            </div>
        </div>
        <div class="rectangle">
            <div class="row align-items-start">
                <div class="col">
                    <p>Flavor & Favor</p>
                    <p>by Chef Renatta Moelock</p>
                </div>
                <div class="col">
                    <p>Yogyakarta</p>
                    <p>April 2025</p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>