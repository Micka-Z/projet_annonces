$(document).ready(function() {
    
    $('#pseudo').keyup(function() {
      //On vérifie si le pseudo n'a pas été déjà pris
      console.log( "ready!" );
                  verifier_pseudo();
    });
  });

  function verifier_pseudo(){
    $.ajax({
        type: "post",
        url:  "verifier.php",
        data: {
            'pseudo_check' : $("#pseudo").val(),
        },
        success: function(data){
            console.log(data);
                    if(data.substring(10, 17) == "success"){
                        console.log("ok remove class");
                        $("#pseudo").removeClass("is-invalid");
                        $("#pseudo").addClass("is-valid");
                        } else {
                            console.log("erreur");
                        $("#pseudo").removeClass("is-valid");
                        $("#pseudo").addClass("is-invalid");   
                    }
                 }
    });
}

