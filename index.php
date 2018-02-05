<?php
/**
 * User: Guy.Golan
 * Date: 2/5/2018
 * Time: 3:09 PM
 */

//first check if the 'id' parameter is available in the url
if(!empty($_GET['id'])) :

    $unsub_id = $_GET['id'];
    $token = 'you_token_goes_here';
    $url = 'https://crm.zoho.com/crm/private/xml/Leads/updateRecords?newFormat=1&authtoken='.$token.'&scope=crmapi&id='.$unsub_id.'&xmlData=<Leads><row no="1"><FL val="Email Opt Out">true</FL></row></Leads>';

    $sxml = simplexml_load_file($url);
    $json = json_encode($sxml);
    $sxml_array = json_decode($json,TRUE);
    $sxml_result = $sxml_array["result"]["message"];

        if($sxml_result === "Record(s) updated successfully"):?>
            <p class="unsub-return-message">Unsubscribed successfully.<br/>You will no longer receive e-mail communications from us</p>
            <?php
        else: ?>
            <p class="unsub-return-message error">A problem accured while trying to unsubscribe,<br/>Please contact us <a href="#">by email</a>.<br/>Thank you.</p>
        <?php
        endif;

    else: //no id ?>
        <p class="unsub-return-message error">A problem accured while trying to unsubscribe,<br/>Please contact us <a href="#">by email</a>.<br/>Thank you.</p>
    <?php
endif;
?>