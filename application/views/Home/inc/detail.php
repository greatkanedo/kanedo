<!-- ============================ Start Content =========================== -->
    <section id="intro">
        <div class="container">
            <div class="row col-md-offset-2">
                <div class="col-md-8">
                <span class="post-meta">
                    <time datetime="2016-09-18 06:42:55" itemprop="datePublished">
                        <?php echo date('Y-m-d H:i:s', $data['last_edit_time']); ?>
                    </time>
                    |<i class="icon-tag"> </i>
                </span>
                    <h1><?php echo $data['title']; ?></h1>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <h3><?php echo $data['title']; ?></h3>
                    <?php echo $data['content']; ?>
                <div class="clearfix"></div>
                <hr class="nogutter">
                <span style="color: #19A1F9">欢迎转载,但请附上原文地址哦,尊重原创,谢谢大家 本文地址: <a style="color: #19A1F9" href="/detail/<?php echo $data['id']; ?>"><?php echo base_url().'detail/'.$data['id']; ?></a></span>
                <hr class="nogutter">
            </div>
            <nav class="pagination" role="pagination">
                <a class="pull-left" href="/detail/39/" style="float: left;">
                        ← PHP底层的运行机制与原理
                </a>
                <a class="pull-right" href="/detail/41/">
                        本地搭建gitlab服务 →
                </a>
            </nav>
        </div>
    </section>
    <div class="duoshuo " style="text-align: center">
    <div id="container"></div>
    </div>
<section id="statement">
    <div class="container text-center wow fadeInUp" data-wow-delay="0.5s">
        <div class="row">
            <p><?php echo $option['info']; ?></p>
        </div>
    </div>
</section>
<!-- ============================ END Content =========================== -->