<?php
    get_header();
?>
    <div class="slider">
        <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:810px;height:300px;overflow:hidden;visibility:hidden;background-color:#000000;">
            <!-- Loading Screen -->
            <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);z-index:10;">
                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
            </div>
            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height:300px;overflow:hidden;">
            <a data-u="any" href="http://www.jssor.com" style="display:none">List Slider</a>
                <?php
                    $slider = new WP_Query([
                        'post_type' => 'slider',
                    ]);
                    while($slider->have_posts()){
                        $slider->the_post();
                        echo get_field('slider-music');
                        ?>
                        <div class="slider-img" data-id="<?php echo get_the_ID();?>">
                            <source id="music-slide" src="http://localhost/eventx/wp-content/uploads/2020/10/Armin-van-Buuren-This-Is-What-It-Feels-Like-Official-Music-Video.mp3">
                            <img data-u="image" src="<?php echo get_the_post_thumbnail_url(); ?>" />
                            <div data-u="thumb">
                                <img class="i" src="<?php echo get_the_post_thumbnail_url();  ?>" />
                                <div class="t">Carousel</div>
                                <div class="c">Touch swipe, mobile device optimized</div>
                            </div>
                        </div>
                    <?php }
                ?>
            </div>
            <!-- Thumbnail Navigator -->
            <div data-u="thumbnavigator" class="jssort11" style="position:absolute;right:5px;top:0px;font-family:Arial, Helvetica, sans-serif;-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;width:200px;height:300px;" data-autocenter="2">
                <!-- Thumbnail Item Skin Begin -->
                <div data-u="slides" style="cursor: default;">
                    <div data-u="prototype" class="p">
                        <div data-u="thumbnailtemplate" class="tp"></div>
                    </div>
                </div>
                <!-- Thumbnail Item Skin End -->
            </div>
            <!-- Arrow Navigator -->
            <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
            <span data-u="arrowright" class="jssora02r" style="top:0px;right:218px;width:55px;height:55px;" data-autocenter="2"></span>
        </div>
    </div>
    <div class="boxes">
        <div class="box">
            <div class="left save">
                <?php 
                    $today = date('Y-m-d H:i:s');
                    $eventDate = new WP_Query([
                        'post_type' => 'event-date',
                        'posts_per_page' => 1,
                        'meta_key' => 'event_date',
                        'orderby' => 'event_date',
                        'order' => 'ASC',
                        'meta_query' => [
                            [
                              'key' => 'event_date',
                              'compare' => '>=',
                              'value' => $today,
                              'type' => 'numeric'
                          ]
                        ]
                    ]);
                    while($eventDate->have_posts()){
                        $eventDate->the_post();
                        $eventID = get_the_ID();
                        $dateTime = new DateTime(get_field('event_date')); ?>
                        <div class="save-the-date">Save the Date</div>
                        <div class="date-count-down">
                            <div class="date-section day"></div>
                            <div class="date-section hour"></div>
                            <div class="date-section minute"></div>
                            <div class="date-section second"></div>
                        </div>
                                <div class="desc-event event-date">
                            <?php 
                                echo $dateTime->format('l');
                                echo ", ";
                                echo $dateTime->format('d'); 
                                echo " ";
                                echo $dateTime->format('F'); 
                                echo " ";
                                echo $dateTime->format('Y');
                            ?>
                        </div>
                        <div class="desc-event event-place">|
                        <?php
                            $related_place = get_field('event_places');
                            if($related_place){
                                foreach($related_place as $place){?>
                                    <?php echo get_the_title($place);?> |
                            <?php }
                    }
                } ?>
                </div>
            </div>
            <div class="left ticket">
                <?php
                    wp_nav_menu([
                        'theme_location' => 'buy_ticket'
                    ]);
                ?>
            </div>
        </div>
        <div class="box-news">
            <div class="new-section">News</div>
            <div class="news">
                <?php
                    $new = new WP_Query([
                        'post_type' => 'new',
                        'posts_per_page' => 3,
                    ]);

                    while($new->have_posts()){
                        $new->the_post(); ?>
                        <div class="new">
                            <div class="new-date-circle">
                                <div class="month"><?php the_time('M')?></div>
                                <div class="date"><?php the_time('d');?></div>
                            </div>
                            <div class="new-title"><?php the_title();?></div>
                            <div class="new-content">
                                <?php echo wp_trim_words(get_the_content(), 15);?>
                                <a class="read-more" data-id="<?php the_ID();?>">read more...</a>
                            </div>
                        </div>
                        
                    <?php }
                ?>
            </div>
        </div>
    </div>
    <div class="background">
        <div class="overlay">
            <div class="close-btn">
                <div class="close"></div>
                <div class="close"></div>
                <div class="close"></div>
            </div>
            <div class="content"></div>
        </div>
    </div>
<?php
    get_footer();
?>