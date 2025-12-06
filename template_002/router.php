<?php

// $this 는 new class 선언한 instance 대상
// self 는 class 대상
class Router 
{
    static $routes = []; // 등록된 모든 라우트 (GET/POST) 를 저장하는 정적 배열
    // 예: [ ['GET','/login', handler], ['POST','/join', handler] ]

    static function path($method, $uri, $handler) // 새로운 라우트 경로 추가하는 메소드 
    // => 매개변수로 메소드, 주소, 실행할 함수를 넣어주고
    {
        self::$routes[] = [$method,$uri, $handler]; // 함수 실행 시 매개변수로 받은 요소들을 라우트 배열에 추가한다
    }

    static function handleRequest() // 실제 요청이 들어오면 해당 경로와 메소드를 찾아 실행시키는 메소드
    {
        // $_SERVER => PHP가 실행될 때 자동으로 채워지는 서버 정보 모음
        
        $REQUEST_METHOD = $_SERVER['REQUEST_METHOD']; // 서버의 메소드 형태 (GET/POST) 를 가져옴
        $REQUEST_URI = explode("?",$_SERVER['REQUEST_URI'])[0]; // 서버의 접속한 URL 주소를 가져옴 
        // explode() => 문자열 자르는 함수 :: explode("?", "user?id=10") => ["user", "id=10"][0] 결과 => user 
        
        foreach (self::$routes as $route) // 완쪽 배열에서 등록된 모든 라우트를 하나씩 검사해서 오른쪽 배열에 저장
        {
            [$method, $uri, $handler] = $route; // 배열에 저장된 메소드, 주소, 실행할 함수들을 $route 변수에 새로 저장

            if($REQUEST_METHOD !== $method) continue; // 서버의 요청 방식과 등록된 요청 방식이 다르면 패스
            if($REQUEST_URI === $uri){ // 서버의 주소와 등록된 주소가 같다면 (URI가 일치하면)
                return $handler(); // handeler 함수 실행 후 종료
            }
        }

        echo "URI : " .$REQUEST_URI . " 404 Not Found"; // 등록된 라우트가 없으면 404 출력
    }
}

// 라우트 등록 쉽게 만들어주는 함수

function GET($uri,$handler){ // GET 요청 라우트 등록 함수
    Router::path('GET',$uri,$handler);
    // path에 받는 매개변수의 메소드 자리에 GET을 집어넣은 후 남은 칸은 매개변수로 받을 수 있게 등록
}
function POST($uri,$handler){ // POST 요청 라우트 등록 함수
    Router::path('POST',$uri,$handler); 
    // path에 받는 매개변수의 메소드 자리에 POST를 집어넣은 후 남은 칸은 매개변수로 받을 수 있게 등록
}