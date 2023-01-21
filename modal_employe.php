
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

                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 120px">Numero</th>
                        <th style="width: 450px">Nom</th>
                        <th>Adresse</th>
                        <th>Salaire</th>
                      </tr>
                      <!--<div id="table_employe">-->
                     <?php
                    // $op=$_GET["action"];
                     
                     $emp = $bdd->query("SELECT employes.id,employes.numero as numero,nom,adresse,(nbheure*taux) as salaire FROM employes,travail,entreprise where employes.numero=travail.numero_employe AND travail.numero_entreprise=entreprise.numero AND entreprise.id=".$_GET["entr"]);
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
                          <?php echo $rep_emp["salaire"];?>
                        </td>
                        
                      </tr>
                      <?php
                       }                       
                      ?>
                      <!-- </div>-->
                    </tbody>
                  </table>
                
