<?php 


POST("/users/profile/{id}",function($id){ // /users/profile/{id}라는 포스트 요청을 받았을 때
    echo '프로필 수정';
    echo $id; // 요청한 사용자의 아이디 출력
});

