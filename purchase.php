<?php
  date_default_timezone_set('Asia/Taipei');
  session_start();
  require_once 'php/db.php';
  require_once 'php/function.php';
  require_once 'php/bomb.php';
  $user = getthisuser($link,$_SESSION['id']);
  //$project_info = getprojectinfo($link);
  
  $sql = "select `count` from `count`";
  $result = mysqli_query($link,$sql);
  if($result){
	while($row = mysqli_fetch_array($result)){
      $count = $row['count'];
  	}
	mysqli_free_result($result);
  }
  if($count >= 5){
  	$content = "禮包";
	$base = rand(100,250);
	$seller = "電腦";
	$now = date("Y-m-d H:i:s");
	//echo $now;
	$now = strtotime($now);
	$expire = $now + 1000;
	$expire = date("Y-m-d H:i:s",$expire);
  	$sql = "INSERT INTO `sell` (`content` , `base` ,`seller` ,`expire`) value ('{$content}' , '{$base}' , '{$seller}' , '{$expire}')"; 
	$result = mysqli_query($link,$sql);
	if($result){
	  if(!isset($data['id'])){
		$new_id = mysqli_insert_id($link);
		//echo "執行成功，新增後的ID為{$new_id}";
	  }
    }
	else{
	  echo "{$sql}語法執行錯誤";
	}
	$count = 1;
	$sql = "update `count` set `count` = '{$count}' where `id` = '1'"; 
    $result = mysqli_query($link,$sql);
  }
  $data = getallsell($link);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>競標平台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <?php if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true):?>
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
          <span class="logo-lg">競標平台</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav nav-pills">
		      <a href="php/logout.php" class="btn btn-primary btn-xs">會員登出</a> 
		    </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <li>
              <a href="index.php"><img src="1481117726_go-home.png" width="26" height="26" alt="1"> <span>首頁</span>
              </a>
            </li>
            <li>
              <a href="purchase.php"><img src="1481117390_auction_hammer_gavel.png" width="26" height="26" alt="2"><span>競標</span></a>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>競標</h1>
			<div class = "pull-right">
	 		  <ul class="nav nav-pills">
			    <a href="purchaseadd.php" class="btn btn-primary btn-xs">新增商品<span class="glyphicon glyphicon-plus"></span></a> 
			  </ul>
			</div>
        </section>

        <!-- Main content -->
        <section class="content">
        	<?php
        	  if(isset($_GET['good'])){
        	  	if($_GET['good'] == 1){
        	  		echo "<script>alert('出價成功~~');</script>";
        	  	}
                elseif($_GET['good'] == 2){
                  echo "<script>alert('您要檢查一下您競標的價格是否高於目前最高價唷~~');</script>";
                }
				elseif($_GET['good'] == 3){
                  echo "<script>alert('您要檢查一下您競標的價格是否高於底價唷~~');</script>";
                }
				elseif($_GET['good'] == 4){
                  echo "<script>alert('您要檢查一下您有足夠金額唷~~');</script>";
                }
				elseif($_GET['good'] == 5){
                  echo "<script>alert('您要檢查一下您有足夠金額唷~~');</script>";
                }
        	  }
        	?>
          <?php if(!empty($data)):?> 
          					    	
		    <table class="table table-bordered table-hover dataTable" style="width:80%;background-color: #ffffff">
              <tr>
              	<td><b>卡片</b></td>
                <td><b>底價</b></td>
                <td><b>最高得標者</b></td>
                <td><b>最高得標價</b></td>
                <td><b>競標</b></td>
                <td><b>剩餘時間</b></td>
              </tr>                  
              <?php foreach($data as $row):?>
              	<?php if($row['content'] != null):?>                            	
		   	    <tr>
               	  <td><?php echo $row['content']?></td>
                  <td><?php echo $row['base'].'元';?></td>
                  <td>
                  	<?php
                  	  if($row['buy'] != null){
                  	  	echo $row['buy'];
                  	  }
					  else{
					  	echo "尚未有人出價唷~";
					  }
                  	?>
                  </td>
                  <td>
                  	<?php
                  	  if($row['buy'] != null){
                  	  	echo $row['money'].'元';
                  	  }
					  else{
					  	echo "尚未有人出價唷~";
					  }
                  	?>
                  </td>
                  <td>
                  	<?php
                  	  date_default_timezone_set('Asia/Taipei');
                  	  //echo $row['expire']."<br>";
                  	  $deadline = strtotime($row['expire']);
					  $now = date("Y-m-d H:i:s");
					  //echo $now."<br>";
					  $now = strtotime($now);
					  //echo $now."<br>".$deadline;
                  	  if($deadline > $now){
                  	  	$cardid = $row["id"];
                  	  ?>
                  	  <a href="buy_purchase.php?id=<?php echo $cardid;?>">出價</a><br>
                  	  <?php
                  	  }
					  else{
					  	echo "招標結束囉~下次請早~"; 
			            $id = $row['id'];
						if($row['buy'] != null){
						  $sql = "select `money`,`id` from `member` where `username` = '{$row['buy']}'";
						  $res=mysqli_query($link,$sql) or die("db error");
						  if($res){
	                        while($row1 = mysqli_fetch_array($res)){
                              $buy_money = $row1['money'];//身上現有的錢
                              $buy_id = $row1['id'];
     	                    }
	                        mysqli_free_result($res);
                          }
                          $buy_money = $buy_money - $row['money'];
						  $sql = "update `member` set `money` = '$buy_money' where `username` = '{$row['buy']}'";
						  $res=mysqli_query($link,$sql) or die("db error");
						  
						  if($row['content'] != "禮包"){//there
						    $sql = "select `money` from `member` where `id` = '{$row['seller']}'";
						    $res=mysqli_query($link,$sql) or die("db error");
						    if($res){
	                          while($row2 = mysqli_fetch_array($res)){
                                $seller_money = $row2['money'];
     	                      }
	                          mysqli_free_result($res);
                            }
							$seller_money = $seller_money + $row['money'];
							$sql = "update `member` set `money` = '$seller_money' where `id` = '{$row['seller']}'";
						    $res=mysqli_query($link,$sql) or die("db error");
							
							$sql = "select `num` from `card` where `index` = '{$row['seller']}' and `content` = '{$row['content']}'";
						    $res=mysqli_query($link,$sql) or die("db error");
						    if($res){
	                          while($row3 = mysqli_fetch_array($res)){
                                $seller_num = $row3['num'];
     	                      }
	                          mysqli_free_result($res);
                            } 
                            $seller_num--;
							$sql = "update `card` set `num` = '$seller_num' where `index` = '{$row['seller']}' and `content` = '{$row['content']}'";
						    $res=mysqli_query($link,$sql) or die("db error");
							
							$sql = "select `num` from `card` where `index` = '$buy_id' and `content` = '{$row['content']}'";
						    $res=mysqli_query($link,$sql) or die("db error");
						    if($res){
						      if(mysqli_num_rows($res) > 0){
	                            while($row4 = mysqli_fetch_array($res)){
                                  $buy_num = $row4['num'];
                                  $buy_num++;
                                  $sql = "update `card` set `num` = '$buy_num' where `index` = '$buy_id' and `content` = '{$row['content']}'";
						          $res=mysqli_query($link,$sql) or die("db error");
     	                        }
     	                      }
							  else{
							  	$buy_num = 1;
								$sql = "insert into `card` (`content`,`index`,`num`) value ('{$row['content']}','$buy_id','$buy_num')";
								$res = mysqli_query($link,$sql);
		                        if($res){
			                      if(!isset($data['id'])){
				                    $new_id = mysqli_insert_id($link);
		   		                    echo "執行成功，新增後的ID為{$new_id}";
			                      }
		                        }
		                        else{
			                      echo "{$sql}語法執行錯誤" . mysqli_error($link);
		                        }
							  }
	                          mysqli_free_result($res);
                            } 
						  }	
                          else{//是禮包
                          	$gift_card[0] = rand(1,8);
						    $gift_card[1] = rand(1,8);
							$gift_card[2] = rand(1,8);
							for($i = 0;$i < 3;$i++){
							  $cardcontent = $gift_card[$i];
							  $sql = "select `num` from `card` where `index` = '$buy_id' and `content` = '$cardcontent'";
						      $res=mysqli_query($link,$sql) or die("db error");
						      if($res){
						        if(mysqli_num_rows($res) > 0){
	                              while($row4 = mysqli_fetch_array($res)){
                                    $buy_num = $row4['num'];
                                    $buy_num++;
                                    $sql = "update `card` set `num` = '$buy_num' where `index` = '$buy_id' and `content` = '$cardcontent'";
						            $res=mysqli_query($link,$sql) or die("db error");
     	                          }
     	                        }
							    else{
							  	  $buy_num = 1;
								  $sql = "insert into `card` (`content`,`index`,`num`) value ('$cardcontent','$buy_id','$buy_num')";
								  $res = mysqli_query($link,$sql);
		                          if($res){
			                        if(!isset($data['id'])){
				                      $new_id = mysqli_insert_id($link);
		   		                      echo "執行成功，新增後的ID為{$new_id}";
			                        }
		                          }
		                          else{
			                        echo "{$sql}語法執行錯誤" . mysqli_error($link);
		                          }
							    }
	                            //mysqli_free_result($res);
                              } 
							}
                          }
						}
			            $sql = "delete from `sell` where `id` = '$id'";
			            $res=mysqli_query($link,$sql) or die("db error");
					  }
                  	  //echo '<a href=buy_purchase.php >出價</a><br>';
                      /*<a href="buy_purchase.php?id=<?php echo $row['id']?>">出價</a> */
                    ?>    
                  </td>
                  <td>
                    <?php
                      
                      $i=0; //counter for bombs
                      $sql="select * from sell  order by id desc;"; //select all bomb information from DB
                      $res=mysqli_query($link,$sql) or die("db error");
                      $arr = array(); //define an array for bombs

                      while($row=mysqli_fetch_assoc($res)) {
                      	if($row['content'] != null){
                      	  $arr[] = $row; //store the row into the array
	                      //generate the image tag, the div tag for timer text. Note on the use of $i in tag ID
	                      echo "<div id='timer$i'>";
	                      $i++; //increase counter	
                      	}
                      }

                    ?>

                    <script>
                    <?php
	                 //print the bomb array to the web page as a javascript object
	                 echo "var myArray=" . json_encode($arr);
                    ?>
                    </script>
                  </td>
                </tr>
                <?php else:?>
                <?php
                  //$card_id = $row['content'];
                  $sql = "delete from `sell` where `content` = '0'";
                  $result = mysqli_query($link,$sql);
                ?>
                <?php endif;?>
                
              <?php endforeach;?>
            </table>
			<?php else:?>
			  <h1>沒資料</h1>
			<?php endif;?>
		  <hr>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- <footer class="main-footer">
        <strong>Copyright &copy;耕雲智慧生活科技有限公司</strong> All rights reserved.
      </footer> -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <?php else:?>
      <?php header("Location:login.php"); ?>
    <?php endif;?>
  </body>
</html>
