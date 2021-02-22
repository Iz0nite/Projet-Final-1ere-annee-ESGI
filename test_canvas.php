<?php
  require('config.php');

  $q='SELECT country, count(*) FROM user GROUP BY country order by count(*) DESC limit 10 ';
  $req = $bdd->query($q);
  $results = $req->fetchAll(PDO::FETCH_ASSOC);

  $q='SELECT birth, year(birth) FROM user';
  $req = $bdd->query($q);
  $results2 = $req->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- <style>
canvas{
  width: 500px;
  height: 350px;
}
</style> -->
<div id="country_count">
  <?php
  foreach ($results as $key => $value){
    echo $value['count(*)'].",";

  }

   ?>

 </div>

  <div id="country_name">
     <?php
     foreach ($results as $key => $value){
       echo $value['country'].",";

     }

      ?>

<div id="birth_user">
        <?php
        foreach ($results2 as $key => $value){
          echo $value['year(birth)'].",";

        }

         ?>

  </div>
</div>
<canvas id="canvas_country" class="test" width="350" height="350"></canvas>
<canvas id="canvas_birth" class="test" width="430" height="350"></canvas>
<script src="js/canvas.js" charset="utf-8"></script>
<style type="text/css">
  canvas { border: 1px solid black; }
</style>
