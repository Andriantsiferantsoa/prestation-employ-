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
          <div class="row">
            <!-- left column -->
            <div class="col-lg-12">
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Ajout de travail</h4>
                  </div>
                  <div class="modal-body">
                   <div class="box box-primary">
               
                <!-- form start -->
                <form role="form">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero d'employé</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Numero de l'employe">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero d'entreprise</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Numero de l'entreprise">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Date d'embauche</label>
                      <input type="date" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nombre d'heure</label>
                      <input type="number" class="form-control" id="exampleInputPassword1" placeholder="nombre d'heure">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Taux horaire</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="taux horaire">
                    </div><!-- /.box-body -->
<!-- liste employe--> 
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                  </div>
                </form>
              </div><!-- /.box -->
                  </div>
                 
                </div><!-- /.modal-content -->
              </div>
              <!-- general form elements -->
              

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->

<div class="col-lg-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Liste des travails</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th style="width: 10px">#</th>
                      <th style="width: 120px">Numero</th>
                      <th style="width: 450px">Travail</th>
                      
                      <th>Action</th>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>Update software</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                      <td>
                        <div class="btn-group">
                                     
                                      <a class="btn btn-success" href="#"><i class="icon_check_alt2"></i>Modifier</a>
                                      <a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i>Supprimer</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-yellow">70%</span></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Cron job running</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-light-blue">30%</span></td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Fix and squish bugs</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-green">90%</span></td>
                    </tr>
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