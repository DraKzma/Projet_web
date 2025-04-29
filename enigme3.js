function decompte(duree){
    duree = duree*1000;
    var start = Date.now();
    var chrono = document.getElementById('chrono');
    var timer = setInterval(function(){
        var ecart = (Date.now() - start);
        var temps = duree - ecart
        temps = temps / 1000;
        if(temps >= 10){
            temps = temps.toPrecision(4);
        }
        else{
            if(temps >=1){
                temps = temps.toPrecision(3);
            }
            else{
                if(temps >= 0.1){
                    temps = temps.toPrecision(2);
                }
                else{
                    temps = temps.toPrecision(1);
                }
            }
        }
        if(temps < 10){
            chrono.innerHTML = "0"+temps;
        }
        else{
            chrono.innerHTML = temps;
        }
        if (temps < 0) {
            clearInterval(timer);
            chrono.innerHTML = "00.00";
        }
    }, 10);
 }