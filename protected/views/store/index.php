<?php
/* @var $this StoreController */

$this->breadcrumbs=array(
	'Store',
);
?>
<h1><em><?php echo CHtml::enCode(Yii::app()->name); ?></em></h1>

<?php if (isset($_GET['gid']) && !empty($_GET['gid'])) {
	foreach ($Genres as $Genre){
		echo '<h1>'.$Genre->Name.'</h1><br />';
		$desc = $Genre->Description;
	}
?>

<div id="gmenu">
	<?php echo $desc; ?>
</div>

<table>
  <tr>
  	<?php
  		$cntRow = 0;
  		$aName = '';
  		foreach ($Albums as $Album)
  		{
  			//$aid = $Album->AlbumId;//??ArtistId
  			$aid = $Album->ArtistId;
  			$cntRow++;
  			if ($cntRow % 2) echo '</tr><tr>';
  			foreach ($Artists as $Artist)
  			{
  				if ($Artist->ArtistId === $aid) {
  					$aName = $Artist->Name.'<br />';
  				}
  			}
  			
  			//echo '<td><center><strong>'.$aName.'</strong>';
  			echo '<td><center><strong>'.CHtml::link($aName, array('/store/ArtistDetails/', 'artistid'=>$aid)).'</strong>';
  			echo CHtml::link('<img src='.Yii::app()->request->baseUrl.$Album->AlbumArtUrl.' /><br />', array('store/details/','album'=>$Album->AlbumId));
  			//echo CHtml::link('<img src="/phpmusicstore'. $Album->AlbumArtUrl. '"/><br />',
  				//			array('store/details/','albid'=>$Album->AlbumId, 'aid'=>$aid));
  			echo $Album->Title.'<br />'.$Album->Price.'</center></td>';
  		} 
  	?>
  </tr>
</table>
<?php }
	 else if (isset($_GET['albid']) && isset($_GET['aid']) && !empty($_GET['albid']) && !empty($_GET['aid'])) {
	 	foreach ($Artists as $Artist)
	 	{
	 		$aname = $Artist->Name;
	 		$abio = $Artist->Bio;
	 	}
	 	foreach ($Albums as $Album) {
	 		$title = $Album->Title;
	 		$tracks = $Album->tracks;
	 		$price = $Album->Price;
	 		$albid = $Album->AlbumId;
	 		$aid = $Album->ArtistId;
	 		$lnotes = $Album->LinerNotes;
	 		$albumArtUrl = $Album->AlbumArtUrl;
	 		$albumThumbUrl = $Album->AlbumTumbUrl;
	 	}
?>
<?php }
	 else if (isset($_GET['album']) && !empty($_GET['album'])) {
	 	foreach ($Albums as $Album)
	 	{
	 		echo '<img src='.Yii::app()->request->baseUrl.$Album->AlbumArtUrl.' /><br />';
	 		echo $Album->Title.'<br />';
	 		echo $Album->Price.'<br />';
	 		//echo CHtml::link('Add to Cart',array('store/cart/','album'=>$Album->AlbumId));
	 		echo CHtml::link('Add to Cart',array('cart/create/','albid'=>$Album->AlbumId, 'aid'=>$Album->ArtistId));
	 	}
	 }
	 else if (isset($_GET['artistid']) && !empty($_GET['artistid']))
	 {
	 	foreach ($Artists as $Artist)
	 	{
	 		$aname = $Artist->Name;
	 		$abio = $Artist->bio;
	 		$artistArtUrl = $Artist->ArtistArtUrl; 
	 	}
	 	
	 	echo '<h1>'.$aname.'</h1>';
	 	echo '<img style="float:left; margin:0 20px 15px 0;" src='.Yii::app()->request->baseUrl.$artistArtUrl.' /><br /></td>';
	 	echo '<h4>Bio</h4>'.$abio;
?>

<?php }
	 else 
	 {
?>

<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>



<?php } ?>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
