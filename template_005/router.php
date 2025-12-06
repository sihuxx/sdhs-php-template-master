<?php

// $this 는 new class 선언한 instance 대상
// self 는 class 대상
class Router
{
    static $routes = []; // 등록된 모든 라우트 (GET/POST) 를 저장하는 정적 배열
    // 예: [ ['GET','/login', handler], ['POST','/join', handler] ]
    static function path($method, $uri, $handler) // 새로운 라우트 경로 추가하는 메소드  
    {
        // 숫자 외 ID 같은 요소도 들어갈 수도 있음
        // {id} 처럼 중괄호 형태의 구간을 정규식으로 변경
        // 예: /user/{id} → /user/([^\/]+)  (숫자/문자 어떤 값도 매칭 가능)

        $uri = preg_replace('#\{(.*?)\}#', '([^\/]+)', $uri);
        // preg_replace(패턴, 대체문자, 대상문자열);
        // `\{(.*?)\}` => `{}` 안에 들어있는 모든 문자열을 변수처럼 인식해서 찾는다.
        // `([^\/]+)`  => 찾아낸 문자열을 `/`만 아니면 어떤 문자열이든 하나 이상 매칭되는 값으로 바꾼다.
        // 대상 문자열 $uri에 저장한다
        // => /user/{id} 같은 URI를 실제로 매칭 가능한 /user/숫자/문자 형태로 바꿔주는 역할

        self::$routes[] = [$method, "#^$uri$#", $handler]; // 함수 실행 시 매개변수로 받은 요소들을 라우트 배열에 추가한다  

    }

    static function handleRequest() // 실제 요청이 들어오면 해당 경로와 메소드를 찾아 실행시키는 메소드 
    {
        // $_SERVER => PHP가 실행될 때 자동으로 채워지는 서버 정보 모음
        $REQUEST_METHOD = $_SERVER['REQUEST_METHOD']; // 현재 요청된 서버 메소드 형태를 가져옴 (GET/POST)
        $REQUEST_URI = $_SERVER['REQUEST_URI']; // 현재 실행된 서버의 URL 주소를 가져옴

        foreach (self::$routes as $route) { // 완쪽 배열에서 등록된 모든 라우트를 하나씩 검사해서 오른쪽 배열에 저장

            [$method, $uri, $handler] = $route; // 배열에 저장된 메소드, 주소, 실행할 함수들을 $route 변수에 새로 저장

            if ($method !== $REQUEST_METHOD) continue; // 서버의 요청 방식과 등록된 요청 방식이 다르면 패스
            if (preg_match($uri, $REQUEST_URI, $matches)) {
                // preg_match(패턴, 문자열, 결과배열) => 문자열이 정규식 패턴과 일치하는지 검사하고, 일치하면 그 안에서 필요한 값들을 추출하는 함수;
                // 위에서 만든 정규식 $uri와
                // 사용자가 현재 요청한 주소를 문자열로 받아서
                // 받은 두 값을 비교하여 문자열이 일치한 부분만 따로 추출하여 $match에 저장함

                array_shift($matches); // 첫번째 값은 전체문자열 => 필요 X, 제거
                // array_shift() => 배열의 첫 번째 요소를 제거하고 그 값을 반환

                return call_user_func_array($handler, $matches);
                // call_user_func_array => 배열에 들어 있는 값들을 함수의 인자로 넣어서 실행시키는 함수.
                // call_user_func_array( 함수 , 배열 )
                /* 
                    => $handler라는 함수를 $matches 배열 안에 있는 값들을 인자로 넣어서 실행하는 것
                */
    
                // preg_match() 함수 작동 후 match에 저장된 배열의 값을 $handler의 함수의 인자로 넣는다,
                // => $handler($match 배열 안 값)을 반환한다.

                // function GET($uri, $handler) => 여기서 $handler는 $handler($match 배열 안 값)고
                // GET("/users/{id}", function($id) => function($id)로 변환된다.
            }
        }

        // preg_match() 예시$uri = "#^/users/([^/]+)$#";

        /* $REQUEST_URI = "/users/sihoo";
        preg_match($uri, $REQUEST_URI, $matches); */

        /*  실행 결과 
        $matches = [
            "/users/sihoo", // [0] 전체 문자열
            "sihoo"         // [1] 캡처된 값 = {id}에 해당
        ]; */

        echo "URI : " . $REQUEST_URI . " 404 Not Found"; // 등록된 라우트가 없으면 404 출력
    }
}

// 라우트 등록 쉽게 만들어주는 함수

function GET($uri, $handler) // GET 요청 라우트 등록 함수
{
    Router::path('GET', $uri, $handler);
    // path에 받는 매개변수의 메소드 자리에 GET을 집어넣은 후 남은 칸은 매개변수로 받을 수 있게 등록
}
function POST($uri, $handler) // POST 요청 라우트 등록 함수
{
    Router::path('POST', $uri, $handler); // path에 받는 매개변수의 메소드 자리에 POST를 집어넣은 후 남은 칸은 매개변수로 받을 수 있게 등록
}
