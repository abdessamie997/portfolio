

var scroll = new SmoothScroll('a[href*="#"]', { speed: 600 });

//// ------ end scroll

// height of header = window.innerHeight:

document.getElementById("header").style.height =
  window.innerHeight + "px";

// end.


var parent_pages = document.querySelector(".parent-of-all-pages");

parent_pages.style.backgroundImage = `url("./images/back/57690.jpg")`;

// menu buttons:

var menu_button_s = document.querySelector('#navbar_btns');
var title = document.querySelector('title');

for(let i = 0; i < menu_button_s.children.length; i++) {

    for(let i = 0; i < menu_button_s.children.length; i++) {

        if(menu_button_s.children[i].firstElementChild.id == title.textContent) {

            menu_button_s.children[i].classList.add('change_btn_s_color');
        }
    }
}


// form validation:

if(document.getElementById('message') !== null) {

var valid_form = document.getElementById("valid_form");

valid_form.onclick = function () {

    var name     = document.getElementById("contact-name");
    var email    = document.getElementById("contact-email");
    var sub      = document.getElementById("contact-subject");
    var msg      = document.getElementById("contact-message");
    var _token   = document.getElementById("token").getAttribute("contain");

    var error = [];
    name.value  == "" ? error.push("name"): false;
    email.value == "" ? error.push("email"): false;
    sub.value   == "" ? error.push("subject"): false;
    msg.value   == "" ? error.push("message"): false;

    function resetValues() {

        name.value  = "";
        email.value = "";
        sub.value   = "";
        msg.value   = "";
    }

    if(error.length !== 0) {

        document.querySelector('.message-sending').innerHTML = "";
        document.querySelector('.message-sending'). innerHTML = `<p class='error'>*  ${error[0]} input field can't be empty !</p>`;

    } else {

        let messageSending = document.querySelector('.message-sending');

        var myRequest = new XMLHttpRequest;

        myRequest.onreadystatechange = function () {

            if(this.readyState === 4 && this.status === 200) {

                resetValues();
                messageSending.innerHTML = `<i class="fa fa-check-circle"></i> ` + this.responseText;
            }
        }

        myRequest.open("POST", "./validate_form", true);
        myRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        myRequest.send("name="+name.value+"&email="+email.value+"&sub="+sub.value+"&msg="+msg.value+"&_token="+_token);

    }
}
}
