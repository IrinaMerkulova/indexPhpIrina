function puhasta(){
    let w=document.getElementById("window").getContext("2d");
    w.clearRect(0, 0, 500, 500); //x, y, laius, kõrgus
}
//ring ja ringjoon
function ring(){
    let w=document.getElementById("window").getContext("2d");
    //ringjoon
    w.beginPath();
    w.strokeStyle="red";
    w.arc(50, 50, 20, 0, 2*Math.PI, true); // (x, y, R)
    w.stroke();

    //ring
    w.beginPath();
    w.fillStyle="red";
    w.arc(100, 50, 20, 0, 2*Math.PI, true); // (x, y, R)
    w.fill();
}
function joon(){
    let w=document.getElementById("window").getContext("2d");
    //joon
    w.beginPath();
    w.strokeStyle="red";
    w.fillStyle="black";
    w.lineWidth="3";
    w.moveTo(20,10); //alguspunkt
    w.lineTo(50, 50);
    w.lineTo(10, 50);
    w.lineTo(20,10);// lõpppunkt
    w.stroke(); // joonista!
    w.fill();
}
//ruut

function ruut(){
    let w=document.getElementById("window").getContext("2d");
    w.fillStyle="black";
    w.fillRect(20, 20, 40, 40); //x, y, laius, kõrgus
    w.fillText("Kaasaegne pilt", 100, 50);
}
function ruut2(){
    let w=document.getElementById("window").getContext("2d");
    let laius=parseInt(document.getElementById("laius").value);
    let korgus=parseInt(document.getElementById("korgus").value);
    w.fillStyle="black";
    w.fillRect(laius-20, korgus-20, laius, korgus); //x, y, laius, kõrgus
    w.fillText("Kaasaegne pilt", 100, 50);
}