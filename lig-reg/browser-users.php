<?php include_once('config.php');?>
<?php


$condition  =   '';
if(isset($_REQUEST['nome']) and $_REQUEST['nome']!=""){
    $condition  .=  ' AND nome LIKE "%'.$_REQUEST['nome'].'%" ';
}
if(isset($_REQUEST['problemas']) and $_REQUEST['problemas']!=""){
    $condition  .=  ' AND problemas LIKE "%'.$_REQUEST['problemas'].'%" ';
}
if(isset($_REQUEST['dia']) and $_REQUEST['dia']!=""){
    $condition  .=  ' AND dia LIKE "%'.$_REQUEST['dia'].'%" ';
}
if(isset($_REQUEST['inicio']) and $_REQUEST['inicio']!=""){
    $condition  .=  ' AND inicio LIKE "%'.$_REQUEST['ininio'].'%" ';
}
if(isset($_REQUEST['fim']) and $_REQUEST['fim']!=""){
    $condition  .=  ' AND fim LIKE "%'.$_REQUEST['fim'].'%" ';
}
    if(isset($_REQUEST['df']) and $_REQUEST['df']!=""){

    $condition  .=  ' AND DATE(dt)>="'.$_REQUEST['df'].'" ';

}
if(isset($_REQUEST['dt']) and $_REQUEST['dt']!=""){

    $condition  .=  ' AND DATE(dt)<="'.$_REQUEST['dt'].'" ';

}
$userData   =   $db->getAllRecords('problema','*',$condition);
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="col-sm-12">
<html lang="pt-br">
    <h5 class="card-title"><i class="fa fa-fw fa-search"></i> buscar o usuario</h5>
    <img src="logo_hotlink.png" alt="Minha Figura" width=200 px>
    <form method="get">
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?php echo isset($_REQUEST['nome'])?$_REQUEST['nome']:''?>" placeholder="pesquise pelo nome">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>problema</label>
                    <select name="problemas" id="problemas" >
                    <option disabled selected value> -- selecione um problema -- </option>
                    <option value="email hotlink">E-mail hotlink</option>
                    <option value="email dominio ">E-mail dominio</option>
                    <option value="ppoepj">PPOE PJ</option>
                    <option value="ppoepf">PPOE PF</option>
                    <option value="datacenter">Datacenter</option>
                    <option value="host">Hospedagem</option>
                    <option value="nosignal">sem sinal de antena</option>
                    <option value="romp">rompimento</option>
                    <option value="cabo_desconectado">cabo desconectado</option>
                    <option value="microtiscs">problema com os microtiscs</option>
                    <option value="redeinterna">rede interna do cliente</option>
                    <option value="cabdani">cabo danificado</option>
                    <option value="dados_ip">dados de ip</option>
                    <option value="cobrvisit">cobrando visita</option>
                    <option value="link dedicado">link dedicado</option></select  value="<?php echo isset($_REQUEST['problemas'])?$_REQUEST['problemas']:''?>" placeholder="pesquise pelo problema">
              
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>data</label>
                    <input type="date" name="dia" id="dia" class="form-control" value="<?php echo isset($_REQUEST['dia'])?$_REQUEST['dia']:''?>" placeholder="pesquise pelo dia">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>horario de inicio</label>
                    <input type="time" name="inicio" id="inicio" class="form-control" value="<?php echo isset($_REQUEST['inicio'])?$_REQUEST['inicio']:''?>" placeholder="pesquise pelo horario de inicio">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>horario final</label>
                    <input type="time"  name="fim" id="fim" class="form-control"<?php echo isset($_REQUEST['fim'])?$_REQUEST['fim']:''?>" placeholder="tente com a data final">
                </div>
            </div>
        
            <div class="clearfix"></div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label> </label>
                    <div>
                        <button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> buscar</button>
                        <a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i> limpar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="bg-primary text-white">
            <th>Sr#</th>
            <th>nome</th>
            <th>problema</th>
            <th>data</th>
            <th>inicio</th>
            <th>final</th>
            <th>tempo de ligação</th>
            <th class="text-center">Data de cadastro</th>
            <th class="text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(count($userData)>0){
            $s  =   '';
            foreach($userData as $val){
                $s++;
        ?>
        <tr>
            <td><?php echo $s;?></td>
            <td><?php echo $val['nome'];?></td>
            <td><?php echo $val['problemas'];?></td>
            <td><?php echo $val['dia'];?></td>
            <td><?php echo $val['inicio'];?></td>
            <td><?php echo $val['fim'];?></td>
   <?php
            $datai= (isset($_POST['inicio'])) ? $_POST['inicio'] : date_format("H:i");
            $inicio = new DateTime($val['inicio']);
            $fim = new DateTime($val['fim']);
            $intervalo = $inicio->diff($fim);
?>

         <td><?php echo "" .$intervalo->h." horas e ".$intervalo->i." minutos";?><td> 




            <td align="center"><?php echo date('Y-m-d H:i:s',strtotime($val['dt']));?></td>
            <td align="center">
                <a href="edit-users.php?editId=<?php echo $val['id'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
                <a href="delete.php?delId=<?php echo $val['id'];?>" class="text-danger" onClick="return confirm('Are you sure to delete this user?');"><i class="fa fa-fw fa-trash"></i> Deletar</a>
            </td>
 
        </tr>
        <?php
            }
        }else{
        ?>
        <tr><td colspan="6" align="center">registro não foi achado</td></tr>
        <?php } ?>
    </tbody>
</table>
<html>

<a
href="add-users.php">adicione problemas</a>
<a href="google_graficos.php">analise graficamente</a>