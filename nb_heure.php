
<?php
require_once("DBconnexion.php");
?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           HEURE DE TRAVAIL
            <small>Administration</small>
            <div class="input-group">

            </div>
          </h1>
          <!--<ol class="breadcrumb">
            <li><a data-toggle="modal" href="#ajout_emp"><i class="fa fa-dashboard"></i> 
              <div class="btn-group-vertical">
                  <button type="button" class="btn btn-success">+</button>
                          
              </div>
            </a></li>
            <li class="active"><a href="#">Liste</a></li>
            
          </ol>-->
        </section>
<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Recherche d'employé</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" id="nb_h">
                  <div class="box-body">
                    <div class="form-group">
                      
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="num_entreprise" placeholder="Numero d'entreprise">
                      </div>
                      <label for="inputEmail3" class="col-sm-2 control-label">Numero d'entreprise</label>
                    </div>
                    <div class="form-group">
                      <!--<label for="inputPassword3" class="col-sm-2 control-label">Année</label>-->
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="date1" placeholder="date">
                        
                      </div>
<label for="inputPassword3" class="col-sm-2 control-label">Année</label>
                    </div>
                    <div class="form-group">
                      
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="date2" placeholder="date">
                        
                      </div>
                      <label for="inputPassword3" class="col-sm-2 control-label">Année</label>
                    </div>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                    <button type="submit" class="btn btn-info" id="nb_button">Rechercher</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
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
                  <h3 class="box-title">Liste des Entreprises</h3>
                </div><!-- /.box-header -->
                
                <!--affichage liste des entreprises-->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 120px">Numero</th>
                        <th style="width: 450px">Désignation</th>
                        <th>Action</th>
                      </tr>
                      <?php
                   $entr = $bdd->query("SELECT * FROM entreprise ORDER BY id DESC");
                   while($rep_entr = $entr->fetch())
                   {
                   ?> 
                      <tr>
                        <td><?php echo $rep_entr["id"];?>.</td>
                        <td><?php echo $rep_entr["numero"];?></td>
                        <td>
                          <?php echo $rep_entr["design"];?>
                        </td>
                        <td>
                          <div class="btn-group">
                                       
                                        <a class="btn btn-success Modifie" href="#modif_entr" data-toggle="modal" id="Modifie<?php echo $rep_entr["id"];?>"><i class="icon_check_alt2"></i>Modifier</a>
                                        <a class="btn btn-danger Supprime" href="#suppr_entr" data-toggle="modal" id="Supprime<?php echo $rep_entr["id"];?>"><i class="icon_close_alt2"></i>Supprimer</a>
                          </div>
                        </td>
                      </tr>
                      <?php
                       }
                       ?>
                       </tbody>
                  </table>
                </div><!-- /.box-body -->
                <!-- fin affichage liste des entreprises-->
                
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
        
//modifier entreprise
        $(".Modifie").on("click",function(){
        $.ajax({
              type: 'POST',
              data: { 
                      action: "affiche_entr",
                      id: $(this).attr('id').replace("Modifie","")
                    },
              url: 'script.php',
              dataType: 'json',
            //async: false,
            
            success: function(rep)
              {
                  $("#modif_hide_entr").val(rep.id);
                  $("#numero_modiff").val(rep.numero);
                  $("#design_modif").val(rep.design);
                 
              },
       
            error: function(jqXHR, textStatus, errorThrown){
                  console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                  alert('Error! '+textStatus);
                  }
                });
          });
        
        //affichage n fanovana anazy
        $("#form_entr_modif").on("submit",function(event){
          event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening
            $.ajax({
                type: 'POST',
                data: { 
          
                    action: "modif_entr",
                    design: $("#design_modif").val(),
                    numero: $("#numero_modiff").val(),
                    id: $("#modif_hide_entr").val()
              
                       },
                url: 'script.php',
                dataType: 'json',
                async: false,
                success: function(rep)
                  {
                   //alert(rep.succes);
                   $(".close").click();
                   $("#entreprise").click();
                  },
                 error: function(jqXHR, textStatus, errorThrown)
                         {
                            console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                            alert('Error! '+textStatus);
                  }
                });
            
        });
        //fin modification entreprise

//suppression entreprise
      $(".Supprime").on("click",function(){
           $("#suppr_hide_entr").val($(this).attr("id").replace("Supprime",""));
      });


       $("#form_entr_suppr").on("submit",function(event){
            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening
             //alert("tafiditra");
            $.ajax({
                type: 'POST',
                data: { 
          
                        action: "fafana",
                        id: $("#suppr_hide_entr").val(),
                        type: "entr"
                  
                      },
                url: 'script.php',
                dataType: 'json',
                async: false,
                success: function(rep)
                        {
                         //alert(rep.succes);
                         $(".close").click();
                         $("#entreprise").click();
                        },
                 error: function(jqXHR, textStatus, errorThrown)
                         {
                            console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                            alert('Error! '+textStatus);
                          }
            });
        });
        //fin suppression
$("#nb_h").on("submit",function(event)
{
  event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening
});
$("#nb_button").on("click",function()
{
    
    //alert("iniy");
   //$("#steph").load("search_nb_heure.php");
   $("#steph").load("search_nb_heure.php?entr="+$("#num_entreprise").val()+"&date1="+$("#date1").val()+"&date2="+$("#date2").val());
});
        
</script>