
<?php
require_once("DBconnexion.php");
$type=$_GET['type'];
//$search = str_replace($_GET['search'],"'",""); 
$search = $_GET['search'];
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
                  <?php
                    if ($type=="emp") {
                  ?>
                  <h3 class="box-title">Liste Employee</h3>

                  <?php
                    }
                    elseif ($type=="entr") {
                  ?>

                  <h3 class="box-title">Liste Entreprise</h3>
                  <?php
                  } else 
                  {
                  ?>
                    <h3 class="box-title">Liste travail</h3>
                  <?php
                  }
                  ?>
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
                      <!--<div id="table_employe">-->
                     <?php
                    // $op=$_GET["action"];
                     
                     $emp = $bdd->query("SELECT * FROM employes where numero LIKE '%".$search."%' OR nom LIKE '%".$search."%' OR adresse LIKE '%".$search."%' ORDER BY id");
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
                                       
                                        <a class="btn btn-success Modifier" href="#modif_emp" data-toggle="modal" id="ModifierS<?php echo $rep_emp["id"];?>"><i class="icon_check_alt2"></i>Modifier</a>
                                        <a class="btn btn-danger Supprimer" href="#suppr_emp" data-toggle="modal" id="Supprimer<?php echo $rep_emp["id"];?>"><i class="icon_close_alt2"></i>Supprimer</a>
                          </div>
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