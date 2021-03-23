<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Test | 23 March 2021</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href='https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css' rel='stylesheet'>
        <style> 
                .stretch-card>.card {
                    width: 100%;
                    min-width: 100%
                }
                body {
                    background-color: #f9f9fa
                }
                .flex {
                    -webkit-box-flex: 1;
                    -ms-flex: 1 1 auto;
                    flex: 1 1 auto
                }
                @media (max-width:991.98px) {
                    .padding {
                        padding: 1.5rem
                    }
                }
                @media (max-width:767.98px) {
                    .padding {
                        padding: 1rem
                    }
                }
                .padding {
                    padding: 5rem
                }
                .grid-margin,
                .purchace-popup>div {
                    margin-bottom: 25px
                }
                .card {
                    border: 0;
                    border-radius: 2px
                }
                .card-weather {
                    background: #e1ecff;
                    background-image: linear-gradient(to left bottom, #d6eef6, #dff0fa, #e7f3fc, #eff6fe, #f6f9ff)
                }
                .card {
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    min-width: 0;
                    word-wrap: break-word;
                    background-color: #fff;
                    background-clip: border-box;
                    border: 1px solid rgba(0, 0, 0, 0.125);
                    border-radius: 0.25rem
                }
                .card-weather .card-body:first-child {
                    background: url(https://res.cloudinary.com/dxfq3iotg/image/upload/v1557323760/weather.svg) no-repeat center;
                    background-size: cover
                }
                .card .card-body {
                    padding: 1.88rem 1.81rem
                }
                .card-body {
                    flex: 1 1 auto;
                    padding: 1.25rem
                }
                .card-weather .weather-date-location {
                    padding: 0 0 38px
                }
                .h3,
                h3 {
                    font-size: 1.56rem
                }
                .h1,
                .h2,
                .h3,
                .h4,
                .h5,
                .h6,
                h1,
                h2,
                h3,
                h4,
                h5,
                h6 {
                    font-family: "Poppins", sans-serif;
                    font-weight: 500
                }
                .text-gray,
                .card-subtitle,
                .new-accounts ul.chats li.chat-persons a p.joined-date {
                    color: #969696
                }
                p {
                    font-size: 13px
                }
                .text-gray,
                .card-subtitle,
                .new-accounts ul.chats li.chat-persons a p.joined-date {
                    color: #969696
                }
                .card-weather .weather-data {
                    padding: 0 0 4.75rem
                }
                .mr-auto,
                .mx-auto {
                    margin-right: auto !important
                }
                .display-3 {
                    font-size: 2.5rem
                }
                .card-weather .card-body {
                    background: #ffffff
                }
                .card-weather .weakly-weather {
                    background: #ffffff;
                    overflow-x: auto
                }
                .card-weather .weakly-weather .weakly-weather-item {
                    flex: 0 0 14.28%;
                    border-right: 1px solid #f2f2f2;
                    padding: 1rem;
                    text-align: center
                }
                .mb-0,
                .my-0 {
                    margin-bottom: 0 !important
                }
                .card-weather .weakly-weather .weakly-weather-item i {
                    font-size: 1.2rem
                }
            </style>
    </head>
    <body class='snippet-body'>
        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row container d-flex justify-content-center">
                    <div class="col-lg-8 grid-margin stretch-card">
                        <!--weather card-->
                        <div class="card card-weather">
                            <div class="card-body" id="current_weather">
                                
                            </div>
                            <div class="card-body p-0">
                                <div class="d-flex weakly-weather" id="week_weather">
                                    
                                </div>
                            </div>
                        </div>
                        <!--weather card ends-->
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'>
        
        document.getElementById('week_weather').innerHTML = 'loading...';
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        fetch('http://api.openweathermap.org/data/2.5/onecall?lat=26.9124&lon=75.7873&units=metric&appid=e9c64818f9551211310596b72a2e389c&exclude=hourly,minutely,alerts')
        .then(res=>res.json())
        .then(finalres=>{

            if(finalres.current){
                let curretDate = new Date(finalres.current.dt).toUTCString();
                let d = new Date(finalres.current.dt*1000);
                let dayName = days[d.getDay()];
                var currentWeather = `<div class="weather-date-location">
                                    <h3>`+dayName+`</h3>
                                    <p class="text-gray"> <span class="weather-date">`+curretDate+`</span> <span class="weather-location">`+finalres.timezone+`</span> </p>
                                </div>
                                <div class="weather-data d-flex">
                                    <div class="mr-auto">
                                        <h4 class="display-3">`+finalres.current.temp+` <span class="symbol">°</span>C</h4>
                                        <p> `+finalres.current.weather[0].main+` </p>
                                    </div>
                                </div>`;

                document.getElementById('current_weather').innerHTML = currentWeather;
            }

            var weatherData = '';
            if(finalres.daily){
                for(let i=0;i<finalres.daily.length-1;i++){
                    let d = new Date(finalres.daily[i].dt*1000);
                    let dayName = days[d.getDay()];
                    weatherData += `<div class="weakly-weather-item">
                                        <p class="mb-1"> `+dayName+` </p> <img src="http://openweathermap.org/img/w/`+finalres.daily[i].weather[0].icon+`.png" width="32" height="32" alt="`+dayName+`">
                                        <p class="mb-0"> `+finalres.daily[i].temp.min+`° - `+finalres.daily[i].temp.max+`° </p>
                                    </div>` 
                }
                document.getElementById('week_weather').innerHTML = weatherData;
            }

        });
    </script>
</html>