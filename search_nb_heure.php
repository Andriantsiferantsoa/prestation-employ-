
<?php
require_once("DBconnexion.php");
$entr=$_GET['entr'];
//$search = str_replace($_GET['search'],"'",""); 
$date1 = $_GET['date1'];
$date2 = $_GET['date2'];
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
                        <th style="width: 130px">Numero employé</th>
                        <th style="width: 130px">Numero entreprise</th>
                        <th style="width: 150px">date de'embauche</th>
                        <th style="width: 120px">Nombre d'heures</th>
                        <th style="width: 120px">Taux horaire</th>
                        <th>Action</th>
                      </tr>
                      <!--<div id="table_employe">-->
                     <?php
                    // $op=$_GET["action"];
                     
                     $emp = $bdd->query("SELECT * FROM travail where numero_entreprise='".$entr."' AND nbheure >= 1 AND  date>'".$date1."'  and date < '".$date2."'");
                     while($rep_trav = $emp->fetch())
                     {
                     ?> 
                      <tr>
                         <td><?php echo $rep_trav["id"];?>.</td>
                          <td><?php echo $rep_trav["numero_employe"];?></td>
                          <td>
                            <?php echo $rep_trav["numero_entreprise"];?>
                          </td>
                          <td>
                            <?php echo $rep_trav["date"];?>
                          </td>
                          <td>
                            <?php echo $rep_trav["nbheure"];?>
                          </td>
                          <td>
                            <?php echo $rep_trav["taux"];?>
                          </td>
                          <td>
                            <div class="btn-group">
                                         
                                          <a class="btn btn-success Modifi" href="#modif_trav" data-toggle="modal" id="Modifi<?php echo $rep_trav["id"];?>"><i class="icon_check_alt2"></i>Modifier</a>
                                          <a class="btn btn-danger Supprim" href="#suppr_trav" data-toggle="modal" id="Supprim<?php echo $rep_trav["id"];?>"><i class="icon_close_alt2"></i>Supprimer</a>
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
