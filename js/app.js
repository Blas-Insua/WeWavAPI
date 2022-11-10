"use strict"
/**
const URL = "api/tracks/";

let tasks = [];

let form = document.querySelector('#task-form');
form.addEventListener('submit', insertTask);



// Obtiene todas las tareas de la API REST
 
async function getAll() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        tasks = await response.json();

        showTasks();
    } catch(e) {
        console.log(e);
    }
}


//Inserta la tarea via API REST
 
async function insertTask(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let task = {
        titulo: data.get('titulo'),
        descripcion: data.get('descripcion'),
        prioridad: data.get('prioridad'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(task)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nTask = await response.json();

        // inserto la tarea nuevo
        tasks.push(nTask);
        showTasks();

        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteTask(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.task;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar la tarea del arreglo global
        tasks = tasks.filter(task => task.id != id);
        showTasks();
    } catch(e) {
        console.log(e);
    }
}

function showTasks() {
    let ul = document.querySelector("#task-list");
    ul.innerHTML = "";
    for (const task of tasks) {

        let html = `
            <li class='
                    list-group-item d-flex justify-content-between align-items-center
                    ${ task.finalizada == 1 ? 'finalizada' : ''}
                '>
                <span> <b>${task.titulo}</b> - ${task.descripcion} (prioridad ${task.prioridad}) </span>
                <div class="ml-auto">
                    ${task.finalizada != 1 ? `<a href='#' data-task="${task.id}" type='button' class='btn btn-success btn-finalize'>Finalizar</a>` : ''}
                    <a href='#' data-task="${task.id}" type='button' class='btn btn-danger btn-delete'>Borrar</a>
                </div>
            </li>
        `;

        ul.innerHTML += html;
    }

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteTask);
    }
}



getAll();
*/
window.onload = () => {

    const URL = "api/";

    let tracks = [];

    async function getTracks() {
        try {
            let response = await fetch(`${URL}tracks`);
            if (!response.ok) {
                throw new Error('Recurso no existe');
            }
            tracks = await response.json();
    
            showTracks();
        } catch(e) {
            console.log(e);
        }
    }

    function showTracks() { 
        let main = document.querySelector("main");
        main.innerHTML = "";

        let accounts = getAccounts();
        for (const track of tracks) {
    
            let html = `
                <div class="file">
                <div class="fileTitle">
                    <p><a href=${track.userName}>${track.userName}</a></p>
                    <p>${track.name}</p>
                </div>
                
                    ${track.photo_dir !=null}<div class="filePhoto hidden"><img src="{$track->photo_dir}"></img></div>{else}<span></span>{/if}
                
                <div class="fileInfo hidden">
                    {if $smarty.session.loggedin==true && $track->userName==$smarty.session.name}
                        <form action="editFile/{$track->id}" method="post">
                            <button type="submit" class="editFile" title="Edit track" name="editFile">edit</button>
                            <div class="trackForm">
                                <label for="name">Track name:</label>
                                    <input type="text" name="name" value="{$track->name}" required></input><br>
                                <label for="genre">Genre:</label>
                                    <select name="genre" required>
                                        {foreach from=$genres item=$genre}
                                            <option value="{$genre->id}" {if $track->genre_id==$genre->id}selected{/if}>{$genre->genre}</option>
                                        {/foreach}
                                    </select><br>
                                <label for="date">Date:</label>
                                    <input type="date" name="date" {if $track->date}value="{$track->date}"{/if}></input><br> 
                            </div>   
                            <a class="deleteFile" href="deleteFile/{$track->id}/" title="Delete track">del</a>                    
                        </form>                    
                    {else}
                        <p>{$track->name}</p>
                        <p>Genre: <a href="genres/{$track->genre}/">{$track->genre}</a></p>
                        <p>Date: {$track->date}</p>
                    {/if}
                </div>
                <audio controls src="" alt="" type="audio/wav"></audio>
            </div>
            `;
    
            ul.innerHTML += html;
        }
    
        // asigno event listener para los botones
        const btnsDelete = document.querySelectorAll('a.btn-delete');
        for (const btnDelete of btnsDelete) {
            btnDelete.addEventListener('click', deleteTask);
        }
    }

    let accounts =[];

    async function getAccounts() {
        try {
            let response = await fetch(`${URL}accounts`);
            if (!response.ok) {
                throw new Error('Recurso no existe');
            }
            accounts = await response.json();

            return accounts;
        } catch(e) {
            console.log(e);
        }
    }

    if (window["navDisplay"]) {
        window["navDisplay"].addEventListener("click", ()=>{
            window["navDisplay"].parentNode.parentNode.classList.toggle("active");
            window["menuBar"].classList.remove("active")
        });
    }
    
    if (window["menuBtn"]) {
        window["menuBtn"].addEventListener('click', () => {                        
            document.getElementById("menuBar").classList.toggle("active");
        });
    };

    if (window.location.pathname == "/WeWav/home/" || window.location.pathname == "/WeWav/") {
        document.title = "WeWav/home";   
        window["home"].classList.add("active");
    };

    if (window.location.pathname == "/WeWav/artists/") {
        document.title = "WeWav/artists";   
        window["artists"].classList.add("active");
    };

    if(window["tracks"].addEventListener("click", () => {
        getTracks();
    } ))

    if (window.location.pathname == "/WeWav/tracks/") {
        document.title = "WeWav/tracks";   
        window["tracks"].classList.add("active");
    };

    if (window.location.pathname == "/WeWav/genres/") {
        document.title = "WeWav/genres";   
        window["genres"].classList.add("active");
    };

    if (window.location.pathname == "/WeWav/upload/") {
        document.title = "WeWav/upload";   
        window["upload"].classList.add("active");
    };   

    if (window.location.pathname == "/WeWav/search/") {
        document.title = "WeWav/search";   
        document.querySelector("main").classList.add("search");
    };   

    if ((window.location.pathname == "/WeWav/login/") || (window.location.pathname == "/WeWav/loginSubmit/")) {
        document.title = "WeWav/login";   
    };     

    document.querySelectorAll(".fileTitle").forEach(file => {
        
        file.addEventListener("click", (e) => {
            console.log(e.path[2].children);
            e.path[2].children[1].classList.toggle("hidden");
            e.path[2].children[2].classList.toggle("hidden");
            e.path[2].children[0].children[1].classList.toggle("hidden");
        })
    });
    
    if (window["errorDIV"]) {
        console.log(window["errorDIV"]);
        let errorDIV = window["errorDIV"];
        errorDIV.scrollIntoView({behavior:"smooth"});
        errorDIV.classList.add("active"); 
        setInterval(() => {
            errorDIV.classList.toggle("active"); 
            
        }, 1500); 

    };
};