let date;
let arrive;
let departure;
let time;


window.addEventListener('load', function(event) {
  date = new Date()
  arrive = date.getTime();
  console.log(arrive);
});

window.addEventListener('beforeunload', function(event) {
  let id=document.getElementById('id_title').innerHTML;
  date = new Date()
  departure = date.getTime();
  console.log(departure);
  time = (departure - arrive)/1000;


  let req = new XMLHttpRequest();
  req.open("POST", '../time_spend.php',true);

  //Envoie les informations du header adaptées avec la requête
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  req.onreadystatechange = function() { //Appelle une fonction au changement d'état.
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {


    }
}
  req.send("time="+time+"&post_id="+id);

});
