<!DOCTYPE html>
<html>
<head>
    <title>Accueil TODO</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/forme.css">
</head>

<body>
<div class="topnav">
	<a class="active" href="#">Accueil</a>
	<a href="#">Mes projets</a>
	<a href="#">Autres</a>
</div>
   
<h1>TODO<h1>
   <a class="button" href="ajoutProjet.php" style="float:right">NEW PROJET</a>
<table>
    <thead>
        <th>Nom du PROJET</th>
        <th>Status du Projet</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php
          foreach($resultat as $result){
        ?>
            <tr>
                <td><?= $result['nomProjet'] ?></td>
                <td><?= $result['etat'] ?></td>
                <td><a href="details.php?id=<?= $result['idProjet'] ?>">Voir</a>  <a href="edit.php?id=<?= $result['idProjet'] ?>">Modifier</a>  <a href="delete.php?id=<?= $result['idProjet'] ?>">Supprimer</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</body>
</html>

<?php

include './bd.php';       

			  //initialiser la session
              session_start();
               
			  $user = $_SESSION['user'];
			  $idUser = $user[0]['idUser'];
			  
                            //preparation de la requete
                            $sql = 'SELECT * FROM projet WHERE idUser = :idUser';
							$records = $conn->prepare($sql);
							// On attache les valeurs
							$records->bindValue(':idUser', $idUser, PDO::PARAM_INT);
                            $records->execute();

                            // On stocke le résultat dans un tableau associatif
                            $resultat = $records->fetchAll(PDO::FETCH_ASSOC);  
//print_r($resultat);exit();							
                            if(!$resultat){
								 header('location:accueilTODO.php');
							}else{
                            //echo 'ici'; exit();
                            //redirection vers la page d'accueil de TODO
                            header('location:accueilTODO.php');
							}
							
							//$conn = null;
?>
