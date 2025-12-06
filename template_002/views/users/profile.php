<!-- 프로필 섹션 영역 -->

<section>
    <h2>Profile</h2>
    <?= $id ?>
    

    <form action="/users/profile?id=<?= $id ?>" method="post">
        <!-- page.php에서 user/profile 뒤 extract로 변환한 $id를 사용할 수 있게 함 -->
        <button>Move POST</button>
    </form> 
</section>