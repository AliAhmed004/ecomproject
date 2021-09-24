<?php

function getTempUserId()
{
    if(!session()->has('USE_TEMP_ID'))
    {
        $rand=rand(1111111,9999999);
        session()->put('USE_TEMP_ID',$rand);
        return $rand;
    }
    else
    {
        return session()->get('USE_TEMP_ID');
    }
}

function prx($arr)
{
    echo "<pre>";
  print_r($arr);
  die();
}
?>