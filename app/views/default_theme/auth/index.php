<section class="container text-center section-auth">
    <h2><?= lang('title_login') ?></h2>
    <div class="row">
        <div class="form-login">
            <form action="/login" method="post">
                <div>
                    <input class="item" type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div>
                    <input class="item" type="password" name="password" minlength="6" id="password" placeholder="Password" required>
                </div>
                <div>
                    <button class="create-account" type="submit"><?= lang('title_login') ?></button>
                </div>
            </form>
        </div>
    </div>
</section>