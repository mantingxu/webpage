// classList - shows/gets all classes
// contains - checks classList for specific class
// add - add class
// remove - remove class
// toggle - toggles class

let link = document.querySelector(".links");
let button = document.querySelector(".nav-toggle");
button.addEventListener('click',function(){
    // if(link.classList.contains("show-links"))
    // {
    //     link.classList.remove("show-links");
    // }
    // else{
    //     link.classList.add("show-links");
    // }
    link.classList.toggle("show-links");

})