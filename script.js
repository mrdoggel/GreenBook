/*var input = document.getElementById("myInput");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
    // Trigger the button element with a click
    document.getElementById("send-btn").click();
  }
});*/

function submitBilde(){
  document.getElementById("bildeUpload").submit();// Form submission
}

function submitOnEnter(event){
    if(event.which === 13){
        event.target.form.dispatchEvent(new Event("submit", {cancelable: true}));
        event.preventDefault(); // Prevents the addition of a new line in the text field (not needed in a lot of cases)
    }
}

document.getElementById("chat").addEventListener("keypress", submitOnEnter);

document.getElementById("form").addEventListener("submit", (event) => {
    event.preventDefault();
});

/*document.getElementById('chat').addEventListener("keydown",function(e){
    if(e.keyCode == 13){
        e.preventDefault();
        document.getElementById("send-btn").click();
    } 
});*/

/*function send() {
    if(event.keyCode === 'Enter') {
        document.getElementById("send-btn").click();
    }
}*/

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function bildeMouseover() {
    document.getElementById("inner-image").style.display="block";
    document.getElementById("outer-image").classList.toggle("linkStyle");
}

function bildeMouseoverRemove() {
    document.getElementById("inner-image").style.display="none";
    document.getElementById("outer-image").classList.toggle("linkStyle");
}


// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function tilBunn(){
  window.scrollTo(0,document.body.scrollHeight);
}

function tilTopp(){
  window.scrollTo(0,0);
}

function tilBunnAvTekst (id) {
   document.getElementById(id).scrollIntoView({ behavior: 'smooth', block: 'end' });
}

function tilBunnTrykk() {
     var objDiv = document.getElementById("scroll");
     objDiv.scrollTop = objDiv.scrollHeight;
}
