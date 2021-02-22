<input type="checkbox" id="check" style="display:none;" />
<div class="page">


<label for="check" id="open" onclick="stop()">
<div class="nav_trigger">
Ouvrir
</div>
</label>
<nav>

<div>

  <ul>
    <li>
    <a href="trend.php" class="selected" title="Actualités">
      <img src="Images\icons8-accueil-50.png" height="30px"  alt="Actualités"/>

      </a>
    </li>
    <li>
      <a href="subscribe.php" class="selected" title="Abonnements">
        <img src="Images\icons8-ajouter-une-propriété-64.png" height="30px"  alt="Abonnements"/>
      </a>
    </li>
    <li>
    <a href="suggest.php" class="selected" title="Suggestion">
      <img src="Images\suggest.png" height="30px"  alt="Suggestion"/>
    </a>
    </li>
    <li>
      <a href="new_post.php" class="selected" title="Nouveau poste">
      <img src="Images\icons8-créer-un-nouveau-32.png" height="30px"  alt="Nouveau poste"/>
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a  class="selected" title="Aide !" onclick="help()">
      <img src="Images\icons8-question-80.png" height="30px" alt="Aide !"/>
      </a>
    </li>
  </ul>


</div>
<label for="check" id="close" onclick="unstop()" style="align-self:flex-end;"><div class="cross">
  <img  src="Images/icons8-plus-50.png"/>
</div></label>

</nav>
<div id="help" class="hide">
  <div id='div_help' class="help_container">
    <a onclick="close_help()">Close</a>
    <textarea id='help1' name="help1" rows="2" cols="2" placeholder="Raison"></textarea>
    <textarea id='help2' name="help2" rows="12" cols="55" placeholder="Dévellopement"></textarea>
    <button id='help_button' onclick="send_help()">Envoyer</button>
  </div>
</div>
<script src="js/help.js"></script>
