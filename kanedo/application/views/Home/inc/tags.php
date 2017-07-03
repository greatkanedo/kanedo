<div class="heightblock">
</div>
<!-- // End height spacing helper -->
<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            <div class="row boxes">
            <?php foreach($data as $key => $val): ?>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
                        <h4 class="title">
                            <a href="/detail/<?php echo $val['id']; ?>">
                                <?php echo $val['title']; ?>
                            </a>
                        </h4>
                        <p>
                            <time datetime="<?php echo date('Y-m-d H:i:s', $val['add_time']); ?>">
                                <a href="/detail/<?php echo $val['id']; ?>">
                                    <?php echo date('Y-m-d H:i:s', $val['add_time']); ?>
                                </a>
                            </time>
                        </p>
                    </div>
                <?php if( $key % 4 == 4 && $key != 0 ): ?>
                </div>
                <div class="row boxes">
                <?php endif; ?>
            <?php endforeach; ?>
            </div>
                <!-- 
                <div class="row boxes">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
                        <h4 class="title"><a href="/detail/9/">第一次安装laravel（windows集成环境下）</a></h4>
                        <p>
                            <time datetime="2016-08-22 07:53:38"><a href="/detail/9/">2016-08-22 07:53:38</a></time>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
                        <h4 class="title"><a href="/detail/11/">laravel 邮件发送</a></h4>
                        <p>
                            <time datetime="2016-08-23 12:03:38"><a href="/detail/11/">2016-08-23 12:03:38</a></time>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
                        <h4 class="title"><a href="/detail/12/">laravel new blog 异常</a></h4>
                        <p>
                            <time datetime="2016-08-24 07:59:36"><a href="/detail/12/">2016-08-24 07:59:36</a></time>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
                        <h4 class="title"><a href="/detail/21/">【转】Redis 三十个实例</a></h4>
                        <p>
                            <time datetime="2016-08-31 10:37:38"><a href="/detail/21/">2016-08-31 10:37:38</a></time>
                        </p>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</section>
