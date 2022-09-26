<?php

function cetak_xss($str){
    echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}