<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>订单详情</title>
		<link rel="stylesheet" href="../css/bass.css" />
        <link rel="stylesheet" href="../css/common/header.css" />
		<link rel="stylesheet" href="../css/common/icon.css" />
		<link rel="stylesheet" href="../css/common/footer.css" />
		<link rel="stylesheet" href="../css/common/login.css" />
		<link rel="stylesheet" href="../css/common/userInfo.css" />
		<link rel="stylesheet" href="css/orderDetails.css" />
		<script type="text/javascript" src="../js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="JS/cancel.js" ></script>
	</head>
	<body>
<?php
	        include_once '../conn.php';
		    if(isset($_SESSION['flag']) && $_SESSION['flag'] == "shop"){
			    
				
		    }else{
			    header("location:shopLogin.html");
	        }
	    ?>
		<header class="headerBlue">
		  <div class="container bc clearfix ">
			<span class="logoBlue fl"></span>
						<nav class="fl ml30">
               <ul class="navList f0 colorWhite">
               	<li><a href="../index1.html">首页</a></li>
               	<li><a href="shopNewOrder.php">我的订单</a></li>
               </ul>
			</nav>
			<div class="fr">
               <ul class="loginList f0">
                  <li id="shopName" class="pr">
               		<a href="shopInfo/shopLogin.html">
               			<?php
               				include_once '../conn.php';
               				if(isset($_SESSION['username'])){
               				    echo $_SESSION['username'];
               			    }else{
               			    	echo "";
               			    } 
               		    ?>
               		</a>
               		<span class="dib listIcon w15 h15"></span>
               		<ul class="loginListDetalist f14 pa tc none">
               			<li><a href="shopInfo.php">店铺信息</a></li>
               			<li><a href="shopNewOrder.php">我的订单</a></li>
               			<li><a href="shopProductInfo.php">商品管理</a></li>
               			<li class="cancel"><a href="javascript: void(0);">退出</a></li>
               		</ul>
               	  </li>
               </ul>
			</div>
		  </div>
		</header>
		<div class="container bc clearfix mt50 mb20">
            <ul class="userInfoList fl mt20 ml50">
                <li>
                	店铺信息
                	<ul class="userInfoList-item">
                		<li><a href="shopInfo.php">基本信息</a></li>
                		<li><a href="shopEidtInfo.php">修改信息</a></li>
                	</ul>
                </li>
                <li>
                	我的订单
                	<ul class="userInfoList-item">
                		<li><a href="shopNewOrder.php">新的订单</a></li>
                		<li><a class="active" href="shopLssueOrder.php">发出的订单</a></li>
                		<li><a href="shopHistoryOrder.php">历史订单</a></li>
                	</ul>
                </li>
                <li>
                	商品管理
                	<ul class="userInfoList-item">
                		<li><a href="shopProductInfo.php">商品信息</a></li>
                		<li><a href="addProduct.php">添加商品</a></li>
                	</ul>
                </li>
			</ul>
			<?php
				$userName=$_SESSION['username'];
				$bh = $_GET['bh'];
                
              		$stmt=$mysqli->stmt_init();
                    $sql ="select m.status,m.time,m.money,m.remarks,s.logo,s.store_name,s.shop_name,s.shop_tel,s.psf,u.name,u.sex,u.tel,u.addr,u.addrDetails from myorder as m inner join shop as s on m.shop_name = s.shop_name inner join user_addr as u on m.addr_id = u.id where m.shop_name='$userName' and bh='$bh'";
                    if($stmt->prepare($sql)){
	                    $stmt->execute();
	                    $stmt->bind_result($status,$time,$money,$remarks,$logo,$storeName,$shopName,$shopTel,$psf,$name,$sex,$tel,$addr,$addrDetails);
	                    while ($stmt->fetch()) {
	                    	
	                    }
	                   $stmt->close();
                    }
   
            ?>
			<div class="main fr f14 clearfix">
				<h1 class="f18">订单详情</h1>
				<ul class="statusBar clearfix pl50 pr50 pb30 ">
					<li class="w200 pr <?php if($status==0){echo "active";}?>">
						订单已提交
						<span class="circular pa"></span>
					</li>
					<li class="w600 pr <?php if($status==1){echo "active";}?>">
						商家已接单
						<span class="circular pa"></span>
					</li>
					<li class="w50 pr <?php if($status==2){echo "active";}?>">
						<span>已送达</span>
						<span class="circular pa"></span>
					</li>
				</ul>
				<div class="prompt mt20 pl30 pt20">
					<h2 class="fc3 f16 pb10">
						<?php 
							switch($status){
								case 0: 
								echo "已支付";
								break;
								case 1:
								echo "已发货";
								break;
								case 2:
								echo "已完成";
								break;
							}
						?>
					</h2>
					<p class="fc9 pb10">
						<?php
							echo $time;
							switch($status){
								case 0: 
								echo "支付";
								break;
								case 1:
								echo "发货";
								break;
								case 2:
								echo "确认送达";
								break;
							}
						?>
					</p>
				</div>
				<div class="orderDetails clearfix mt20">
					<div class="orderDetails-hdInfo clearfix p30 pt20 pb15">
						<a class="fl mr10" href="../shop.php?shopname=<?php echo $shopName;?>">
						    <img src="../image/shop/<?php echo $logo; ?>">
						</a>
						<div class="hdInfo-left fl">
						 	<h3 class="f16 mb5"><?php echo $storeName;?></h3>
						 	<p class="fc9">
						 		<span class="mr50">订单号：<?php echo $bh;?></span>
						 		<span>商家电话：<?php echo $shopName;?> / <?php echo $shopTel;?></span>
						 	</p>
						</div>
						<div class="hdInfo-right fr">
						 	<span class="collection fc5">已收藏</span>
						</div>
					</div>
					<div class="orderDetails-leftInfo fl pb15 w500">
						<table class="w">
							<thead>
								<tr class="h50">
									<th class="tl pl30 ">菜品</th>
									<th class="tc">数量</th>
									<th class="tr pr30 ">小计</th>
								</tr>
							</thead>
							<tbody class="fc6">
								<?php              		
									$stmt=$mysqli->stmt_init();
                                    $sql ="select o.num,p.product_name,p.product_money from order_dli as o inner join product as p on o.product_id=p.id where bh='$bh'";
                                    if($stmt->prepare($sql)){
	                                    $stmt->execute();
	                                    $stmt->bind_result($num,$productName,$productMoney);
	                                    while ($stmt->fetch()) {
	                            ?>        	
	                            <tr class="h60">
									<td class="tl pl30"><?php echo $productName;?></td>
									<td class="tc"><?php echo $num;?></td>
									<td class="tr pr30"><?php echo $productMoney;?></td>
								</tr>
	                    	    <?php
	                                    }
	                                    $stmt->close();
                                    }
									$mysqli->close(); 
								?>

								<tr class="h60">
									<td class="tl pl30">配送费</td>
									<td class="tc"></td>
									<td class="tr pr30">￥<?php echo $psf;?></td>
								</tr>
							</tbody>
							<tfoot>
								<tr class="h80">
									<td class="tr pr30" colspan="3">
										实际支付：
										<span class="num">￥<?php echo $money;?></span>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="orderDetails-rightInfo fr pl30 pr30">
						<div class="rightInfo-userInfo pt15 pb15">
                            <p class="f0">
                            	<span class="dib f14">联&nbsp;系&nbsp;人:</span>
                            	<span class="w317 dib f14"><?php echo $name;?>(<?php echo $sex;?>)</span>
                            </p>
                            <p class="f0">
                            	<span class="dib f14">联系电话:</span>
                            	<span class="w317 dib f14"><?php echo $tel;?></span>
                            </p>
                            <p class="clearfix">
                            	<span class="fl">联系地址:</span>
                            	<span class="w317 fr"><?php echo $addr.$addrDetails;?></span>
                            </p>
						</div>
						<div class="rightInfo-comment pt15 pb15">
							<p class="f0">
								<span class="dib f14">发票信息:</span>
								<span class="w317 dib f14">无发票</span>
							</p>
							<p class="clearfix">
								<span class="fl">备注信息:</span>
								<span class="w317 fr"><?php echo $remarks;?></span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
        <footer class="footer h150 tc">
 	        <address class="addr pt20 pb10">
 		        <span>季显靖</span>
 		        <span>40214157</span>
 		        <span>网工14101</span>
 		        <span>15729520405</span>
 	        </address>
 	        <span class="fca">copyright&copy2017-2018</span>
        </footer>
        <script>
        	cancel();
        </script>
	</body>
</html>
