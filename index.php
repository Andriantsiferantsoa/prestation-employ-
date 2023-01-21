
<?php
require_once("DBconnexion.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestion de préstation des employés</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Gestion</b> de prestation</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
  </header>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Projet L2 PRO</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Administration</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" id="employe"><i class="fa fa-circle-o"></i> Employés</a></li>
                <li><a href="#" id="entreprise"><i class="fa fa-circle-o"></i> Entreprises</a></li>
                <li><a href="#" id="travail"><i class="fa fa-circle-o"></i> Travails</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Heure de travail</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" id="nb_heure"><i class="fa fa-circle-o"></i> Recherche d'employé</a></li>
                
                
              </ul>
            </li>
            
           
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
        
<!-- ajout d'employer -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ajout_emp" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Ajout d' un employé</h4>
                  </div>
                    <div class="modal-body">
                      <div class="box box-primary">
               
                <form role="form" id="form_emp" action="#" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                          <div class="form-group">
                              <label>Numero </label>
                              <input type="text" class="form-control" id="numero" placeholder="Numero de l'employe">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputPassword1">Nom </label>
                              <input type="text" class="form-control" id="nom" placeholder="Nom de l'employé">
                          </div>
                          <div class="form-group">
                            <label>Adresse </label>
                            <input type="text" class="form-control" id="adresse" placeholder="Adresse">
                          </div><!-- /.box-body -->
                          </div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                          </div>
                </form>
                        </div><!-- /.box -->
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- general form elements -->
            </div><!-- /.box-body -->
            <!--fin ajout employes-->

<!--ajout entreprise-->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ajout_entr" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Ajout d'entreprise</h4>
                  </div>
                  <div class="modal-body">
                   <div class="box box-primary">
              
              <form role="form" id="form_entr" action="#" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Numero </label>
                      <input type="text" class="form-control" id="numero_entr" placeholder="Numero de l'entreprise">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Désignation</label>
                      <input type="text" class="form-control" id="design" placeholder="Nom de l'entreprise">
                    </div><!-- /.box-body -->
                  </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                    </div>
              </form>
                    </div><!-- /.box -->
                  </div>
               </div><!-- /.modal-content -->
             </div><!-- general form elements -->
          </div><!-- /.box-body -->
          <!--fin ajout entreprise-->

<!--ajout travail-->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ajout_trav" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Ajout de travail</h4>
                  </div>
                  <div class="modal-body">
                   <div class="box box-primary">
               
              <form role="form" id="form_trav" action="#" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Numero de l'employé</label>
                      <input type="text" class="form-control" id="numero_empT" placeholder="Numero de l'employe">
                    </div>
                    <div class="form-group">
                      <label>Numero d'entreprise</label>
                      <input type="text" class="form-control" id="numero_entrT" placeholder="Numero de l'entreprise">
                    </div>
                    <div class="form-group">
                      <label>Date d'embauche</label>
                      <input type="date" class="form-control" id="date_emb">
                    </div>
                    <div class="form-group">
                      <label>Nombre d'heure</label>
                      <input type="number" class="form-control" id="nb_heure" placeholder="nombre d'heure">
                    </div>
                    <div class="form-group">
                      <label>Taux horaire</label>
                      <input type="text" class="form-control" id="taux" placeholder="taux horaire">
                    </div><!-- /.box-body -->
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                  </div>
                </form>
                  </div><!-- /.box -->
                </div>
              </div><!-- /.modal-content -->
             </div><!-- general form elements -->
          </div><!-- /.box-body -->
          <!--fin ajout travail-->
              
<!-- modification employes -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_emp" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modif_emp"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Modification des renseingnements sur l'employé</h4>
                  </div>
                  <div class="modal-body">
                    <div class="box box-primary">
               
                <form role="form" id="form_emp_modif" action="#" method="post" enctype="multipart/form-data">
                      <div class="box-body">
                        <input type="hidden" id="modif_hide_emp" name="" value="">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Numero </label>
                          <input type="text" class="form-control" id="numero_modif" placeholder="Numero de l'employe">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nom </label>
                          <input type="text" class="form-control" id="nom_modif" placeholder="Nom de l'employé">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Adresse</label>
                          <input type="text" class="form-control" id="adresse_modif" placeholder="Adresse">
                        </div><!-- /.box-body -->
                      </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                        </div>
                </form>
                    </div><!-- /.box -->
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- general form elements -->
          </div><!-- /.box-body -->
          <!--fin modification employes-->        

<!-- modification entreprise -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_entr" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modif_entr"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Modification des renseingnements sur l'entreprise</h4>
                  </div>
                  <div class="modal-body">
                    <div class="box box-primary">
               
                <form role="form" id="form_entr_modif" action="#" method="post" enctype="multipart/form-data">
                      <div class="box-body">
                        <input type="hidden" id="modif_hide_entr" name="" value="">
                        <div class="form-group">
                          <label>Numero </label>
                          <input type="text" class="form-control" id="numero_modiff" placeholder="Numero de l'entreprise">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Désignation</label>
                          <input type="text" class="form-control" id="design_modif" placeholder="Nom de l'entreprise">
                        </div>   
                      </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                        </div>
                </form>
                    </div><!-- /.box -->
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- general form elements -->
          </div><!-- /.box-body -->
          <!--fin modification entreprise-->        

<!-- modification travail -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_trav" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modif_trav"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Modification des renseingnements sur le travail</h4>
                  </div>
                  <div class="modal-body">
                    <div class="box box-primary">
               
                <form role="form" id="form_trav_modif" action="#" method="post" enctype="multipart/form-data">
                      <div class="box-body">
                        <input type="hidden" id="modif_hide_trav" name="" value="">
                        <div class="form-group">
                          <label>Numero de l'employé</label>
                          <input type="text" class="form-control" id="numero_empT_modif" placeholder="Numero de l'employe">
                        </div>
                        <div class="form-group">
                          <label>Numero d'entreprise</label>
                          <input type="text" class="form-control" id="numero_entrT_modif" placeholder="Numero de l'entreprise">
                        </div>
                        <div class="form-group">
                          <label>Date d'embauche</label>
                          <input type="date" class="form-control" id="date_emb_modif">
                        </div>
                        <div class="form-group">
                          <label>Nombre d'heure</label>
                          <input type="number" class="form-control" id="nb_heure_modif" placeholder="nombre d'heure">
                        </div>
                        <div class="form-group">
                          <label>Taux horaire</label>
                          <input type="text" class="form-control" id="taux_modif" placeholder="taux horaire">
                        </div><!-- /.box-body -->
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                      </div>
                </form>
                    </div><!-- /.box -->
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- general form elements -->
          </div><!-- /.box-body -->
          <!--fin modification travail-->        

<!--suppression d'employes-->
         <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="suppr_emp" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_suppr_emp"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">suppression de l'employé dans la liste</h4>
                  </div>
                  <div class="modal-body">
                    <div class="box box-primary">

              <form role="form" id="form_emp_suppr" action="#" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <input type="hidden" id="suppr_hide_emp" name="" value="">
                    Voulez-vous vraiment retirer cet employé de la liste?
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger btn-block" id="">OUI</button>
                    
                  </div>
              </form>
                  <button class="btn btn-primary btn-block" onclick="$('#close_suppr_emp').click();">NON</button>
                    </div><!-- /.box -->
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- general form elements -->
            </div><!-- /.box-body -->
            <!--fin suppression employe-->  

<!--suppression d'entreprise-->
         <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="suppr_entr" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_suppr_entr"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">suppression de l'employé dans la liste</h4>
                  </div>
                  <div class="modal-body">
                    <div class="box box-primary">

              <form role="form" id="form_entr_suppr" action="#" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <input type="hidden" id="suppr_hide_entr" name="" value="">
                    Voulez-vous vraiment retirer cette entreprise de la liste?
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger btn-block" id="">OUI</button>
                    
                  </div>
              </form>
                  <button class="btn btn-primary btn-block" onclick="$('#close_suppr_entr').click();">NON</button>
                    </div><!-- /.box -->
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- general form elements -->
            </div><!-- /.box-body -->
         <!--fin suppression entreprise-->  

<!--suppression de travail-->
<!--suppression d'entreprise-->
         <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="details" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modif_trav"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="desin_entr">Lise des employés dans l'entreprise</h4>
                  </div>
                  <div class="modal-body">
                    <div class="box box-primary">
               
                <form role="form" id="form_trav_modif" action="#" method="post" enctype="multipart/form-data">
                      <div class="box-body" id="liste_empl">
                      </div>
                       <div class="box-footer">
                    <div class="form-group">
                          <label>Nombre d'employé: </label>
                          <input type="text" class="form-control" id="nombre_emp" placeholder="Nombre d'employé" readonly="true">
                        </div>
                        <div class="form-group">
                          <label>Salaire total: </label>
                          <input type="text" class="form-control" id="salaire_tot" placeholder="Salaire total" readonly="true">
                        </div>
                  </div>
                </form>
                    </div><!-- /.box -->
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- general form elements -->
          </div><!-- /.box-body -->
         <!--fin suppression entreprise-->  

<!--suppression de travail-->
         <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="suppr_trav" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_suppr_trav"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">suppression de travail dans la liste</h4>
                  </div>
                  <div class="modal-body">
                    <div class="box box-primary">

              <form role="form" id="form_trav_suppr" action="#" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <input type="hidden" id="suppr_hide_trav" name="" value="">
                    Voulez-vous vraiment retirer ce travail de la liste?
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger btn-block" id="">OUI</button>
                  </div>
              </form>
                  <button class="btn btn-primary btn-block" onclick="$('#close_suppr_trav').click();">NON</button>
                    </div><!-- /.box -->
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- general form elements -->
            </div><!-- /.box-body -->
         <!--fin suppression travail-->  
       
      <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper" id="vatany">
        
                </div>
                <!-- /.content-wrapper -->
      
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2018<a href="http://almsaeedstudio.com">Projet Mr Venot</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="script.js"></script>
  </body>
</html>
