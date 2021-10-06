$(document).ready(function () {
  $("#summernote").summernote();

    ClassicEditor.create(document.querySelector("#body")).catch((error) => {
      console.error(error);
    });

    //Other Scripts

 $("#selectAllBoxes").click(function (event) {
   if (this.checked) {
     $(".checkBoxes").each(function () {
       this.checked = true;
     });
   } else {
     $(".checkBoxes").each(function () {
       this.checked = false;
     });
   }
 });

    $("body").prepend("HELLO");
  
});

 // Grab the body
      var abody = document.body;
      
      // Make a new div
      var loadscreen = document.createElement('div');
      loadscreen.setAttribute("id", "load-screen");
      
      // Give the new div some content
      loadscreen.innerHTML = '<div id="loading"></div>';
      abody.appendChild(loadscreen);
      
      $('#load-screen').delay(500).fadeOut(600, function() {
         $(this).remove(); 
      });


function loadUsersOnline() {
  $.get("functions.php?onlineusers=result", function (data) {
    $(".usersonline").text(data);
  });
}


setInterval(function(){
  loadUsersOnline();
},500);