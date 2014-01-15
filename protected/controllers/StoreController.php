<?php

class StoreController extends Controller
{
	public $message;
	public function actionIndex()
	{
		$this->message = "Hello from Index page";
		$this->render('index', array('content'=> $this->message));
	}

	public function actionBrowse()
	{
		if ($_GET['gid'])
		{
			$genreCriteria = new CDbCriteria;
			$genreCriteria->select = "GenreID, Name, Description";
			$genreCriteria->condition = "GenreId = ".$_GET['gid'];
			
			$artistCriteria = new CDbCriteria;
			$artistCriteria->alias = "t1";
			$artistCriteria->select = "DISTINCT t1.Name, t1.ArtistId";
			$artistCriteria->join = "LEFT JOIN tbl_album ON tbl_album.ArtistId = t1.ArtistId";
			$artistCriteria->condition = "tbl_album.GenreId = ".$_GET['gid'];
			$artistCriteria->order = "t1.ArtistId ASC";
			
			$albumCriteria = new CDbCriteria;
			$albumCriteria->alias = "t2";
			$albumCriteria->select = "AlbumId, GenreId, ArtistId, Title, Price, AlbumThumbUrl, AlbumArtUrl, tracks, LinerNotes";
			$albumCriteria->condition = "GenreId = ".$_GET['gid'];
			$albumCriteria->order = "ArtistId ASC";
			
			$this->render('index', array('Albums'=> Album::model()->findall($albumCriteria),
										'Artists'=> Artist::model()->findall($artistCriteria),
										'Genres'=> Genre::model()->findall($genreCriteria)));
		} else 
		{
			$this->message = "Hello from Browse page";
			$this->render('index', array('content'=> $this->message));
		}
	}
	
	public function actionDetails()
	{
		if ($_GET['album']) {
			$albumCriteria = new CDbCriteria;
			$albumCriteria->select = "*";
			$albumCriteria->condition = "AlbumId = ".$_GET['album'];
			$albumCriteria->order = "ArtistId ASC";
			
			$this->render('index', array('Albums'=> Album::model()->findall($albumCriteria)));
		} else 
		{
			$this->message = "Hello from Details page";
			$this->render('index', array('content'=> $this->message));	
		}
	}
	
	public function actionArtistDetails()
	{
		if ($_GET['artistid']) {
			$artistCriteria = new CDbCriteria;
			$artistCriteria->select = "*";
			$artistCriteria->condition = "ArtistId = ".$_GET['artistid'];
			
			$this->render('index', array('Artists'=> Artist::model()->findall($artistCriteria)));
		} else 
		{
			$this->message = "Hello from Artist Details page. Please select an artist to view their details.";
			$this->render('index', array('content'=> $this->message));	
		}
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}