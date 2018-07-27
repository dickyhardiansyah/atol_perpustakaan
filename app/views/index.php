<?php include_once('app/views/templates/header.php'); ?>
 
<main class="valign-wrapper" style="height:100%;">
    <div class="container">
        <div class="row">
            <?php for ($i = 0; $i < sizeof($navMenu) - 1; $i++) { ?>
            <div class="col s4">
            <section class="card-panel">
                <span><?php echo $navMenu[$i]['title'] ?></span>
                <ul>
                    <?php foreach ($navSubMenu[$i]['menus'] as $menu) { ?>
                    <li><a href="<?php echo $menu['link'] ?>"><?php echo $menu['title'] ?></a></li>
                    <?php }   ?>
                </ul>
            </section>
            </div>
            <?php } ?>
        </div>
    </div>
</main>

<?php include_once('app/views/templates/footer.php'); ?>