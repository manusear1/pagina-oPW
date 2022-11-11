<style>
a{
		padding: : 2px;
		border: 1px solid gray;
		display: inline-block;
		background-color: gray;
}
.atual{background-color: red;}
</style>
<?php
$con= new mysqli('localhost','root','', 'exercicio');
if(!$con){
	echo "Não sabe criar uma conexão?";
}

$pp = 25;
$sql = 'SELECT * FROM cidades';
$res = $con->query($sql);
$total = $res->num_rows;
$pags = ceil ($total/$pp);

$atual = isset($_GET['pag']) ? $_GET['pag'] : 1;
$atual = ($pp*$atual-$pp);

$sql = "SELECT * FROM cidades LIMIT $atual, $pp";
$res = $con->query($sql);

while($c = $res->fetch_object()){
	echo $c->id.') '.$c->nome.'<br>';
}
echo '<hr>'; 

$atual = isset($_GET['pag']) ? $_GET['pag'] : 1;
$inicio = ($atual-5) >=1 ? $atual-5 : 1;
$fim = ($atual+5) <=$pags ? $atual+5 : $pags;

for($i=$inicio;$i<=$fim;$i++){
	$class = ($i == $atual) ? "atual" : "";
	echo '<a href="?pag='.$i.'" class="'.$class.'">'.$i.'</a> ';
}
