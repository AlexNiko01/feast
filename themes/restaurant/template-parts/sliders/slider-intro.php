<?php $row = get_field('slider_row', $args['id']); ?>
<div class="intro-slider">
    <?php foreach ($row as $key => $item) : ?>
        <div class="intro-slider__item">
            <img src="<?php echo $item['img']['url'] ?>" alt="<?php echo $item['img']['alt'] ?>r">
        </div>
    <?php endforeach; ?>

</div>