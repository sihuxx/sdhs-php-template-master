<?php 

// extract => 배열의 key를 변수로 자동 변환

POST("/users/profile",function(){ 
    extract($_GET); 
    extract($_POST);
    // 사용자가 GET이나 POST 요청을 보내면 
    // extract로 요청의 key를 변수로 자동 변환하여 불러온다.
    
    // 예를 들어, HTML에서 name이 id, value가 sihu인 인풋을 GET문으로 불러온다고 했을 때
    // 위 php에서 extract로 받은 요청값의 key인 id를 변수로 변환하고, 이를 아래 echo에서 출력했을 때 
    // 이 변수 ($id)에 저장된 값인 sihu가 출력되게 된다. 
    echo $id; // 그 요청에서 받은 $id를 출력한다
});

