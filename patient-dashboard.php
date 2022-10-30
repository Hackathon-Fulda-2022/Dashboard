<?php

include("config.php");
include("header.php");
	// Patientenstammdaten abfragen
	$db = pg_connect($pg_conn_str);

		if(is_numeric($_GET["patientID"])){
			$patientID = $_GET["patientID"];
			$db = pg_connect($pg_conn_str) or die("Could not connect");

			
			$sql = 'SELECT * FROM public.patient WHERE "patientID"='. $patientID . ';';
			
			$result = pg_query($db, $sql);
			
			while($row = pg_fetch_row($result)){
				
				$patient["psName"] = $row[1];
				$patient["pfName"] = $row[2];
				$patient["birthdate"] = $row[3];
				$patient["bloodtype"] = $row[4];
				$patient["sex"] = $row[5];
				$patient["roomID"] = $row[6];
				$patient["allergies"] = $row[7];
				$patient["startdate"] = $row[8];
				$patient["enddate"] = $row[9];
				$patient["insurancecard"] = $row[10];
				$patient["pflegegrad"] = $row[11];
				$patient["doctor"] = $row[12];
				$patient["contacts"] = $row[13];
				$patient["notes"] = $row[14];
				
				
				echo("");


			}

			
		} else{
			echo( "Id war keine Nummer, du Skriptkiddy.");
		}

	pg_free_result($result);
	pg_close($db);

	//Stammdaten ausgeben
?>


			<main class="content">
				<div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Patientenstammdaten</h1>
						<a class="badge bg-dark text-white ms-2" href="">
      Bearbeiten
  </a>
					</div>
					<div class="row">
						<div class="col-md-4 col-xl-3">
							<div class="card mb-3">
								<div class="card-body text-center">
									<img src="img/avatars/avatar-4.jpg" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" />
									<h5 class="card-title mb-0"><?php echo($patient["pfName"]." ".$patient["psName"]); ?></h5>
									<div class="text-muted mb-2"><?php echo($patient["birthdate"]." - ".$patient["sex"][0].alter($patient["birthdate"])." Jahre"); ?></div>
									<div class="text-muted mb-2"><?php echo("Auf Station seit: ".$patient["startdate"]); ?></div>
									<div class="text-muted mb-2"><?php echo("Pflegegrad ".$patient["pflegegrad"]); ?></div>
									<div class="text-muted mb-2"><?php echo("Arzt: ".$patient["doctor"]); ?></div>
									
									<div>
										<a class="btn btn-primary btn-sm" href="#">Zimmer <?php echo($patient["roomID"]); ?></a>
										<a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span>Kontakte</a>
									</div>
								</div>
								<hr class="my-0" />
								<?php
								if($patient["allergies"]==0){
									echo("");
								} else {
									echo('<div class="card-body"><h5 class="h6 card-title">Allergien</h5><span style="background-color:red;" class="mb-1"></span></div><hr class="my-0" />');
								}
								?>



								<div class="card-body">
									<h5 class="h6 card-title">Notizen</h5>
									<ul class="list-unstyled mb-0">
										<?php echo($patient["notes"]); ?>
									</ul>
								</div>



							</div>



						</div>

						<div class="col-md-8 col-xl-9">
						<div class="card">
							<div class="card-body">
								<script>var patientID = <?php echo $_GET["patientID"];?>; var vitalID = 3;</script>
								<canvas id="myChart<?php echo $_GET["patientID"] . "_3"; ?>" style="height:80px"></canvas>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<script>var patientID = <?php echo $_GET["patientID"];?>; var vitalID = 0;</script>
								<canvas id="myChart<?php echo $_GET["patientID"] . "_0"; ?>" style="height:80px"></canvas>
							</div>
						</div>


							<div class="card">
								<div class="card-header">

									<h5 class="card-title mb-0">Patientenzustand</h5>
								</div>
								<div class="card-body h-100">
									<?php
									//Patientenzustandabfrage
									$db = pg_connect($pg_conn_str);									
										if(is_numeric($_GET["patientID"])){
											$patientID = $_GET["patientID"];
											$db = pg_connect($pg_conn_str) or die("Could not connect");
											$sql = 'SELECT * FROM public.patientcondition WHERE "patientID"='. $patientID . ' ORDER BY "pcDateTime" DESC;';

											$result = pg_query($db, $sql);

											while($row = pg_fetch_row($result)){

												$pc["datetime"] = $row[1];
												$pc["text"] = $row[3];

									?>

									<div class="d-flex align-items-start">
										<div class="flex-grow-1">
											<small class="float-end text-navy"><?php echo(gmdate("d.m.Y H:i", $pc["datetime"])); ?></small>
											<strong>Patientenzustand</strong> aktualisiert<br />
											<div class="border text-sm text-muted p-2 mt-1">
												
>												
													<?php echo($pc["text"]); ?>

											
											</div>

											<a href="#" class="btn btn-sm btn-danger mt-1"><i class="feather-sm" data-feather="heart"></i> Achtung!</a>
										</div> 
									</div>

									<hr />

										<?php
											}
								
										
										} else{
											echo( "Id war keine Nummer, du Skriptkiddy.");
										}
								
									pg_free_result($result);
									pg_close($db);



									?>

									
									<div class="d-grid">
										<a href="#" class="btn btn-primary">Mehr laden</a>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<strong>DT Health</strong> – <strong>Dirt Torpedo</strong>
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<strong>Hackathon 2022<strong>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://momentjs.com/downloads/moment.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
	<script src="js/graphs.js"></script>
	
</body>

</html>