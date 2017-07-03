
  <div class="heightblock"></div>
  <!-- ============================ Content =========================== -->
  
  <section id="intro">
    <div class="container">
      <?php foreach($data as $val): ?>
      <div class="row">
        <div class="col-md-8 col-md-offset-2 opening-statement">
          <div class="col-md-4">
            <h3><a href="detail/<?php echo $val['id']; ?>"><?php echo $val['title']; ?></a></h3>
            <span> <span class="post-meta">
            <time datetime="<?php echo date('Y-m-d H:i:s', $val['add_time']); ?>" itemprop="datePublished">   <?php echo date('Y-m-d H:i:s', $val['add_time']); ?>
            </time>
            | <?php 
                        foreach ($cate as $v):
                            if ($val['pid'] == $v['id']):
                              echo '<a href="tags/'.$v['id'].'">';
                              echo $v['cat_name'];
                            endif;
                        endforeach;
                  ?></a> | <br><span>浏览数:(<?php echo $val['views']; ?>)</span> </span> </span> </div>
          <div class="col-md-8">
          <?php
              echo cut_html_str($val['content'], 60, '...', 'utf-8');
          ?>
            <p class="pull-right readMore"> <a href="/detail/<?php echo $val['id']; ?>">Read More...</a> </p>
          </div>
          <div class="clearfix"></div>
          <hr class="nogutter">
        </div>
      </div>
      <?php endforeach; ?>

      <?php if (isset($data[6])): ?>
        <ul class="pagination">
          <li class="disabled"><span>&laquo;</span></li>
          <li class="active"><span>1</span></li>
          <li><a href="@page=2">2</a></li>
          <li><a href="@page=3">3</a></li>
          <li><a href="@page=4">4</a></li>
          <li><a href="@page=5">5</a></li>
          <li><a href="@page=6">6</a></li>
          <li><a href="@page=7">7</a></li>
          <li><a href="@page=2" rel="next">&raquo;</a></li>
        </ul>
      <?php endif; ?>
      
    </div>
  </section>

  <section id="statement">
    <div class="container text-center wow fadeInUp" data-wow-delay="0.5s">
      <div class="row">
        <p><?php echo $option['info']; ?></p>
      </div>
    </div>
  </section>

  <a href="" class="fancybox"></a>
  <!-- ============================ END Content =========================== --> 
</div>