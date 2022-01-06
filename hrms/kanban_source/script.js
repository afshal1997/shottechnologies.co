//variables
let cardBeignDragged;
let dropzones = document.querySelectorAll('.dropzone');
let priorities;
// let cards = document.querySelectorAll('.kanbanCard');
let dataColors = [
    {color:"green", title:"to do"},
    {color:"blue", title:"in progress"},
    {color:"red", title:"done"}
];
let dataCards = {
    config:{
        maxid:0
    },
    cards:[]
};
let theme="light";
//initialize

$(document).ready(()=>{
    $("#loadingScreen").addClass("d-none");
    theme = localStorage.getItem('@kanban:theme');
    initializeBoards();
    var urls = "Kanbandata.php";
    $.ajax({
      type: "GET",
      url: urls,
      dataType: "json",
      success: function (data) {
        if(data.length > 0){
            dataCards.cards = data;
            dataCards.config.maxid = data.length;
            initializeComponents(dataCards);
        }
        initializeCards();
      }
    });


    $('#add').click((e)=>{
        const title = $('#titleInput').val()!==''?$('#titleInput').val():null;
        const description = $('#descriptionInput').val()!==''?$('#descriptionInput').val():null;
        const client_id = $('#client_id').val();
        $('#titleInput').val('');
        $('#descriptionInput').val('');
        $('#client_id').val('');
        if(title && description){
            //console.log(dataCards);
            let id = dataCards.config.maxid+1;
            const newCard = {
                id,
                title,
                description,
                position:"green",
                priority: false,
                client_id: client_id,
            }    
            //console.log(dataCards);
            dataCards.cards.push(newCard);
            
            var urls = "Kanbandata.php";
            $.ajax({
              type: "POST",
              url: urls,
              data: {"dd": newCard},
              dataType: "json",
              success: function (data) {
                //console.log(data);
              }
            });
            dataCards.config.maxid = id;
            save();
            appendComponents(newCard);
            initializeCards();
        }
    });
    $("#deleteAll").click(()=>{
        dataCards.cards = [];
        save();
    });
    $("#theme-btn").click((e)=>{
        e.preventDefault();
        $("body").toggleClass("light");
        if(theme){
            localStorage.setItem("@kanban:theme", `${theme==="light"?"light":""}`)
        }
        else{
            localStorage.setItem("@kanban:theme", "light")
        }
    });
});

//functions
function initializeBoards(){    
    dataColors.forEach(item=>{
        let htmlString = `
        <div class="board">
            <h3 class="text-center">${item.title.toUpperCase()}</h3>
            <div class="dropzone" id="${item.color}">
                
            </div>
        </div>
        `
        $("#boardsContainer").append(htmlString)
    });
    let dropzones = document.querySelectorAll('.dropzone');
    dropzones.forEach(dropzone=>{
        dropzone.addEventListener('dragenter', dragenter);
        dropzone.addEventListener('dragover', dragover);
        dropzone.addEventListener('dragleave', dragleave);
        dropzone.addEventListener('drop', drop);
    });
}

function initializeCards(){
    cards = document.querySelectorAll('.kanbanCard');
    
    cards.forEach(card=>{
        card.addEventListener('dragstart', dragstart);
        card.addEventListener('drag', drag);
        card.addEventListener('dragend', dragend);
    });
}

function initializeComponents(dataArray){
            console.log(dataArray);

    //create all the stored cards and put inside of the todo area
    dataArray.cards.forEach(card=>{
        appendComponents(card); 
    })
}

function appendComponents(card){
    //creates new card inside of the todo area
    let htmlString = `
        <div id=${card.id.toString()} class="kanbanCard ${card.position}" draggable="true">
            <div class="content">               
                <h4 class="title">${card.title}</h4>
                <p class="description">${card.description}</p>
            </div>
            <form class="row mx-auto justify-content-between">
                <span id="span-${card.id.toString()}" onclick="togglePriority(event)" class="material-icons priority ${card.priority? "is-priority": ""}">
                    star
                </span>
                <button class="invisibleBtn">
                    
                </button>
            </form>
        </div>
    `
    $(`#${card.position}`).append(htmlString);
    priorities = document.querySelectorAll(".priority");
}

function togglePriority(event){
    event.target.classList.toggle("is-priority");
    dataCards.cards.forEach(card=>{
        if(event.target.id.split('-')[1] === card.id.toString()){
            card.priority=card.priority?false:true;
        }
    })
    save();
}

function deleteCard(id,e){
    dataCards.cards.forEach(card=>{
        if(card.id === id){
            let index = dataCards.cards.indexOf(card);
            console.log(index);
            
            dataCards.cards.splice(index, 1);
            console.log(dataCards.cards);
            save();
        }
    })
}


function removeClasses(cardBeignDragged, color){
    cardBeignDragged.classList.remove('red');
    cardBeignDragged.classList.remove('blue');
    cardBeignDragged.classList.remove('green');
    cardBeignDragged.classList.add(color);
    position(cardBeignDragged, color);
}

function save(){
    var url = "Kanbandata.php";
    console.log(dataCards);
    $.ajax({
      type: "POST",
      url: url,
      data: {"update": dataCards},
      dataType: "json",
      success: function (data) {
        console.log(data);
      }
    });
    //localStorage.setItem('@kanban:data', JSON.stringify(dataCards));
}

function position(cardBeignDragged, color){
    const index = dataCards.cards.findIndex(card => card.id ===cardBeignDragged.id);
    console.log(cardBeignDragged.id);
    dataCards.cards[index].position = color;
    save();
}

//cards
function dragstart(){
    dropzones.forEach( dropzone=>dropzone.classList.add('highlight'));
    this.classList.add('is-dragging');
}

function drag(){
    
}

function dragend(){
    dropzones.forEach( dropzone=>dropzone.classList.remove('highlight'));
    this.classList.remove('is-dragging');
}

// Release cards area
function dragenter(){

}

function dragover({target}){
    this.classList.add('over');
    cardBeignDragged = document.querySelector('.is-dragging');
    console.log(cardBeignDragged);
    if(this.id ==="green"){
        removeClasses(cardBeignDragged, "green");
    }
    else if(this.id ==="blue"){
        removeClasses(cardBeignDragged, "blue");
    }
    else if(this.id ==="red"){
        removeClasses(cardBeignDragged, "red");
    }
    
    this.appendChild(cardBeignDragged);
}

function dragleave(){
  
    this.classList.remove('over');
}

function drop(){
    this.classList.remove('over');
}