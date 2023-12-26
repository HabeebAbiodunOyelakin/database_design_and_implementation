function myMenuFunction() {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }

    var a = document.getElementById("loginBtn");
    var x = document.getElementById("login");
   

    function login() {
        x.style.left = "4px";
        x.style.opacity = 1;
        y.style.opacity = 0;
        y.style.right = "-522px";
        a.className += " white-btn";  
    }
