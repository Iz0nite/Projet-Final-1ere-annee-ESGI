<pre><script>
    function draw() {
     var n = document.getElementById("num").value;
   var values = n.split(',');      
     var canvas = document.getElementById('myCanvas');
    var ctx = canvas.getContext('2d');
   var width = 40;
     var X = 50;
     var base = 200;
         
     for (var i =0; i<values.length; i++) {
  ctx.fillStyle = '#008080'
    var h = values[i];
            ctx.fillRect(X,canvas.height - h,width,h);
             
            X +=  width+15;
      ctx.fillStyle = '#4da6ff';
            ctx.fillText('Ville '+i,X-50,canvas.height - h -10);
        }
            ctx.fillStyle = '#000000';
            ctx.fillText('Scale X : '
+canvas.width+' Y : '+canvas.height,800,10);
   
    }
    function reset(){
         var canvas = document.getElementById('myCanvas');
          var ctx = canvas.getContext('2d');
           ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
</script>
  
 
    Entre une valeur séparer d'une virgule<br>
    <input type="text" name="number" id="num"><br>
    <input type="button" value="submit" name="submit" onclick="draw()">
    <input type="button" value="Clear" name="Clear" onclick="reset()">
     
 
<canvas id="myCanvas" width="900" height="500
 style=" border:1px="" solid="" #c3c3c3;"="">
    </canvas>
 