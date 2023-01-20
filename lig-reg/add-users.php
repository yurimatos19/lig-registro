<h1>lista de problemas</h1>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<html lang="pt-br">
<img src="logo_hotlink.png" alt="Minha Figura" width=200 px>
<form method="post">
    <div class="form-group">
        <label>Nome <span class="text-danger">*</span></label>
        <input type="text" name="nome" id="nome" class="form-control" placeholder="coloque o seu nome" required>
    </div>
    <div class="form-group">
        <label>problemas <span class="text-danger">*</span></label>
        
        <select name="problemas" id="problemas" required>
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
        <option value="link dedicado">link dedicado</option></select>
    </div>
    <div class="form-group">
        <label>DATA <span class="text-danger">*</span></label>
        <input type="date" name="dia" id="dia" max="<?= date('Y-m-d'); ?>" class="form-control" placeholder="digite a data" required>
    </div>
    <div class="form-group">
        <label>inicio<span class="text-danger">*</span></label>
        <input type="time" name="inicio" id="inicio" class="form-control" placeholder="digite o horario de inicio" required>
    </div>
    <div class="form-group">
        <label>final<span class="text-danger">*</span></label>
        <input type="time" name="fim" id="fim" class="form-control" placeholder="digite o horario de final" required>
</div>
    <div class="form-group">
        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> adicionar problema</button>
    </div>
</form>
<a
href="browser-users.php">buscar problema já cadastrado</a>
<a href="google_graficos.php">analise graficamente</a>
<?php

require_once "config.php"; 

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
    extract($_REQUEST);
    if($nome==""){
        header('location:'.$_SERVER['PHP_SELF'].'?msg=un');
        exit;
    }elseif($problemas==""){
        header('location:'.$_SERVER['PHP_SELF'].'?msg=up');
        exit;
    }elseif($dia==""){
        header('location:'.$_SERVER['PHP_SELF'].'?msg=ud');
        exit;
    }elseif($inicio==""){
        header('location:'.$_SERVER['PHP_SELF'].'?msg=ui');
        exit;    }
    elseif($fim==""){
        header('location:'.$_SERVER['PHP_SELF'].'?msg=uf');
        exit;
    }else{
        $data   =   array(
                        'nome'=>$nome,
                        'problemas'=>$problemas,
                        'dia'=>$dia,
                        'inicio'=>$inicio,
                        'fim'=>$fim
                        );
     if( $inicio>$fim){
       echo "inicio maior que final,tente novamente";
     } else{
        
        $insert =   $db->insert('problema',$data);}
        if($insert){
            header('location:'.$_SERVER['PHP_SELF'].'?msg=ras');
            exit;
        }else{
            header('location:'.$_SERVER['PHP_SELF'].'?msg=rna');
            exit;
        }
    }
}
?>
<?php
if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){
    echo    '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>nome é obrigatorio!</div>';
}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){
    echo    '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> problema é obrigatorio!</div>';
}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ui"){
    echo    '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Horario de inicio é obrigatorio!</div>';
}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ud"){
    echo    '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Data é obrigatorio!</div>';
}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
    echo    '<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> adicionado com sucesso!</div>';
}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="uf"){
    echo    '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Horario de final é obrigatorio!</div>';
}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
    echo    '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> não adicionado <strong>Please try again!</strong></div>';
}
?>