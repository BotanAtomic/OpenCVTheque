<?php

function generateCV($cv)
{
    $title = $cv->getTitle();
    $id = $cv->getId();
    $date = date("d/m/Y à h:i", $cv->getLastModification());
    return "<div class='row cv-section'>
       <div class='span3'>
          <div class='cv-section-title'>
             <dates>Modification le $date</dates>
          </div>
       </div>
       <div class='span9'>
          <div class='cv-item'>
             <a href='google.com' style='color: blue;'>
                <grand>$title</grand>
             </a>
             <br>
             <a href='my_cv.php?remove=$id' style='color : red;'><span class='glyphicon glyphicon-remove'></span>
             Supprimer</a>
             <br>
             <a href='cv_editor.php?cv=$id' style='color : green;'><span class='glyphicon glyphicon-edit'></span> Editer</a>
          </div>
       </div>
    </div>";
}