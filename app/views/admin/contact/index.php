<section class="container">
    <h1 class="text-center">Контакты</h1>
    <br>
    <div class="text-center">
        <form action="<?= \vfx\Router::getRouteName('admin.contacts.index', 'url') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <p>Номер телефона:</p>
                <input type="text" name="phone" required value="<?= !empty($this->data['contacts']['phone']) ? $this->data['contacts']['phone'] : '' ?>">
            </div>
            <div class="form-group">
                <p>Номер телефона (другой):</p>
                <input type="text" name="phone_other" value="<?= !empty($this->data['contacts']['phone_other']) ? $this->data['contacts']['phone_other'] : '' ?>">
            </div>
            <div class="form-group">
                <p>Email:</p>
                <input type="email" name="email" value="<?= !empty($this->data['contacts']['email']) ? $this->data['contacts']['email'] : '' ?>">
            </div>
            <div class="form-group">
                <p>Telegram:</p>
                <input type="text" name="telegram" value="<?= !empty($this->data['contacts']['telegram']) ? $this->data['contacts']['telegram'] : '' ?>">
            </div>
            <div class="form-group">
                <p>GitHub:</p>
                <input type="text" name="github" value="<?= !empty($this->data['contacts']['github']) ? $this->data['contacts']['github'] : '' ?>">
            </div>
            <div class="form-group">
                <button type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</section>