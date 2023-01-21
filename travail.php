<?php 
require_once("DBconnexion.php");
?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           GESTION DE TRAVAIL
            <small>Administration</small>
          </h1>
          <ol class="breadcrumb">
            <li><a data-toggle="modal" href="#ajout_trav"><i class="fa fa-dashboard"></i> 
              <div class="btn-group-vertical">
                  <button type="button" class="btn btn-success">+</button>
                          
              </div>
            </a></li>
            <li class="active"><a href="#">Liste</a></li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-lg-12">
              </div><!-- /.box -->
            </div><!--/.col (right) -->

<div class="col-lg-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Liste des travails</h3>
                </div><!-- /.box-header -->
                
                <!--affichage liste travail-->
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
                      <?php
                       $trav = $bdd->query("SELECT * FROM travail ORDER BY date DESC");
                       while($rep_trav = $trav->fetch())
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

                      </tbody>
                    </table>
                  </div><!-- /.box-body -->
                  <!--fin affichage liste travail-->
                
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
        
//modifier travail fangalana id
      $(".Modifi").on("click",function(){
      $.ajax({
          type: 'POST',
          data: { 
                  action: "affiche_trav",
                  id: $(this).attr('id').replace("Modifi","")
                },

          url: 'script.php',
          dataType: 'json',
            //async: false,
            
          success: function(rep)
                  {
                    $("#modif_hide_trav").val(rep.id);
                    $("#numero_empT_modif").val(rep.numero_employe);
                    $("#numero_entrT_modif").val(rep.numero_entreprise);
                    $("#date_emb_modif").val(rep.date);
                    $("#nb_heure_modif").val(rep.nbheure);
                    $("#taux_modif").val(rep.taux);
                  },
       
           error: function(jqXHR, textStatus, errorThrown)
                 {
                    console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                    alert('Error! '+textStatus);
                 }
            });
      });
        
        //formulaire anovana anazy
        $("#form_trav_modif").on("submit",function(event){
            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening
            $.ajax({
                type: 'POST',
                data: { 
                        action: "modif_trav",
                        numero_employe: $("#numero_empT_modif").val(),
                        numero_entreprise: $("#numero_entrT_modif").val(),
                        date: $("#date_emb_modif").val(),
                        nbheure: $("#nb_heure_modif").val(),
                        taux: $("#taux_modif").val(),
                         id: $("#modif_hide_trav").val()
                      },
                url: 'script.php',
                dataType: 'json',
                async: false,
                success: function(rep)
                        {
                         //alert(rep.succes);
                         $(".close").click();
                         $("#travail").click();
                        },
                 error: function(jqXHR, textStatus, errorThrown)
                         {
                            console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                            alert('Error! '+textStatus);
                         }
                  });
          });
        //fin modification travail mandeh

//supprimer travail
    $(".Supprim").on("click",function(){
          $("#suppr_hide_trav").val($(this).attr("id").replace("Supprim",""));
    });

    $("#form_trav_suppr").on("submit",function(event){
        event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening
             //alert("tafiditra");
        $.ajax({
            type: 'POST',
            data: { 
                    action: "fafana",
                    id: $("#suppr_hide_trav").val(),
                    type: "trav"
                  },
            url: 'script.php',
            dataType: 'json',
            async: false,
            success: function(rep)
                  {
                 //alert(rep.succes);
                      $(".close").click();
                      $("#travail").click();
                  },
            error: function(jqXHR, textStatus, errorThrown)
                  {
                       console.log(jqXHR, textStatus, errorThrown); //Check with Chrome or FF to see all these objects and decide what you want to display
                       alert('Error! '+textStatus);
                   }
            });
         });
        //fin suppression travail
</script>