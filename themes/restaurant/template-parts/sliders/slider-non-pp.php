<?php $row = get_field('slider_row', $args['id']) ?>
<div class="fe-events-slider">
    <?php foreach ($row as $item) { ?>
        <div class="fe-events-slider__item">
            <?php
            $link = $item['related_post'];

            if($item['link_type'] == 'custom_link'){
                $link = $item['custom_link']; ?>
            <a href="<?php echo $link ?>" class="fe-feed">
            <?php } ?>
                <div class="fe-event__wrapper">
                    <div class="fe-img" style="background-image: url(<?php echo $item['img']['url'] ?>)">
                        <div class="fe-img__overlay">
                            <span>read more</span>
                        </div>
                    </div>
                    <div class="fe-event__bot">
                        <div class="fe-event__content">
                            <span><?php echo $item['title'] ?></span>
                        </div>
                        <div class="fe-event__text">
                            <span><?php echo $item['content'] ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
</div>