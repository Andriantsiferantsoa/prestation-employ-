
<?php
require_once("DBconnexion.php");
?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           GESTION D'EMPLOYE
            <small>Administration</small>
            <div class="input-group">
              <input type="text"  class="form-control" placeholder="Search..." id="search_emp" onkeyup="search_emp()">
              <!--<button type="button" class="btn bg-orange" id="Rechercher_id"><i>Rechercher</i></button>-->
            </div>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#" id="etat"><i class="fa fa-dashboard"></i> 
              <div class="btn-group-vertical">
                  <button type="button" class="btn btn-default">Etat de salaire</button>
                          
              </div>
            </a></li>
            <li><a data-toggle="modal" href="#ajout_emp"><i class="fa fa-dashboard"></i> 
              <div class="btn-group-vertical">
                  <button type="button" class="btn btn-success">+</button>
                          
              </div>
            </a></li>
            <li class="active"><a href="#">Liste</a></li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content" id="steph">
           <!-- <div class="row">
           left column 
            <div class="col-lg-12">
              
              </div> /.box 
            </div>/.col (right) -->

            <div class="col-lg-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Liste Employee</h3>
                </div><!-- /.box-header -->

                <!--affichage liste des employés-->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 120px">Numero</th>
                        <th style="width: 450px">Nom</th>
                        <th>Adresse</th>
                        <th>Action</th>
                      </tr>
                     
                     <?php
                     $emp = $bdd->query("SELECT * FROM employes ORDER BY id ASC");
                     while($rep_emp = $emp->fetch())
                     {
                     ?> 
                      <tr>
                        <td><?php echo $rep_emp["Id"];?>.</td>
                        <td><?php echo $rep_emp["numero"];?></td>
                        <td>
                          <?php echo $rep_emp["nom"];?>
                        </td>
                        <td>
                          <?php echo $rep_emp["adresse"];?>
                        </td>
                        <td>
                          <div class="btn-group">
                                       
                                        <a class="btn btn-success Modifier" href="#modif_emp" data-toggle="modal" Id="Modifier<?php echo $rep_emp["Id"];?>"><i class="icon_check_alt2"></i>Modifier</a>
                                        <a class="btn btn-danger Supprimer" href="#suppr_emp" data-toggle="modal" Id="Supprimer<?php echo $rep_emp["Id"];?>"><i class="icon_close_alt2"></i>Supprimer</a>
                          </div>
                        </td>
                      </tr>
                      <?php
                       }
                       ?>
                       
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <!-- fin affichage liste des employés-->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                  </ul>
                </div>
              </div>   <!-- /.row -->
          </div><!-- /.box -->
        </section><!-- /.content -->



<script>
  //modifier employe 
        $(".Modifier").on("click",function(){
          $.ajax({
              type: 'POST',
              data: { 

                      action: "affiche_emp",
                      id: $(this).attr('id').replace("Modifier","")
                    
                    },
              url: 'script.php',
              dataType: 'json',
            //async: false,
            
            success: function(rep)
                    {
                      $("#modif_hide_emp").val(rep.id);
                      $("#numero_modif").val(rep.numero);
                      $("#nom_modif").val(rep.nom);
                      $("#adresse_modif").val(rep.adresse);
                    },
       
            error: function(jqXHR, textStatus, errorThrown)
                    {
                      console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                      alert('Error! '+textStatus);
                    }
                });
          });
        
         
        //formulaire anovana anazy
        $("#form_emp_modif").on("submit",function(event){
          event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening
            $.ajax(
            {
                type: 'POST',
                data: { 
          
                        action: "modif_emp",
                        nom: $("#nom_modif").val(),
                        numero: $("#numero_modif").val(),
                        adresse: $("#adresse_modif").val(),
                        id: $("#modif_hide_emp").val()
                  
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
          //fin modification employe

  //supprimer employé
        $(".Supprimer").on("click",function(){
            $("#suppr_hide_emp").val($(this).attr("id").replace("Supprimer",""));
          });


        $("#form_emp_suppr").on("submit",function(event){
            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening
                 //alert("tafiditra");
                $.ajax(
                {
                    type: 'POST',
                    data: { 
              
                            action: "fafana",
                            id: $("#suppr_hide_emp").val(),
                            type: "emp"
                      
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
        
            //fin suppression
            
$("#Rechercher_id").on("click",function()
            {
              
              //document.getElementById("steph").innerHTML ='';
              
              search_emp();
            });
function search_emp()
            {

            
              $("#steph").load('search.php?type="emp"&search=' + $("#search_emp").val());
             
            
            
             
         };

         $("#cherche").on("submit",function(event){
            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening
                 //alert("tafiditra");
                $.ajax(
                {
                    type: 'GET',
                    data: { 
              
                            action: "search",
                            search: $("#search_emp").val(),
                            type: "emp"
                      
                          },
                    url: 'search.php',
                    dataType: 'json',
                    async: false,
                    success: function(rep)
                            {
                             //alert(rep.succes);
                             alert("voray");

                            },
                     error: function(jqXHR, textStatus, errorThrown)
                             {
                                console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                                alert('Error! '+textStatus);
                              }


                });
             });

$("#etat").on("click",function()
{
$("#steph").load("etat.php");
});
</script>
      