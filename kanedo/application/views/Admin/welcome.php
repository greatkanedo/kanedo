

    <div class="page-container">
        <p class="f-20 text-success">欢迎使用 <span class="f-14">v3.0</span>后台管理！</p>
        <p>登录次数：<?php echo ++$uinfo['login_num']; ?> </p>
        <p>上次登录IP：
            <?php echo long2ip($uinfo['last_login_ip']); ?> 上次登录时间：
            <?php echo date('Y-m-d H:i:s', $uinfo['last_login_time']); ?>
        </p>
        <table class="table table-border table-bordered table-bg">
            <thead>
                <tr>
                    <th colspan="7" scope="col">信息统计</th>
                </tr>
                <tr class="text-c">
                    <th>统计</th>
                    <th>资讯库</th>
                    <th>图片库</th>
                    <th>产品库</th>
                    <th>用户</th>
                    <th>管理员</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-c">
                    <td>总数</td>
                    <td>92</td>
                    <td>9</td>
                    <td>0</td>
                    <td>8</td>
                    <td>20</td>
                </tr>
                <tr class="text-c">
                    <td>今日</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr class="text-c">
                    <td>昨日</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr class="text-c">
                    <td>本周</td>
                    <td>2</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr class="text-c">
                    <td>本月</td>
                    <td>2</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-border table-bordered table-bg mt-20">
            <thead>
                <tr>
                    <th colspan="2" scope="col">服务器信息</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th width="30%">服务器计算机名</th>
                    <td><span id="lbServerName"><?php echo $server['server_name']; ?></span></td>
                </tr>
                <tr>
                    <td>服务器IP地址</td>
                    <td>
                        <?php echo $server['server_ip']; ?>
                    </td>
                </tr>
                <tr>
                    <td>服务器域名</td>
                    <td>
                        <?php echo $server['host']; ?>
                    </td>
                </tr>
                <tr>
                    <td>服务器端口 </td>
                    <td>
                        <?php echo $server['port']; ?>
                    </td>
                </tr>
                <tr>
                    <td>PHP版本 </td>
                    <td>
                        <?php echo $server['php_info']; ?>
                    </td>
                </tr>
                <tr>
                    <td>服务器操作系统 </td>
                    <td>
                        <?php echo $server['server_os']; ?>
                    </td>
                </tr>
                <tr>
                    <td>服务器的语言种类 </td>
                    <td>
                        <?php echo $server['server_lang']; ?>
                    </td>
                </tr>
                <tr>
                    <td>服务器当前时间 </td>
                    <td>
                        <?php echo date('Y-m-d H:i', time()); ?>
                    </td>
                </tr>
                <tr>
                    <td>服务器上次启动到现在已运行 </td>
                    <td>
                        <?php echo $server['run_time'] ? $server['run_time'] : date('Y-m-d H:i', time()); ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
