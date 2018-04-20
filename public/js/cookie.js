function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var user = getCookie("username");
    var cookierContainer = document.getElementById("cookie");
    var cookieButton = document.querySelector('.cookie-button');
    if (user != "") {
//        alert("Welcome again " + user);
        
    } 
//     else {
//       user = prompt("Please enter your name:","");
//       if (user != "" && user != null) {
//           setCookie("username", user, 30);
//       }
//    }
    else {

        cookierContainer.style.display = 'block';
        cookieButton.addEventListener('click', function () {
            cookierContainer.style.display = 'none';
            user = "RandomUser";
            setCookie("username", "RandomUser", 30);
            //validation code to see State field is mandatory.  
        });
    }
}
