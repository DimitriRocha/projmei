<?php 
	include '_class/conexao.php';
	include '_class/conection.php';
	include '_class/consultas.php';
	include '_class/consultorDashboard.php';

	$consulta = new Consultas($DB_con);

	if (!$login->islogincon()) { //Caso o usuário não esteja logado
	 	header('Location: entrarConsultor.php'); //Redireciona ele para a pagina de login
	}

	$dash = new ConsultorDashboard($_SESSION['consultor']);
	$casosAbertos = $dash->casosAbertos();
	$meusCasos = $dash->meusCasos();
	$mensagem = $dash->mensagemConsultor();
?>
<script>
	var consultorId = <?php echo $_SESSION['consultor'] ?>;

</script>

<head>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="_js/inicioConsultor.js"></script>
	<link rel="stylesheet" href="_css/inicioConsultor.css">

</head>
<body>
	

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
			MENU
			</button>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				Bem vindo <?php echo ucfirst($_SESSION['consultorNome']) ?>
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						Conta
						<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li class="dropdown-header">CONFIGURAÇÕES</li>
							<li class="divider"></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>  	<div class="container-fluid main-container">
  		<div class="col-md-2 sidebar">
  			<div class="row">
	<!-- uncomment code for absolute positioning tweek see top comment in css -->
	<div class="absolute-wrapper"> </div>
	<!-- Menu -->
	<div class="side-menu">
		<nav class="navbar navbar-default" role="navigation">
			<!-- Main Menu -->
			<div class="side-menu-container">
				<ul class="nav navbar-nav">
					<li id="geral-btn" class="btn-selector active"><a href="#"><span class="glyphicon glyphicon-dashboard"></span> Visão Geral</a></li>
					<li id="meus-casos-btn" class="btn-selector"><a href="#"><span class="glyphicon glyphicon-align-justify"></span> Meus casos</a></li>
					<li id="perfil-btn" class="btn-selector"><a href="#"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
					<li>
						<a href="logout.php">
							<span class="glyphicon glyphicon-circle-arrow-left"></span><span> Sair</span>
						</a>
					</li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>

	</div>
</div>  		</div>

<div id="inicialContent" class="contentWrapper">
	<div  class="col-md-10 content">
	  	<div class="panel panel-default">
			<div class="panel-heading">
				<b>Mensagem</b>
			</div>
			<div class="panel-body">
				<?php echo $mensagem ?>
			</div>
		</div>
	</div>

	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>Casos abertos não atribuidos</b>
			</div>
			<div class="panel-body">
				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Nome cliente</th>
				      <th scope="col">Área do caso</th>
				      <th scope="col">Data de abertura</th>
				      <th scope="col">Status</th>
				      <th scope="col">Ações</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach($casosAbertos as $key => $caso): ?>
				    <tr>
				      <td><?php echo ucfirst($caso['user_name']) ?></td>
				      <td><?php echo ucfirst($caso['ed_nome']) ?></td>
				      <td>
				      	<?php 
					      	$date = new DateTime($caso['ass_start']);
					      	echo date_format($date, 'd/m/Y');
				      	?>
				      </td>
				      <td><?php echo ucfirst($caso['nome_status']) ?></td>
				      <td>
				      	<a 
				      	href="" 
				      	class="atribuirConsultor" 
				      	title="Atribuir caso a mim" 
				      	ass-id="<?php echo $caso['ass_id'] ?>"
				      	>
				      		<i class="glyphicon glyphicon-check"></i>
				      	</a>
				      </td>
				    </tr>
					<?php endforeach; ?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="meusCasos" class="contentWrapper">
	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>Meus casos</b>
			</div>
			<div class="panel-body">
				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Nome cliente</th>
				      <th scope="col">Área do caso</th>
				      <th scope="col">Data de abertura</th>
				      <th scope="col">Status</th>
				      <th scope="col">Ações</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach($meusCasos as $key => $caso): ?>
				    <tr>
				      <td><?php echo ucfirst($caso['user_name']) ?></td>
				      <td><?php echo ucfirst($caso['ed_nome']) ?></td>
				      <td>
				      	<?php 
					      	$date = new DateTime($caso['ass_start']);
					      	echo date_format($date, 'd/m/Y');
				      	?>
				      </td>
				      <td><?php echo ucfirst($caso['nome_status']) ?></td>
				      <td>
				      	<?php if($caso['status'] == 0): ?>
				      	<a class="abrirChat" title="Abrir chat" href="chatConsultor.php?id=<?php echo $caso['ass_id'] ?>">
				      		<i class="glyphicon glyphicon-comment"></i>
				      	</a>
				      	<a 
				      	title="Fechar caso" 
				      	href="" 
				      	class="fecharCaso" 
				      	ass-id="<?php echo $caso['ass_id'] ?>">
				      		<i class="glyphicon glyphicon-lock"></i>
				      	</a>
				      <?php endif; ?>
				      </td>
				    </tr>
					<?php endforeach; ?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="perfil" class="contentWrapper">
	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>Perfil</b>
			</div>
			<div class="panel-body">
				
			</div>
		</div>
	</div>

			</div>
	  		<footer class="pull-left footer">
	  			<p class="col-md-12">
	  				<hr class="divider">
	  				Copyright &COPY; 2018 <a href="">Praxis Jr</a>
	  			</p>
	  		</footer>
	  	</div>
	</body>
</div>
