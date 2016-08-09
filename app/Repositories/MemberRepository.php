<?php

namespace App\Repositories;

use App\Repositories\MyRepository;
use App\functions\QRcode as QRcode;

class MemberRepository extends MyRepository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Member';
    }

    function createQRCode($gender,$id)
    {
        // generate random member id
        $idtf = $gender == 'male' ? 'L' : 'P';
        $rand = strtoupper(substr(md5(microtime()),rand(0,26),6));
        $mbr_id = $idtf.$rand;

        $codeContents = route('viewmember', ['mbr' => $id] ); 
        $filename = strtoupper(substr(md5(microtime()),rand(0,26),7));
        $path = public_path('img/members/') . $filename . '.png';
        $code = QRcode::png($codeContents, $path, QR_ECLEVEL_L, 6, 8); 
        $url = 'img/members/'. $filename . '.png';

        return array('mbr_id' => $mbr_id, 'qrimg' => $url);

    }

}
