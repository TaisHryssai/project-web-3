$(document).ready(function () {
    $('.dropdown-toggle').dropdown()
});

// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

$(document).ready(function(){
    $("heart").click(function(){
      if($("#heart").hasClass("liked")){
        $("#heart").html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
        $("#heart").removeClass("liked");
      }else{
        $("#heart").html('<i class="fa fa-heart" aria-hidden="true"></i>');
        $("#heart").addClass("liked");
      }
    });
  });

  function myFunction(x) {
    x.classList.toggle("fa-thumbs-down");
  }

  function receitas(x) {
     x = document.getElementById("myDIV");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }


  function appendText() { // Create text with jQuery
    var txt3 = document.createElement("button");         // Create text with DOM
    txt3.innerHTML = "Descurtir";         // Create text with DOM

    $(".card-header").append(txt3);   // Append new elements
}
