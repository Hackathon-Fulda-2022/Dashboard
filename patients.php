<?php

include("config.php");
include("header.php");

?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Patient auswählen</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div class="form-outline">
										<input type="search" id = "form1" class="form-control" placeholder="Name zum Suchen eingeben" aria-label="Suchen">
									</div>
								</div>
								<div class="card-body">
									<ul id="patient-list" class="list-group list-group-flush">
                                        <?php
                                            $db = pg_connect($pg_conn_str);
                                            $result = pg_query($db, 'SELECT "pfName", "psName", "patientID" FROM patient');
                                            while($row = pg_fetch_row($result)){
                                                echo '<li class="list-group-item"><a href="patient-dashboard.php?patientID='.$row[2].'">'.$row[0].' '.$row[1].'</a></li>';
                                            }
											pg_free_result($result);
											pg_close($db);
										?>
									</ul>
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
	<script src="js/search.js"></script>


</body>

</html>
