import {deleteUser} from "./deleteUser.js";

window.addEventListener('DOMContentLoaded', () => { init(); });

function init(){
    document.querySelectorAll(".delete_user")?.forEach(element => {
        element.addEventListener('click', (event) => deleteUser(event));
    });
}