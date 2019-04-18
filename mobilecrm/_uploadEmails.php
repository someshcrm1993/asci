<?php

$email = "udaya@test.com";

$quer0 ="SELECT id FROM email_addresses WHERE email_address = 'udaya@test.com' and deleted = 0";
$valuer0=$db->query($quer0);     
if($gr=$db->fetchByAssoc($valuer0)) {
$email_id = $gr['id'];

$quer1 ="SELECT bean_id, bean_module FROM email_addr_bean_rel WHERE email_address_id = '$email_id' and deleted = 0";
$valuer1=$db->query($quer1);     
if($gr1=$db->fetchByAssoc($valuer1)) {
$bean_id = $gr['bean_id'];
$bean_module = $gr['bean_module'];
}

}

echo "email_id : ".$email_id;
echo "<br>";
echo "bean_id : ".$bean_id;
echo "<br>";
echo "bean_module : ".$bean_module;
echo "<br>";
?>
