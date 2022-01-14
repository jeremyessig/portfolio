// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var text = null;

var modalContent = document.getElementsByClassName("modal-content")[0];

function showSlide(imgID){
  let img = document.getElementsByClassName('slide')[imgID - 1],
      modalImg = document.getElementById("modalImg");
    // let text = document.getElementById("myModal");
    // text.innerHTML = "<h3>"+ img.src + id +"</h3>";
    // text.setAttribute("class", "programm-description active")
    modalImg.src = img.src;
    modalContent.setAttribute("class", "modal-content show")
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modalContent.setAttribute("class", "modal-content hide");
  delay(350).then(() => closeModal());
}

function closeModal(){
    modal.style.display = "none"
    // text.setAttribute("class", "programm-description")
    modalContent.setAttribute("class", "modal-content")
    console.log("transition");
}

function delay(time) {
  return new Promise(resolve => setTimeout(resolve, time));
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    // text.setAttribute("class", "programm-description")
    modalContent.setAttribute("class", "modal-content hide");
    delay(350).then(() => closeModal());
  }
}