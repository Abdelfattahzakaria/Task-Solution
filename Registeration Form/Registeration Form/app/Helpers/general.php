<?php 
function uploadFiles($path, $file, $disk)
{
  $name = $file->getClientOriginalName();
  $file->storeAs($path, $name, $disk);
}
  