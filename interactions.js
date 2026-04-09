const toggleBtn = document.getElementById("toggleFoodBtn");
const foodList = document.getElementById("foodList");

if(toggleBtn){
toggleBtn.addEventListener("click", function(){

if(foodList.style.display === "none"){
foodList.style.display = "block";
toggleBtn.innerText = "Hide Favourite Foods";
}else{
foodList.style.display = "none";
toggleBtn.innerText = "Show Favourite Foods";
}

});
}


/* KEYDOWN EVENT - search */

const searchInput = document.getElementById("searchFood");

if(searchInput){
searchInput.addEventListener("keydown", function(event){

if(event.key === "Enter"){
document.getElementById("searchResult").innerText =
"You searched for: " + searchInput.value;
}

});
}


/* SUBMIT EVENT - contact form validation */

const contactForm = document.getElementById("contactForm");

if(contactForm){
contactForm.addEventListener("submit", function(e){

const name = document.getElementById("contactName").value;
const email = document.getElementById("contactEmail").value;

if(name === "" || email === ""){
e.preventDefault();
alert("Please fill all fields");
}

});
}