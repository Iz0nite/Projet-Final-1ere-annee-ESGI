<?php
require('config.php');

$q ="SELECT category.name,category.id,file.path FROM category INNER JOIN file ON category.img_id=file.id";
$req = $bdd->query($q);
$result_cat=$req->fetchAll(PDO::FETCH_ASSOC);


if ($_GET['category']==='all'){
  $q = 'SELECT post.title,post.description,user.nickname,file.path,post.difficulty,post.view,
  category.name
   FROM post

  INNER JOIN
  user
  ON user.id=post.user_id

  LEFT JOIN
  file
  ON post.id=file.post_id

  LEFT JOIN category
  ON category.id=post.category_id

   ORDER BY post.dateToday DESC LIMIT 5 ';
  $req = $bdd->query($q);
  $results2 = $req->fetchAll(PDO::FETCH_ASSOC);

}
else{
  $q = 'SELECT post.title,post.description,user.nickname,file.path,post.difficulty,post.view,
  category.name
 FROM post

INNER JOIN
user
ON user.id=post.user_id

LEFT JOIN
file
ON post.id=file.post_id

INNER JOIN category
ON category.id=post.category_id

WHERE post.category_id = ? ORDER BY post.dateToday DESC LIMIT 5 ';
$req = $bdd->prepare($q);
$req->execute([$_GET['category']]);
$results2 = $req->fetchAll(PDO::FETCH_ASSOC);
}

foreach ($results2 as $key => $value) {

      if($results2[$key]['path'] === null){

        foreach ($result_cat as $key2 => $value2) {

          if($value2['name'] === $results2[$key]["name"]){


              $results2[$key]=array_replace($results2[$key],$value2);
                //var_dump($results2[$key]);
            //$results2[$key]["path"] = $value2['path'];

          }
        }
      }

}




echo json_encode($results2);
?>
