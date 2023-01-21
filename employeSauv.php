
<?php
require_once("DBconnexion.php");
?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           GESTION D'EMPLOYE
            <small>Administration</small>
          </h1>
          <ol class="breadcrumb">
            <li><a data-toggle="modal" href="#myModal"><i class="fa fa-dashboard"></i> 
              <div class="btn-group-vertical">
                  <button type="button" class="btn btn-success">+</button>
                          
              </div>
            </a></li>
            <li class="active"><a href="#">Liste</a></li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
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
                <div class="box-body">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th style="width: 10px">#</th>
                      <th style="width: 120px">Numero</th>
                      <th style="width: 450px">Nom</th>
                      <th>Adresse</th>
                      <th>Action</th>
                    </tr>
                   <?php
                   $emp = $bdd->query("SELECT * FROM employes ORDER BY id DESC");
                   while($rep_emp = $emp->fetch())
                   {
                   ?> 
                    <tr>
                      <td><?php echo $rep_emp["id"];?>.</td>
                      <td><?php echo $rep_emp["numero"];?></td>
                      <td>
                        <?php echo $rep_emp["nom"];?>
                      </td>
                      <td>
                        <?php echo $rep_emp["adresse"];?>
                      </td>
                      <td>
                        <div class="btn-group">
                                     
                                      <a class="btn btn-success Modifier" href="#modif_emp" data-toggle="modal" id="Modifier<?php echo $rep_emp["id"];?>"><i class="icon_check_alt2"></i>Modifier</a>
                                      <a class="btn btn-danger Supprimer" href="#suppr_emp" data-toggle="modal" id="Supprimer<?php echo $rep_emp["id"];?>"><i class="icon_close_alt2"></i>Supprimer</a>
                        </div>
                      </td>
                    </tr>
                    <?php
                     }
                     ?>
                  </tbody></table>
                </div><!-- /.box-body -->
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
        
        $(".Modifier").on("click",function(){
             
          $.ajax({
              type: 'POST',
              data: { action: "affiche_emp",
                      id: $(this).attr('id').replace("Modifier","")
                    },
              url: 'script.php',
              dataType: 'json',
            //async: false,
            
            success: function(rep){
                $("#modif_hide").val(rep.id);
                $("#numero_modif").val(rep.numero);
                $("#nom_modif").val(rep.nom);
                $("#adresse_modif").val(rep.adresse);
                    },
       
            error: function(jqXHR, textStatus, errorThrown){
                  console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                  alert('Error! '+textStatus);
                  }
                });
          });
        
          $(".Supprimer").on("click",function(){
             


            });
   
        $("#form_emp_modif").on("submit",
function(event)
{
event.stopPropagation(); // Stop stuff happening
  event.preventDefault(); // Totally stop stuff happening
  $.ajax({
            type: 'POST',
            data: { 
      
              action: "modif_emp",
                nom: $("#nom_modif").val(),
                numero: $("#numero_modif").val(),
                adresse: $("#adresse_modif").val(),
                id: $("#modif_hide").val()
          
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









        </script>
      