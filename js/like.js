function like(){

    console.log('Like !');

    const id_post = document.getElementById('id_title').innerHTML;

    let req = new XMLHttpRequest();

    req.open("POST", '../like.php',true);

    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    req.onreadystatechange = function() {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

        
        console.log(req.responseText);

        }
    }
    console.log(id_post);
    req.send('id_post='+id_post);

}
