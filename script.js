//formulaire ajout employé
$("#form_emp").on("submit",
function(event)
{
event.stopPropagation(); // Stop stuff happening
  event.preventDefault(); // Totally stop stuff happening
  $.ajax({
            type: 'POST',
            data: { 
			
			        action: "ajout_employe",
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
				 $("#numero").val("");
				 $("#adresse").val("");
				 $("#nom").val("");
			  },
			 error: function(jqXHR, textStatus, errorThrown)
               {
                  console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                  alert('Error! '+textStatus);
			  }
			});
			
  
});
//fin formulaire ajout employé

//formulaire ajout entreprise
$("#form_entr").on("submit", function(event){
event.stopPropagation(); // Stop stuff happening
  event.preventDefault(); // Totally stop stuff happening
  $.ajax({
            type: 'POST',
            data: { 
			
			        action: "ajout_entr",
	            	numero_entr: $("#numero_entr").val(),
	            	design: $("#design").val()
					
                   },
            url: 'script.php',
            dataType: 'json',
            async: false,
			success: function(rep)
			  {
				 //alert(rep.succes);
				 $(".close").click();
				 $("#entreprise").click();
				 $("#numero_entr").val("");
				 $("#design").val("");
			  },
			 error: function(jqXHR, textStatus, errorThrown)
               {
                  console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                  alert('Error! '+textStatus);
			  }
			});
 
});
//fin formlaire ajout entreprise

//formulaire ajout travail
$("#form_trav").on("submit",
function(event)
{
event.stopPropagation(); // Stop stuff happening
  event.preventDefault(); // Totally stop stuff happening
  $.ajax({
            type: 'POST',
            data: { 
			
			        action: "ajout_trav",
	            	numero_empT: $("#numero_empT").val(),
	            	numero_entrT: $("#numero_entrT").val(),
	            	date: $("#date_emb").val(),
	            	nb_heure: $("#nb_heure").val(),
	            	taux: $("#taux").val()
				
				   },
            url: 'script.php',
            dataType: 'json',
            async: false,
			success: function(rep)
			  	{
				 //alert(rep.succes);
				 $(".close").click();
				 $("#travail").click();
				 $("#numero_empT").val("");
				 $("#numero_entrT").val("");
				 $("#date_emb").val("");
				 $("#nb_heure").val("");
				 $("#taux").val("");
				},
			error: function(jqXHR, textStatus, errorThrown)
               	{
                  console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                  alert('Error! '+textStatus);
			  	}
			});
 });
//fin formulaire ajout travail

$("#nb_heure").on("click", function()
{
$("#vatany").load("nb_heure.php");
});
//fampidirana page ao am index izy reetra
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
//fin fampidirana page ao amn index izy reetra


