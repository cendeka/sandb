<?php $__env->startComponent('boilerplate::card', ['color' => 'info', 'title' => 'TinyMCE']); ?>
    Usage :
    <pre>&lt;x-boilerplate::tinymce name="tinymce">
    &lt;h2>TinyMCE demo&lt;/h2>&lt;p>Lorem ipsum dolor sit amet.&lt;/p>
&lt;/x-boilerplate::tinymce></pre>
    <?php $__env->startComponent('boilerplate::tinymce', ['name' => 'tinymce', 'sticky' => true]); ?>
        <h2>TinyMCE demo</h2><p>Lorem ipsum dolor sit amet.</p>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->slot('footer'); ?>
        <div class="text-right small text-muted">
            <a href="https://sebastienheyd.github.io/boilerplate/components/tinymce" target="_blank">component</a> /
            <a href="https://sebastienheyd.github.io/boilerplate/plugins/tinymce" target="_blank">plugin</a> /
            <a href="https://www.tiny.cloud/docs/" target="_blank">TinyMCE</a>
        </div>
    <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /Users/ilhamtaufiq/www/ams/vendor/sebastienheyd/boilerplate/src/resources/views/plugins/demo/tinymce.blade.php ENDPATH**/ ?>