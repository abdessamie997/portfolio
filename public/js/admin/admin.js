

// setting item

if (document.querySelectorAll('.setting_item') !== null) { //add_delete

    var setting_item = document.querySelectorAll('.setting_item');
    var add_delete = document.querySelectorAll('.add_delete');

    for (let i = 0; i < setting_item.length; i++) {

        setting_item[i].addEventListener('click', function () {

            add_delete[i].classList.toggle('add_delete_event');
        })
    }
}


// trick of show image:
if(document.getElementById('remove_uploading_img') !== null) {

    var remove_btn = document.getElementById('remove_uploading_img');
    var select_image = document.querySelector('.select_image');
    var change = document.querySelector('.change');
    var uploading_value = document.getElementById('remove_uploading_value');
    var preview = document.querySelector('.fileupload-preview');


    remove_btn.onclick = (_) => {

        uploading_value.value = "";
        preview.firstElementChild.src = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";

        if(preview.firstElementChild.src == "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image") {

            remove_btn.style.display = "none";
            change.style.display = "none";
            select_image.style.display = "inline-block";
        }
    }

    uploading_value.onchange = function () {

        if(preview !== null) {

            select_image.style.display = "none";
            remove_btn.style.display = "inline-block";
            change.style.display = "inline-block";

        }
    }
}


if(document.getElementById('messages_container') !== null) {

filter_messages('all', '0');

function filter_messages(key, val) {

    var m_container = document.getElementById('messages_container');
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if(this.readyState === 4 && this.status === 200) {

            m_container.innerHTML = this.response;
        }
    }

    request.open('get', `./get_messages/${key}/${val}`, true);
    request.send();
}
}

//

