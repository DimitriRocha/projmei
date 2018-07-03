<?php include '_config/debug.php'; ?>
<?php 
	include '_class/conexao.php';
	include '_class/consultas.php';
	$consulta = new Consultas($DB_con);

	echo 'Bem-Vindo Ao Seu Perfil'."<br>".$login->user();
?>

<head>
	<style type="text/css">

		td, th {
		    border: 1px solid #dddddd;
		    text-align: center;
		    padding: 8px;
		}

		tr:nth-child(even) {
		    background-color: #dddddd;
		}

		#table{
		  height: 50vh;
		  width: 100vw;

		  display: flex;
		  justify-content: left;
		  align-items: center;

		  font-size: 20px;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="_css/chatStyle.css">
</head>

<br><br><a href="chatindex.php" class="btn btn-primary">Retornar ao Chat</a><br>

<h3>Dados pessoais</h3>

<div id="table">
  <table>
    <tr>
      <td>Nome</td>
      <td><?php echo $login->user(); ?></td>
    </tr>
    <tr>
      <td>CNPJ</td>
      <td><?php echo $login->userCnpj(); ?></td>
    </tr>
    <tr>
      <td>Área de atuação</td>
      <td><?php $consulta->AreaConsultoria(); ?></td>
    </tr>
      <tr>
      <td>Data da finalização do plano</td>
      <td><?php $consulta->MesesDeContrato()?></td>
    </tr>
  </table>
</div>

