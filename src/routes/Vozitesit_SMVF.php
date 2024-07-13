<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//require '../vendor/autoload.php';
//require 'db.php';

$app = new \Slim\App();

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
// GET All Vozitesit_SMVF
$app->get('/api/Vozitesit_SMVF', function (Request $request, Response $response) {
    $sql = 'SELECT * FROM Vozitesit_SMVF';
	try{
		//Get db Object
		$db = new db();
		//COnnect 
		$db=$db->connect();
		
		$stmt = $db->query($sql);
		$Vozitesit_SMVF = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($Vozitesit_SMVF);
		
	} catch(PDOException $e){
		echo '{"error":{"text": '.$e->getMessage().'}';
	}
});

// GET Single cutomer
$app->get('/api/vozites/{id}', function (Request $request, Response $response) {
	//To get the customer id create variable
	$id = $request->getAttribute('id');
	
    $sql = "SELECT * FROM Vozitesit_SMVF WHERE ID = '$id'";
	try{
		//Get db Object
		$db = new db();
		//COnnect 
		$db=$db->connect();
		
		$stmt = $db->query($sql);
		$vozites = $stmt->fetch(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($vozites);
		
	} catch(PDOException $e){
		echo '{"error":{"text": '.$e->getMessage().'}';
	}
});


// Add cutomer
$app->post('/api/vozites/shto', function (Request $request, Response $response) {
	
	$EmriVozitesit_SMVF = $request->getParam('EmriVozitesit_SMVF');
	$MbiemriVozitesit_SMVF = $request->getParam('MbiemriVozitesit_SMVF');
	$EkipaVozitesit_SMVF = $request->getParam('EkipaVozitesit_SMVF');
	$Nr_Vozitesit_SMVF = $request->getParam('Nr_Vozitesit_SMVF');
	$PiketVozitesit_SMVF = $request->getParam('PiketVozitesit_SMVF');
	$GaratFituara_SMVF = $request->getParam('GaratFituara_SMVF');
	$TruefetFituara_SMVF = $request->getParam('TruefetFituara_SMVF');
	
    $sql = "INSERT INTO Vozitesit_SMVF (EmriVozitesit_SMVF, MbiemriVozitesit_SMVF, EkipaVozitesit_SMVF, Nr_Vozitesit_SMVF, PiketVozitesit_SMVF, GaratFituara_SMVF, TruefetFituara_SMVF) 
	VALUES(:EmriVozitesit_SMVF, :MbiemriVozitesit_SMVF, :EkipaVozitesit_SMVF, :Nr_Vozitesit_SMVF, :PiketVozitesit_SMVF, :GaratFituara_SMVF, :TruefetFituara_SMVF)";
	try{
		//Get db Object
		$db = new db();
		//COnnect 
		$db=$db->connect();
		
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':EmriVozitesit_SMVF',$EmriVozitesit_SMVF);
		$stmt->bindParam(':MbiemriVozitesit_SMVF',$MbiemriVozitesit_SMVF);
		$stmt->bindParam(':EkipaVozitesit_SMVF',$EkipaVozitesit_SMVF);
		$stmt->bindParam(':Nr_Vozitesit_SMVF',$Nr_Vozitesit_SMVF);
		$stmt->bindParam(':PiketVozitesit_SMVF',$PiketVozitesit_SMVF);
		$stmt->bindParam(':GaratFituara_SMVF',$GaratFituara_SMVF);
		$stmt->bindParam(':TruefetFituara_SMVF',$TruefetFituara_SMVF);
		
		$stmt->execute();
		echo'{"notice":{"text":"vozitesi u shtua!"}';
	} catch(PDOException $e){
		echo '{"error":{"text": '.$e->getMessage().'}';
	}
});




// Update cutomer
$app->put('/api/vozites/modifiko/{id}', function (Request $request, Response $response) {
	//To get the customer id create variable
	$id = $request->getAttribute('id');
	$EmriVozitesit_SMVF = $request->getParam('EmriVozitesit_SMVF');
	$MbiemriVozitesit_SMVF = $request->getParam('MbiemriVozitesit_SMVF');
	$EkipaVozitesit_SMVF = $request->getParam('EkipaVozitesit_SMVF');
	$Nr_Vozitesit_SMVF = $request->getParam('Nr_Vozitesit_SMVF');
	$PiketVozitesit_SMVF = $request->getParam('PiketVozitesit_SMVF');
	$GaratFituara_SMVF = $request->getParam('GaratFituara_SMVF');
	$TruefetFituara_SMVF = $request->getParam('TruefetFituara_SMVF');
    $sql = "UPDATE Vozitesit_SMVF SET
	EmriVozitesit_SMVF = :EmriVozitesit_SMVF,
	MbiemriVozitesit_SMVF = :MbiemriVozitesit_SMVF,
	EkipaVozitesit_SMVF = :EkipaVozitesit_SMVF,
	Nr_Vozitesit_SMVF = :Nr_Vozitesit_SMVF,
	PiketVozitesit_SMVF = :PiketVozitesit_SMVF,
	GaratFituara_SMVF = :GaratFituara_SMVF,
	TruefetFituara_SMVF = :TruefetFituara_SMVF
	WHERE ID = '$id'";
	try{
		//Get db Object
		$db = new db();
		//COnnect 
		$db=$db->connect();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':EmriVozitesit_SMVF',$EmriVozitesit_SMVF);
		$stmt->bindParam(':MbiemriVozitesit_SMVF',$MbiemriVozitesit_SMVF);
		$stmt->bindParam(':EkipaVozitesit_SMVF',$EkipaVozitesit_SMVF);
		$stmt->bindParam(':Nr_Vozitesit_SMVF',$Nr_Vozitesit_SMVF);
		$stmt->bindParam(':PiketVozitesit_SMVF',$PiketVozitesit_SMVF);
		$stmt->bindParam(':GaratFituara_SMVF',$GaratFituara_SMVF);
		$stmt->bindParam(':TruefetFituara_SMVF',$TruefetFituara_SMVF);
		$stmt->execute();
		echo'{"notice":{"text":"vozitesi u modifikua"}';
	} catch(PDOException $e){
		echo '{"error":{"text": '.$e->getMessage().'}';
	}
});


// Delete cutomer
$app->delete('/api/vozites/fshi/{id}', function (Request $request, Response $response) {
	//To get the customer id create variable
	$id = $request->getAttribute('id');
	
    $sql = "DELETE FROM Vozitesit_SMVF WHERE ID = '$id'";
	try{
		//Get db Object
		$db = new db();
		//COnnect 
		$db=$db->connect();
		
		$stmt = $db->prepare($sql);
		$stmt->execute();
		echo'{"notice":{"text":"vozitesi u fshi!"}';
		
	} catch(PDOException $e){
		echo '{"error":{"text": '.$e->getMessage().'}';
	}
});