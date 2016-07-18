<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function somethingOrOther()
{
    return (mt_rand(1,2) == 1) ? 'something' : 'other';
}

function bannerType($id='')
{
    $array = array(
        '1'=>array('position'=>'Header Banner','thumb'=>array('width'=>'220','height'=>'120'),'mid'=>array('width'=>'280','height'=>'140')),
        '2'=>array('position'=>'Slide Banner','thumb'=>array('width'=>'220','height'=>'120'),'mid'=>array('width'=>'280','height'=>'140')),
        '3'=>array('position'=>'Header Banner','thumb'=>array('width'=>'220','height'=>'120'),'mid'=>array('width'=>'280','height'=>'140'))
        );
    if($id)
		return $array[$id];
	else
    return $array;
}

function imageUpload($file,$folder,$thumb=array(),$mid=array(),$oldImage)
{
	if($file)
	{
		$destinationPath = 'uploads/'.$folder.'/'; // upload path
		$image = $file;
		$extension = $image->getClientOriginalExtension(); // getting image extension
		$fileName = rand(11111,99999).'.'.$extension; // renameing image
		//Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
		
		if($thumb)
		{
			$width = $thumb['width'];
			$height = $thumb['height'];
			$path = ($destinationPath . 'thumb_'.$fileName);
			Image::make($image->getRealPath())->resize($width, $height)->save($path);
		
		}
		if($mid)
		{
			$width = $mid['width'];
			$height = $mid['height'];
			$path = ($destinationPath . 'mid_'.$fileName);
			Image::make($image->getRealPath())->resize($width, $height)->save($path);
		}
		if($image->move($destinationPath, $fileName))
                {
                    //Storage::Delete($destinationPath.$oldImage);
                    File::Delete($destinationPath.$oldImage);
                    File::Delete($destinationPath.'thumb_'.$oldImage);
                    File::Delete($destinationPath.'mid_'.$oldImage);
                    
                }
		return $fileName;
	}
}

function configs_value($key)
{
  $configs= DB::table('configs')->where('key', '=',$key)->first(); 
  return $configs->value;
}

function email_section($id)
{
  $email_msgs= DB::table('email_msgs')->where('id', '=',$id)->first(); 
  return $email_msgs;
}
?>
