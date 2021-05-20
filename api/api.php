<?php
include_once('conexao.php');

// variável que recebe o conteúdo da requisição do app decodificando-a
$postjson = json_decode(file_get_contents('php://input'), true);
//var_dump($postjson);

if($postjson['requisicao']=='add'){
    $query = $pdo->prepare("INSERT INTO usuarios SET nome=:nome, email=:email, telefone=:telefone, cidade=:cidade, cpf=:cpf");
    $query->bindValue(":nome",$postjson['nome']);
    $query->bindValue(":email",$postjson['email']);
    $query->bindValue(":telefone",md5($postjson['telefone']));
    $query->bindValue(":cidade",$postjson['cidade']);
    $query->bindValue(":cpf",$postjson['cpf']);
    $query->execute();
    $id  = $pdo->lastInsertId();

    if($query){
        $result = json_encode(array('success'=>true,'id'=>$id));
    }else{
        $result = json_encode(array('success'=>false,'msg'=>'Falha ao inserir usuário.'));
    }
    echo $result;
//
}//final da requisição ADD
else if($postjson['requisicao']=='listar'){
    if($postjson['nome'] == ''){                                                      
        $query = $pdo->query("SELECT * FROM usuarios order by id desc limit $postjson[start], $postjson[limit]");
    }else{
        $busca = $postjson['nome'].'%';
        $query = $pdo->query("SELECT * FROM usuarios WHERE nome LIKE '$busca' or usuario LIKE '$busca' order by id desc limit $postjson[start], $postjson[limit]");
    }
    $res  = $query->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0; $i < count($res); $i++) { 
        foreach ($res[$i] as $key => $value) { 
        }
        $dados[] = array(
            'id'=> $res[$i]['id'],
            'nome'=> $res[$i]['nome'],
            'email'=> $res[$i]['email'],
            'telefone'=> $res[$i]['telefone'],
            'cidade'=> $res[$i]['cidade'],
            'cpf'=> $res[$i]['cpf']
        );
    } 
    if (count($res) > 0){
        $result = json_encode(array('success'=>true, 'result'=>$dados));
    }else{
        $result = json_encode(array('success'=>false, 'result'=>'0'));
        
    }
    echo $result;

}//final da requisição LISTAR
elseif($postjson['requisicao']=='editar'){
//
}//final da requisição EDITAR
elseif($postjson['requisicao']=='atualizar'){
//
}//final da requisição ATUALIZAR
elseif($postjson['requisicao']=='excluir'){
//
}//final da requisição EXCLUIR
elseif($postjson['requisicao']=='login'){
    $query = $pdo->query("SELECT * FROM usuarios where usuario = '$postjson[usuario]' and senha = md5('$postjson[senha]')");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0; $i < count($res); $i++) { 
        foreach ($res[$i] as $key => $value) { 
        }
        $dados = array(
            'id'=> $res[$i]['id'],
            'nome'=> $res[$i]['nome'],
            'email'=> $res[$i]['email'],
            'telefone'=> $res[$i]['telefone'],
            'cidade'=> $res[$i]['cidade'],
            'cpf'=> $res[$i]['cpf']
        );
    if (count($res) > 0){
        $result = json_encode(array('success'=>true, 'result'=>$dados));
    }else{
        $result = json_encode(array('success'=>false, 'msg'=>'Dados Incorretos para Usuaário na API TI89'));
        
    }
    echo $result;
?>