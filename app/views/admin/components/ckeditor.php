<?php if (isset($index) && $index === 1): ?>
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<?php endif; ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const options = {
            removePlugins: 'exportpdf',
            extraPlugins: 'notification',
        };
        <?php if(isset($language['id'])): ?>
        if(document.getElementById("content-<?= $language['id'] ?>") !== null) {
            CKEDITOR.replace("content-<?= $language['id'] ?>", options).on( 'required', function(e) {
                this.showNotification('Заполните это поле!');
                e.cancel();
            });
        }
        if(document.getElementById("content-first-<?= $language['id'] ?>") !== null) {
            CKEDITOR.replace("content-first-<?= $language['id'] ?>", options).on( 'required', function(e) {
                this.showNotification('Заполните это поле!');
                e.cancel();
            });
        }
        if(document.getElementById("content-second-<?= $language['id'] ?>") !== null) {
            CKEDITOR.replace("content-second-<?= $language['id'] ?>", options).on( 'required', function(e) {
                this.showNotification('Заполните это поле!');
                e.cancel();
            });
        }
        if(document.getElementById("content-third-<?= $language['id'] ?>") !== null) {
            CKEDITOR.replace("content-third-<?= $language['id'] ?>", options).on( 'required', function(e) {
                this.showNotification('Заполните это поле!');
                e.cancel();
            });
        }
        <?php endif; ?>

    });
</script>
