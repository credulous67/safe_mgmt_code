<?php
$pages=scandir('pages');
$notWanted=array('.', '..','km_config.php');
//echo '<link rel="stylesheet" href="styles.css">'
echo '<h1>Encryption Services Key Inventory</h1>';
echo '<div class="menu">';
foreach ($pages as $page)
{
  if(!in_array($page, $notWanted))
  {
    $link="pages/".$page;
    $safeName = strtoupper(str_replace('.php', '', $page));
    echo '<a href="'.$link.'">'.$safeName.'</a> &nbsp; &nbsp; &nbsp; &nbsp;';
  }
}
echo '</div>';
?>
