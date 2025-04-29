function decompte(duree){
    duree = duree*1000;
    var start = Date.now();
    var chrono = document.getElementById('chrono');
    var timer = setInterval(function(){
        var ecart = (Date.now() - start);
        var temps = duree - ecart
        temps = temps / 1000;
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
        chrono.innerHTML="O"+temps;
        if (temps < 0) {
            clearInterval(timer);
        }
    }, 10);
}