<?php
/**
 * global functions
 * @author Nadeem <www.webtechapps.com>
 */

function redirectToUrl($url) {
    header('Location: '.$url);
    // if php reidrect header doesn't work, then we will redirect using html meta or javascript
    ?>
    <meta http-equiv="refresh" content="0;URL=<?php echo $url?>">
    <script type="text/javascript">
       window.location="<?php echo $url?>";
    </script>
    <?php
    exit;
}
// encrypting strings
function encrypt($data, $encKey=ENCRYPT_KEY) {
   $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
   $key = substr(hash('sha256', $salt.$encKey.$salt), 0, 32);
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
   return $encrypted;
}
// decrypting strings
function decrypt($data, $encKey=ENCRYPT_KEY) {
   $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
   $key = substr(hash('sha256', $salt.$encKey.$salt), 0, 32);
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
   return $decrypted;
}
/**
 * check if session is started
* @return bool
*/
function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
/**
 * set flashSession 
 */
function setFlashMessage($key, $value) {
    $_SESSION[$key] = $value;
}
/**
 * get flashSession 
 */
function checkFlashMessage($key){
	if(isset($_SESSION[$key]))
        return TRUE;
    return false;
}
function getFlashMessage($key) {
    if(isset($_SESSION[$key]))
    {
        $value = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $value;
    }
    return false;
}
function cleanData($data) {
    if(is_array($data)){
        foreach ($data as $key => $value) {
            $data[$key] = strip_tags(htmlspecialchars(trim($value), ENT_QUOTES));
        }
    }
    else{
        $data = strip_tags(htmlspecialchars(trim($data), ENT_QUOTES));
    }
    return $data;
}