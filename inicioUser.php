<?php 
	include '_class/conexao.php';
	include '_class/conection.php';
	include '_class/userDashboard.php';

	if (!$login->islogin()) { //Caso o usuário não esteja logado
		print_r('Hello old pal');
		die();
	 	header('Location: entrar.php'); //Redireciona ele para a pagina de login
	}
	$dash = new UserDashboard($_SESSION['user']);
	$casos = $dash->getCasosAbertos();
	$lastMessage = $dash->getLastMessage();
?>
<script>
	//var consultorId = <?php //echo $_SESSION['consultor'] ?>;
</script>

<head>
	<!-- FAVICONS -->
	<link rel="apple-touch-icon" sizes="144x144" href="favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
	<link rel="manifest" href="favicons/manifest.json">
	<link rel="mask-icon" href="favicons/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#000000">
	<!-- FIM DOS FAVICONS -->
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="_js/inicioUser.js"></script>
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
				Bem vindo <?php echo ucfirst($_SESSION['userName']) ?>
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
	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>Visão Geral</b>
			</div>
			<div class="panel-body">
			</div>
		</div>
	</div>
</div>

<div id="meusCasos" class="contentWrapper">
	<div class="col-md-10 content">
		<?php foreach($dash::areas as $key => $area): ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<b><?php echo $area ?></b>
			</div>
			<!-- adicionar condicional para aparecer apenas caso ele tenha assinatura -->
			<div class="panel-body">
				<table class="table">
					<thead>
						<th>Id</th>
						<th>Atribuido</th>
						<th>Data de abertura</th>
						<th>Data de fechamento</th>
						<th>Status</th>
						<th>Ações</th>
					</thead>
					<tbody>
					<?php foreach($casos as $caso): ?>
						<?php if(isset($caso['ed_id']) && $caso['ed_id'] == $key): ?>
							<tr>
								<td><?php echo $caso['ass_id'] ?></td>  
								<td><?php echo ($caso['con_id'] != null ? '<i class="glyphicon glyphicon-ok"></i>' : '<i class="glyphicon glyphicon-remove"></i>'); ?></td>  
								<td>
									<?php
									$dateStart = new DateTime($caso['ass_start'] );
									echo date_format($dateStart, 'H:i d/m/Y');
									?>
								</td>  
								<td>
									<?php 
									if(isset($caso['ass_end']) && $caso['ass_end'] != null){
										$dateFim = new DateTime($caso['ass_end']);
										echo date_format($dateFim, 'H:i d/m/Y');
									}else{
										echo '---';
									}
									?>
								</td>  
								<td><?php echo $caso['status'] == 0 ? "Aberto" : "Fechado"; ?></td>
								<td><a href=""><i class="glyphicon glyphicon-comment"></i></a></td>  
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php endforeach; ?>
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
