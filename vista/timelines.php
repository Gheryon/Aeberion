<?php
include 'config.php';
include 'serverFunctions.php';
//basado en https://www.w3schools.com/php/php_form_validation.asp para mayor seguridad
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if(!empty($_POST)){
		if(!empty($_POST['orden']))
		{
			$orden=test_input($_POST['orden']);
		}else{
			$orden="ASC";
		}
		
		if(!empty($_POST['lineaTemporal']))
		{
			$lineaTemporal=test_input($_POST['lineaTemporal']);
		}else{
			$lineaTemporal="Universal";
		}
	}
}else{
	$orden="DESC";
	$lineaTemporal="Universal";
}

include 'funcionesdb.php';
$pdo = new Database();
if($lineaTemporal=="Universal")
{
	$eventos = $pdo->getAllEventos($orden);
}else
{
	$eventos = $pdo->getEventos($lineaTemporal, $orden);
}
$pdo->disconnect();
?>
<?php include 'layouts/header.php'; ?>
	<title>Cronologías</title>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jquery-1.12.0.min.js"></script>
	<script src="../js/timeline.min.js"></script>
	<!--<link rel="stylesheet" href="css/bootstrap.css" />-->
	<link rel="stylesheet" href="../css/timeline.min.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<!--<link rel="stylesheet" href="../css/style.css"/>
</head>
<body>-->

<?php include 'layouts/nav.php'; ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    	<!-- Content Header (Page header) -->
		<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			<div class="col-sm-12">
				<h1 class="fw-bolder text-center"> Cronología de Aeberion </h1>
			</div>
			</div>
		</div><!-- /.container-fluid -->
		</section>

		<div class="container">
			<div class="row">
				<div class="col">
					<p class="text-center"> Cronología de los eventos más relevantes de la historia del continente.</p>
				</div>
			</div>
		</div>
		<!-- Main content -->
		<section class="content">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-auto">
						<a href=nuevoEvento.php class="btn btn-primary"> Añadir evento </a>
					</div>
					<!--<form class="col-md-auto needs-validation" method="POST" action="/Aeberion/timelines.php" >-->
						<form class="col-md-auto needs-validation" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
						<div class="row align-items-center justify-content-center">
							<div class="col-md-auto">
								<select class="form-select" name="lineaTemporal" id="inputTimeline">
									<option selected disabled value="">Línea temporal</option>
									<?php
										$nTimelines=count($listaTimelines);
										for($x=0;$x<$nTimelines;$x++)
										{
											?>
											<option><?php echo $listaTimelines[$x];?></option>
										<?php
										}
									?>
								</select>
							</div>
							<div class="col-md-auto">
								<select class="form-select" name="orden" id="inputOrden">
									<option selected disabled value="">Orden</option>
									<option>ASC</option>
									<option>DESC</option>
								</select>
							</div>
							<div class="col-md-auto">
								<button type="submit" class="btn btn-info">Filtrar</button>
							</div>
						</div>
					</form>
				</div>
			</div>

	<div class="container">
		<br />
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Línea temporal:<?php echo $lineaTemporal; ?></h3>
			</div>
			<div class="panel-body">
				<div class="timeline">
				<div class="timeline__wrap">
				<div class="timeline__items">
				<?php 
				foreach($eventos as $evento)
				{
				?>
				<div class="timeline__item">
					<div class="timeline__content">
					<h2><?php echo $evento['anno'], " ", $evento['nombreEvento'];
							// echo "<a href=\"/Aeberion/editarEvento.php?id=$evento[id]\">E</a>";?>
						<button type="button"><a href="<?php echo "editarEvento.php?id=$evento[id]";?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="<?php echo $iconoPathEdit ; ?>"/>
						</svg></a></button>
						<button type="button" class="eliminarEventoModal" data-id="<?php echo $evento['id'] ?>" data-bs-toggle="modal" data-bs-target="#eliminarEvento">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
						<path d="<?php echo $iconoPathDelete ;?>"/>
						</svg></button>
					</h2>
					<p><?php echo $evento['descripcion'];?></p>
					</div>
				</div>
				<?php
				}
				?>
				</div>
				</div>
				</div>
			</div>
		</div>
	</div>
    </section>
    <!-- /.content -->

	</div>
  	<!-- /.content-wrapper -->

<?php //include_once 'layouts/footer.php';?>

<script>
$(document).ready(function(){
 jQuery('.timeline').timeline({
  //mode: 'horizontal',
  //visibleItems: 4
  //Remove this comment for see Timeline in Horizontal Format otherwise it will display in Vertical Direction Timeline
 });
});
</script>

<!--<script>
$(document).ready(function(){
    $('#eliminarEvento').on('show.bs.modal', function (e) {
        var modalid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'fetch_record.php', //Here you will fetch records 
            data :  'modalid='+ modalid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
            }
        });
     });
});
</script>-->

<script> 
$(document).ready(function() {
   $(".eliminarEventoModal").click(function() {
	 $("#eventoModalId").val($(this).attr('data-id'));
     $("#eliminarEvento").modal("show");
  });
});
</script>
<!-- jQuery -->
<!--<script src="../js/jquery.min.js"></script>-->
<!-- Bootstrap 4 -->
<!--<script src="../js/bootstrap.bundle.min.js"></script>-->
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="eliminarEvento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="eliminarEventoLabel">Eliminar evento</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<p>Confirmar eliminar evento.</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
			<form class="col-md-auto needs-validation" method="POST" action="/Aeberion/editarEvento.php" >
				<input type="hidden" name="borrar" value="borrar">
				<input type="hidden" name="id" id="eventoModalId" value="eventoModalId">
				<button type="submit" class="btn btn-danger">Eliminar</button>
			</form>
		</div>
		</div>
	</div>
	</div>