$("#form_emp").on("submit",
function(event)
{
event.stopPropagation(); // Stop stuff happening
  event.preventDefault(); // Totally stop stuff happening
  $.ajax({
            type: 'POST',
            data: { 
			
			        action: "ajout_emp",
	            	nom: $("#nom").val(),
	            	numero: $("#numero").val(),
	            	adresse: $("#adresse").val()
					
                   },
            url: 'script.php',
            dataType: 'json',
            async: false,
			success: function(rep)
			  {
				 //alert(rep.succes);
				 $(".close").click();
				 $("#employe").click();
			  },
			 error: function(jqXHR, textStatus, errorThrown)
               {
                  console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                  alert('Error! '+textStatus);
			  }
			});
			
  
});

$("#employe").on("click",function()
{
$("#vatany").load("employe.php");
});

$("#entreprise").on("click",function()
{
$("#vatany").load("entreprise.php");
});

$("#travail").on("click",function()
{
$("#vatany").load("travail.php");
});



