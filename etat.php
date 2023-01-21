
<?php
require_once("DBconnexion.php");

?>

        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        
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
                        <th>Salaire</th>
                       
                      </tr>
                      <!--<div id="table_employe">-->
                     <?php
                    // $op=$_GET["action"];
                     
                     $emp = $bdd->query("SELECT *,(nbheure*taux) as salaire FROM employes,travail ORDER BY salaire DESC");
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
                          <?php echo $rep_emp["salaire"];?>
                        </td>
                        
                      </tr>
                      <?php
                       }                       
                      ?>
                      <!-- </div>-->
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
     <!-- /.content -->
<script type="text/javascript">
  $(".Modifier").on("click",function(){
          $.ajax({
              type: 'POST',
              data: { 

                      action: "affiche_emp",
                      id: $(this).attr('id').replace("ModifierS","")
                    
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
</script>