/*function getLocation(){
    document.getElementById("yawtext").value = b.yaw;
    document.getElementById("pitchtext").value = "Johnny Bravo";
}*/

function showPreview(){
    document.getElementById("previewBox").innerHTML = document.getElementById("popistext").value;
    updateLink();
}

const elArr = document.getElementsByClassName("editLink");

function updateLink(){
    let newYaw = document.getElementById("yawtext").value;
    let newPitch = document.getElementById("pitchtext").value;
    let newPopis = document.getElementById("popistext").value;
    let newUrl = document.getElementById("urltext").value;
    
    let elIDs = document.getElementsByClassName("editID");
    for(let i = 0; i < elArr.length; i++){
        let out = "https://expa.swpelc.eu/admin/edit.php?changeID=" + elIDs[i].innerHTML + "&newYaw=" + newYaw + "&newPitch=" + newPitch + "&newPopis=" + newPopis + "&newUrl=" + newUrl;
        document.getElementsByClassName("editLink")[i].href = out;
    }
}