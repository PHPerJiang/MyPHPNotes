<?php
$data=[
    ['name'=>'PHPerJiang',
        'sex'=>'男',
        'age'=>'23'],
    ['name'=>'CoderJiang',
         'sex'=>'男',
         'age'=>'233333']
       
];
// var_dump(json_encode($data,JSON_UNESCAPED_UNICODE));
echo json_encode($data,JSON_UNESCAPED_UNICODE);