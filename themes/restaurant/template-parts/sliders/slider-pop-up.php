<?php $row = get_field('slider_row', $args['id']) ?>
<div class="fe-events-slider">
    <?php foreach ($row as $key => $item) { ?>
        <div class="fe-events-slider__item">

            <div href="#" class="fe-event fe-feed pop-up-active" data-toggle="modal"
               data-target="#myModal-<?php echo $key; ?>">
                <div class="fe-event__wrapper">
                    <div class="fe-img" style="background-image: url(<?php echo $item['img'] ?>)">
                        <div class="fe-img__overlay">
                            <span>read more</span>
                        </div>
                    </div>
                    <div class="fe-event__bot">
                        <div class="fe-event__name">
                            <span><?php echo $item['title'] ?></span>
                        </div>
                        <div class="fe-event__location">
                            <span><?php $item['content'] ?></span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    <?php } ?>
</div>

<?php foreach ($row as $key => $item) { ?>
    <?php $relatedPost = $item['related_post'][0] ?>
    <div class="modal fade" id="myModal-<?php echo $key ?>" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <article class="fe-article fe-article-pp">
                    <img class="fe-article__img"
                         src="<?php echo get_the_post_thumbnail_url($relatedPost->ID) ?>" alt="">
                    <h4 class="fe-article__sub-title"><?php the_field('sub_title', $relatedPost->ID) ?></h4>
                    <h2 class="fe-article__title"><?php echo $relatedPost->post_title; ?></h2>
                    <span class="fe-article__date">PROMOTION DATE:  <?php the_field('start_date', $relatedPost->ID) ?> | <?php the_field('end_date', $relatedPost->ID) ?></span>
                    <div class="fe-article__excerpt">
                        <p><?php echo $relatedPost->post_excerpt; ?></p>
                    </div>
                </article>
            </div>
            <a type="button" class="close-thin" data-dismiss="modal"></a>
        </div>
    </div>
</div>
<?php } ?>