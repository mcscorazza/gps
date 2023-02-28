const urlRead = "https://www.mcs.eng.br/gps/api/read.php";
const gpsContainer = document.getElementById("gps");

async function getGPS() {
    const response = await fetch(urlRead);
    const data = await response.json();
    console.log(data);

    gpsContainer.innerHTML = "";

    data.map((gps) => {
        const aDiv = document.createElement("div");
        const aID = document.createElement("b");
        const divLt = document.createElement("div");
        const tLt = document.createElement("strong");
        const aLt = document.createElement("span");
        const divLg = document.createElement("div");
        const tLg = document.createElement("strong");
        const aLg = document.createElement("span");
        const aDt = document.createElement("i");
        const frm = document.getElementById("frm");

        aID.innerText = gps.idGPS;
        tLt.innerText = "Lt.:";
        aLt.innerText = gps.latitude;
        tLg.innerText = "Lg.:";
        aLg.innerText = gps.longitude;
        let gpsDate = new Date(gps.date);
        
        let day = gpsDate.getDate();
        let month = gpsDate.getMonth() + 1;
        let year = gpsDate.getFullYear();
        
        let hour = gpsDate.getHours() - 3;
        let min = gpsDate.getMinutes();
        let sec = gpsDate.getSeconds();
        
        if(day < 10) {day = "0" + day;}
        if(month < 10) {month = "0" + month;}
        
        if(hour < 10) {hour = "0" + hour;}
        if(min < 10) {min = "0" + min;}
        if(sec < 10) {sec = "0" + sec;}

        let stringDate = day + "." + month + "." + year + " - " + hour + ":" + min + ":" + sec;
        
        aDt.innerText = stringDate;

        

        aDiv.appendChild(aDt);
        aDiv.appendChild(divLt);
        divLt.appendChild(tLt);
        divLt.appendChild(aLt);
        aDiv.appendChild(divLg);
        divLg.appendChild(tLg);
        divLg.appendChild(aLg);
        
        let loc = gps.latitude + "," + gps.longitude;
        aDiv.onclick = function() { frm.src = "https://www.google.com/maps/embed/v1/place?key=AIzaSyCB9S0dGxQ3Wq5aHs_j0w-7DhyaGf4VoQ4&q=" + loc ; }

        gpsContainer.appendChild(aDiv);
    })
}

getGPS();

setInterval("getGPS();",1000);