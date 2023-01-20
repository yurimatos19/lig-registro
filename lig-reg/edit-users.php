<?php
 include_once('config.php');

    if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
        $row    =   $db->getAllRecords('problema','*',' AND id="'.$_REQUEST['editId'].'"');
    }
     
    if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
        extract($_REQUEST);
        if($nome==""){
            header('location:'.$_SERVER['PHP_SELF'].'?msg=un&editId='.$_REQUEST['editId']);
            exit;
        }elseif($problemas==""){
            header('location:'.$_SERVER['PHP_SELF'].'?msg=up&editId='.$_REQUEST['editId']);
            exit;
        }elseif($dia==""){
            header('location:'.$_SERVER['PHP_SELF'].'?msg=ud&editId='.$_REQUEST['editId']);
            exit;
        }
        elseif($inicio==""){
        header('location:'.$_SERVER['PHP_SELF'].'?msg=ui&editId='.$_REQUEST['editId']);
        exit;
       }elseif($fim==""){
        header('location:'.$_SERVER['PHP_SELF'].'?msg=uf&editId='.$_REQUEST['editId']);
        exit;
       }
        $data   =   array(
            'nome'=>$nome,
            'problemas'=>$problemas,
            'dia'=>$dia,
            'inicio'=>$inicio,
            'fim'=>$fim
            );
        $update =   $db->update('problema',$data,array('id'=>$editId));
        if($update){
            header('location: browse-users.php?msg=rus');
            exit;
        }else{
            header('location: browse-users.php?msg=rnu');
            exit;
        }
    }
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="col-sm-6">
    <h5 class="card-title">os campos  <span class="text-danger">*</span> são obrigatorios</h5>
    <form method="post">
        <div class="form-group">
            <label>nome <span class="text-danger">*</span></label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo $row[0]['nome']; ?>" placeholder="coloque o seu nome" required>
        </div>
        <div class="form-group">
                    <label>problema</label>
                    <select name="problemas" id="problemas">
                    <option disabled selected value> -- selecione um problema -- </option>
                    <option value="email">E-mail</option>
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
            
        <div class="form-group">
            <label>dia<span class="text-danger">*</span></label>
            <input type="date" name="dia" id="dia" maxlength="12" class="form-control" value="<?php echo $row[0]['dia']; ?>" placeholder="coloque o dia" required>
        </div>
        <div class="form-group">
            <label>inicio <span class="text-danger">*</span></label>
            <input type="time" name="inicio" id="inicio" maxlength="12" class="form-control" value="<?php echo $row[0]['inicio']; ?>" placeholder="coloque o horario de inicio" required>
        </div>
        <div class="form-group">
            <label>fim<span class="text-danger">*</span></label>
            <input type="time" name="fim" id="fim" maxlength="12" class="form-control" value="<?php echo $row[0]['fim']; ?>" placeholder="coloque o horario de termino" required>
        </div>
        <div class="form-group">
            <input type="hidden" name="editId" id="editId" value="<?php echo $_REQUEST['editId']?>">
            <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> atualizar problema</button>
        </div>
    </form>
</div>