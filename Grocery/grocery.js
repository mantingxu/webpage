// ****** SELECT ITEMS **********

const alert = document.querySelector(".alert");
const form = document.querySelector(".grocery-form");
const grocery = document.getElementById("grocery");
const submitBtn = document.querySelector(".submit-btn");
const container = document.querySelector(".grocery-container");
const list = document.querySelector(".grocery-list");
const claerBtn = document.querySelector(".clear-btn");


// edit option
let editElement;
let editFlag = false;
let editID = "";

// ****** EVENT LISTENERS **********
// submit form
form.addEventListener('submit', addItem);

// clear items
claerBtn.addEventListener('click', clearItems);


// load items
window.addEventListener('DOMContentLoaded', setUpItems);

// ****** FUNCTIONS **********

function addItem(e) {
    e.preventDefault();
    const value = grocery.value;
    const id = new Date().getTime().toString(); // get an unique id

    if (value && !editFlag) {
        createListItem(id,value);

        // display alert
        displayAlert("item added to the list", "alert-success");
        // show container
        container.classList.add("show-container");
        // add to local storage
        addToLocalStorage(id, value);
        // set back to default
        setBackToDefault()


    }
    else if (value && editFlag) {
        editElement.innerHTML = value;
        displayAlert('value change', 'alert-success');
        // edit local storage
        editLocalStorage(editID, value);
        setBackToDefault();
    }
    else {
        displayAlert("please enter value", "alert-danger");
    }
}

// display alert
function displayAlert(text, action) {
    alert.textContent = text;
    alert.classList.add(action);

    // remove alert
    setTimeout(function () {
        alert.textContent = '';
        alert.classList.remove(action);
    }, 1000);

}

// clear items
function clearItems() {
    const items = document.querySelectorAll(".grocery-item");

    if (items.length > 0) {
        items.forEach(function (item) {
            list.removeChild(item);
        });
    }

    container.classList.remove("show-container");
    displayAlert("empty list", "alert-danger");
    setBackToDefault();
    localStorage.removeItem('list');
}

// delete function
function deleteItem(e) {
    const element = e.currentTarget.parentElement.parentElement;
    const id = element.dataset.id;
    list.removeChild(element);
    console.log(list.children.length);
    if (list.children.length === 0) {
        container.classList.remove('show-container');
    }
    displayAlert('item removed', 'alert-danger');
    setBackToDefault();
    // remove from local storage
    removeFromLocalStorage(id);
}
// edit function
function editItem(e) {
    const element = e.currentTarget.parentElement.parentElement;

    // set edit item
    editElement = e.currentTarget.parentElement.previousElementSibling;

    // set form value
    grocery.value = editElement.innerHTML;
    editFlag = true;
    editID = element.dataset.id;
    submitBtn.textContent = "edit";
}






// set back to default

function setBackToDefault() {
    grocery.value = "";
    editFlag = false;
    editID = "";
    submitBtn.textContent = "submit";
}
// ****** LOCAL STORAGE **********
function addToLocalStorage(id, value) {
    const grocery = { id, value };
    let items = getLocalStorage();
    items.push(grocery);
    localStorage.setItem("list", JSON.stringify(items));
}

function removeFromLocalStorage(id) {
    let items = getLocalStorage();
    items = items.filter(function (item) {
        if (item.id !== id) {
            return item;
        }
    });
    localStorage.setItem("list", JSON.stringify(items));
}

function editLocalStorage(id, value) {
    let items = getLocalStorage();
    items = items.map(function (item) {
        if (item.id === id) {
            item.value = value;
        }
        return item;
    })
    localStorage.setItem("list", JSON.stringify(items));
}

function getLocalStorage() {
    return localStorage.getItem("list") ? JSON.parse(localStorage.getItem("list")) : [];
}




//  Local Storage tutorial
// localStorage.setItem("orange",JSON.stringify(["item","item2"]));
// const oranges = JSON.parse(localStorage.getItem('orange'));
// console.log(oranges);

// ****** SETUP ITEMS **********

function setUpItems() {
    let items = getLocalStorage();
    if (items.length > 0) {
        items.forEach(function(item){
            createListItem(item.id,item.value);
        });
        container.classList.add("show-container");
    }
}

function createListItem(id, value) {
    const element = document.createElement('article');
    // add class
    element.classList.add('grocery-item');
    // add id
    const attr = document.createAttribute('data-id');
    attr.value = id;
    element.setAttributeNode(attr);
    element.innerHTML = `<p class="title">${value}</p>
        <div class="btn-container">
            <button type="button" class="edit-btn">
                <i class="fas fa-edit"></i>
            </button>
            <button type="button" class="delete-btn">
              <i class="fas fa-trash"></i>
          </button>
        </div>`;
    const deleteBtn = element.querySelector('.delete-btn');
    const editBtn = element.querySelector('.edit-btn');
    deleteBtn.addEventListener('click', deleteItem);
    editBtn.addEventListener('click', editItem);
    // append child
    list.appendChild(element);

}