<?php
/**
 * Created by IntelliJ IDEA.
 * User: JariZ
 * Date: 18-4-14
 * Time: 0:51
 */

echo fwrite(fopen($argv[2], "w+"), file_get_contents(json_decode(file_get_contents("https://api.soundcloud.com/resolve.json?url=".$argv[1].$cid="&client_id=b45b1aa10f1ac2941910a7f0d10f8e28"))->stream_url."?".substr($cid,1)));