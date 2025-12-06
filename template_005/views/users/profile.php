<!-- 프로필 페이지 -->

<section>
    <h2>Profile</h2>
    <?= $id ?>

    <form action="/users/profile/<?= $id ?>" method="post">
        <button>Move POST</button>
    </form>
</section>