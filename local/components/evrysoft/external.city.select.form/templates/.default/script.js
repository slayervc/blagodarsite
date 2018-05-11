var Dialog = new BX.CDialog({
    title: "Выберите Ваш город",
    content: 	'<input type="text" id="city_name" autocomplete="off" placeholder="Название города" onkeyup="searchCity()">\
                <div id="cityList"></div>',

    resizable: false,
    height: '400',
    width: '400'});

function showDialog(){
    Dialog.Show();
}

function searchCity(){
    var cityName = document.getElementById("city_name").value;

    if (cityName.length < 3) {
        document.getElementById('cityList').innerHTML = '';
        return;
    }

    console.log('go');

    BX.ajax.post(window.location.origin + '/ajax.php', {"city_name": cityName}, function(data) {
        var cities = JSON.parse(data),
            region = '',
            list = '';

        for (var i=0; i<cities.length; i++){

            if (cities[i].REGION_NAME != region){
                region = cities[i].REGION_NAME;
                if (region) list += '</UL>';
                list += '<H5>' + region + '</H5><UL>';
            }

            url = window.location.search ? window.location.origin + window.location.pathname + window.location.search + '&set_city=' :
            window.location.origin + window.location.pathname + '?set_city=';
            list += '<LI><A href="' + url + cities[i].CITY_ID + '">' + cities[i].CITY_NAME + '</A></LI>';
        }

        if (list) list += '</UL>';
        document.getElementById('cityList').innerHTML = list;
    });
}