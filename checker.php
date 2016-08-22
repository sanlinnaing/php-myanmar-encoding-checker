<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['zg_string']) && !empty($_GET['zg_string'])) {
    $zgString = $_GET['zg_string'];
    if (isZawgyi($zgString)) {
        echo 'Zawgyi String detect!!';
    } else {
        echo 'Oh! It will be Unicode string.';
    }
}

function isZawgyi($testString)
{
    $zawgyiRegex1 = 'ေျ' // e+medial ra
// beginning e or medial ra
.'|^ေ|^ျ'
// independent vowel, dependent vowel, tone , medial ra wa ha (no ya
// because of 103a+103b is valid in unicode) , digit ,
// symbol + medial ra
.'|[ဢ-ူဲ-္ျ-ွ၀-၏]ျ'
// end with asat
.'|္$'
// medial ha + medial wa
.'|ွြ'
// medial ra + medial wa
.'|ျြ'
// consonant + asat + ya ra wa ha independent vowel e dot below
// visarga asat medial ra digit symbol
.'|[က-အ]္[ယရဝဟဢ-ဪေ့-္ျ၀-၏]'
// II+I II ae
.'|ီ[ိှဲ]'
// ae + I II
.'|ဲ[ိီ]'
// I II , II I, I I, II II
//+ "|[ိီ][ိီ]"
// U UU + U UU
//+ "|[ုူ][ုူ]" [ FIXED!! It is not so valuable zawgyi pattern ]
// tall aa short aa
//+ "|[ါာ][ါာ]" [ FIXED!! It is not so valuable zawgyi pattern ]
// shan digit + vowel
.'|[႐-႙][ါ-ူဲ့ြ-ှ]'
// consonant + medial ya + dependent vowel tone asat
.'|[က-ဪ]်[ာ-ီဲ-ံ]'
// independent vowel dependent vowel tone digit + e [ FIXED !!! - not include medial ]
.'|[ဣ-ူဲ-္၀-၏]ေ'
// other shapes of medial ra + consonant not in Shan consonant
.'|[ၾ-ႄ][ခဃစ-ဏဒ-နဖ-ဘဟ]'
// u + asat
.'|ဥ္'
// eain-dray
.'|[ႁႃ]ႏ'
// short na + stack characters
.'|ႏ[ၠ-ႍ]'
// I II ae dow bolow above + asat typing error
.'|[ိ-ူဲံ့]္'
// aa + asat awww
.'|ာ္'
// ya + medial wa
.'|ရြ'
// non digit + zero + ိ (i vowel) [FIXED!!! rules tested zero + i vowel in numeric usage]
.'|[^၀-၉]၀ိ'
// e + zero + vowel
.'|ေ?၀[ါၚီ-ူဲံ-း]'
// e + seven + vowel
.'|ေ?၇[ာ-ူဲံ-း]'
// cons + asat + cons + virama
//+ "|[က-အ]်[က-အ]္" [ FIXED!!! REMOVED!!! conflict with Mon's Medial ]
// U | UU | AI + (zawgyi) dot below
.'|[ုူဲ]႔'
// virama + (zawgyi) medial ra
.'|္[ၾ-ႄ]';

    $ptn = '/'.$zawgyiRegex1.'/u';
    //echo $ptn;
    //preg_match_all($ptn, $testString, $output_array);
    // if (count($output_array) > 0) {
    //     return true;
    // } else {
    //     return false;
    // }
    if (preg_match_all($ptn, $testString)) {
        return true;
    } else {
        return false;
    }

}
