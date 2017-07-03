

<!-- Right List Start -->
<div class="sb-slidebar sb-right sb-style-overlay sb-momentum-scrolling">
  <div class="sb-close" aria-label="Close Menu" aria-hidden="true">
    <img src="/static/images/close.png" alt="Close"/>
  </div>
  <ul class="sb-menu">
        <li><a href="/" class="animsition-link" title="Home">Home</a></li>
    <!-- Dropdown Menu -->
        <li>
            <a class="sb-toggle-submenu">tags<span class="sb-caret"></span></a>
                                <ul class="sb-submenu">
                <?php foreach($cat as $val): ?>
                    <li><a href="/tags/<?php echo $val['id']; ?>" class="animsition-link"><?php echo $val['cat_name']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
<!--         <li>
            <a class="sb-toggle-submenu">Categories<span class="sb-caret"></span></a>
            <ul class="sb-submenu">
                <?php foreach($cat as $val): ?>
                    <li><a href="/tags/<?php echo $val['id']; ?>" class="animsition-link"><?php echo $val['cat_name']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </li> -->
        <li>
            <a class="sb-toggle-submenu">Links<span class="sb-caret"></span></a>
            <ul class="sb-submenu">
                <!-- <li><a href="" target="_blank" class="link">Link</a></li> -->
            </ul>
        </li>
    </ul>
  <ul class="sb-menu secondary">
    <li><a href="monthList" class="animsition-link" title="归档">归档</a></li>
    <li><a href="about" class="animsition-link" title="about">About</a></li>
  </ul>
</div>
<!-- Right List End -->