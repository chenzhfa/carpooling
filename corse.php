<?php
session_start();
if(!isset($_SESSION['email'])) {
    echo "Devi loggarti prima!";
    session_destroy();
    die();
}
include_once("Database.php");
$rides = false;
	
$stmt = "SELECT citta_partenza, citta_destinazione, data_ora_partenza, descrizione, tempi_percorrenza, aperto, quota, cognome, nome, email
FROM RVIAGGI
INNER JOIN RAUTISTI ON Kautista = IDautista";

$p_stmt = $connection->prepare($stmt);
$p_stmt->execute();

$rides = $p_stmt->fetchAll(PDO::FETCH_ASSOC);

if($rides === false) {
    echo "Nessun viaggio disponibile!";
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Corse</title>
    <script type="text/javascript"> 
        var rides = <?php echo json_encode($rides)?>;
    </script>
</head>
<body>
	<div class="container choose-locations">
		<input type="text" placeholder="Inserire partenza" id="choose-partenza" value="" onkeyup="filterByPartenza(this)">
		<input type="text" placeholder="Inserire destinazione" id="choose-destinazione" value="">
	</div>
	<div class="container">
		<table class="timetable">
			<tr>
				<th>
					Partenza
				</th>
				<th>
					Destinazione
				</th>
				<th>
					Data e ora partenza
				</th>
				<th>
					Descrizione
				</th>
				<th>
					Tempo percorrenza
				</th>
				<th>
					Aperto
				</th>
				<th>
					Quota
				</th>
				<th>
					Cognome
				</th>
				<th>
					Nome
				</th>
				<th>
					Email
				</th>

			</tr>
		</table>
	</div>
</body>
<script type="text/javascript"> 

	regenerateTable();

	function filterByPartenza(object) {

		let partenze = Array.from(document.querySelectorAll(".partenza"));
		
		var res = partenze.filter((partenza) => {
			console.log("partenza = ",partenza.innerHTML,"; input = ",object.value);
			return partenza.innerHTML === object.value;
		});

		if (res.length === 0) {
			return ;
		}

		partenze.forEach((partenza) => {
			if(!res.includes(partenza)) {
				let toDelete = partenze.parentNode.parentNode;
				toDelete.parentNode.remove(toDelete);
			}
		});
		//object.innerHTML
	}

	function regenerateTable() {
		for (let i = 0; i < rides.length; i++) {
			let newRow = document.querySelector(".timetable").insertRow(-1);
			let cell_partenza = newRow.insertCell(0);
			cell_partenza.className = "partenza"
			cell_partenza.innerHTML = rides[i].citta_partenza;
			
			let cell_destinazione = newRow.insertCell(1);
			cell_destinazione.className = "destinazione";
			cell_destinazione.innerHTML = rides[i].citta_destinazione;
			
			newRow.insertCell(2).innerHTML = rides[i].data_ora_partenza;
			newRow.insertCell(3).innerHTML = rides[i].descrizione;
			newRow.insertCell(4).innerHTML = rides[i].tempi_percorrenza;
			newRow.insertCell(5).innerHTML = rides[i].aperto;
			newRow.insertCell(6).innerHTML = rides[i].quota;
			newRow.insertCell(7).innerHTML = rides[i].cognome;
			newRow.insertCell(8).innerHTML = rides[i].nome;
			newRow.insertCell(9).innerHTML = rides[i].email;
		}
	}
</script>
</html>