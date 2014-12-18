<!--<div class="warp_banner index_bg01" id="mainbody">-->
<!--    <div id="slides" class="banner">-->
<!--        <a class="slidesjs-previous slidesjs-navigation" href="#" style="top: 240px;width: 43px;position: absolute;left: 0;z-index: 9999;">-->
<!--            --><?php //echo CHtml::image(Yii::app()->theme->baseUrl . '/image/banner_l.png', '上一页', array('width' => '43', 'height' => '43')); ?>
<!--        </a>-->
<!--        --><?php
//        $i = 0;
//        foreach ($ads as $ad) {
//            $i++;
//            echo <<<EOF
//                <div id="banner_pic_$i">
//                    <a href="{$ad->url}" target="_blank">
//                        <img alt="{$ad->title}" src="{$ad->pic}" width="1180" height="500">
//                    </a>
//                </div>
//EOF;
//        }
//        ?>
<!--        <a class="slidesjs-next slidesjs-navigation" href="#" style="top: 240px;width: 43px;position: absolute;right: 0;z-index: 9999;">-->
<!--            --><?php //echo CHtml::image(Yii::app()->theme->baseUrl . '/image/banner_r.png', '下一页', array('width' => '43', 'height' => '43')); ?>
<!--        </a>-->
<!--    </div>-->
<!--</div>-->
<div>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">

            <?php
            $i = 0;
            foreach ($ads as $ad) {
                $picUrl=$ad->pic;
                $i++;
                if($i==1){?>
                    <div class="item active">
                        <img src="<?php echo $picUrl;?>" alt="...">
                        <div class="carousel-caption">
                            <h3><?php echo $ad->title;?></h3>
                            <p><?php echo $ad->content;?></p>
                        </div>
                    </div>
            <?php }else{?>
                    <div class="item">
                        <img src="<?php echo $picUrl;?>" alt="...">
                        <div class="carousel-caption">
                            <h3><?php echo $ad->title;?></h3>
                            <p><?php echo $ad->content;?></p>
                        </div>
                    </div>
                <?php }}
            ?>
<!--            <div class="item active">-->
<!--                <img data-src="holder.js/2000x500" alt="...">-->
<!--                <div class="carousel-caption">-->
<!--                    <h3>first</h3>-->
<!--                    <p>This is a big</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <img data-src="holder.js/2000x500" alt="...">-->
<!--                <div class="carousel-caption">-->
<!--                    <h3>Second</h3>-->
<!--                    <p>This is a big</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <img data-src="holder.js/2000x500" alt="...">-->
<!--                <div class="carousel-caption">-->
<!--                    <h3>Third</h3>-->
<!--                    <p>This is a big</p>-->
<!--                </div>-->
<!--            </div>-->
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>