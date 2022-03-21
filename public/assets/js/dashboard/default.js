// greeting
var today = new Date();
var curHr = today.getHours();

if (curHr >= 0 && curHr < 4) {
    document.getElementById("greeting").innerHTML = "Selamat Malam";
} else if (curHr >= 4 && curHr < 12) {
    document.getElementById("greeting").innerHTML = "Selamat Pagi";
} else if (curHr >= 12 && curHr < 16) {
    document.getElementById("greeting").innerHTML = "Selamat Siang";
} else {
    document.getElementById("greeting").innerHTML = "Selamat Sore";
}
// time
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    // var s = today.getSeconds();
    var ampm = h >= 12 ? "PM" : "AM";
    h = h % 12;
    h = h ? h : 12;
    m = checkTime(m);
    // s = checkTime(s);
    document.getElementById("txt").innerHTML = h + ":" + m + " " + ampm;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    } // add zero in front of numbers < 10
    return i;
}
