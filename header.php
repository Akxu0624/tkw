<?php
session_start();
$database="mydb";
// 创建连接
$conn = new mysqli("localhost", "root", "", $database);
// 检测连接
if ($conn->connect_error) {
    echo "error";
}
$navid=isset($navid)?$navid:0;
$flg=0;
$flg=isset($_SESSION['username'])?1:0;
$name="nouser";

if($flg==1)
{
    $name=$_SESSION['username'];
}

function getJs2($val){
    return "'".$val."'";
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/css1.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="js/jquery-2.2.1.min.js"></script>

</head>
<body>

    <div id="header-wrap">
        <div id="header">
            <img src="img/logo.jpg" alt="#">

            <div class="lg-header">
            </div>

            <div class="ipt-header">
                <form>
                    <input type="text" required placeholder="搜索课程" id="searchCourse">
                    <i class="fa fa-search icon-search" onclick="searchCourse()"></i>
                </form>
            </div>

            <ul class="user-list">
                <li class="user-info">
                    <?php
                    if($_SESSION['username']=="admin"){
                        echo '<a href="Crevise.php">管理中心</a></li><li><a href="admin.php">个人主页</a></li>';
                    }
                    else{
                        echo '<a href="admin.php">个人主页</a></li>';
                    }
                    ?>
                <li class="exit"><a href="#" onclick="return false">退出</a></li>
            </ul>

        </div>
    </div>

    <div id="navbar">
        <ul>
            <li class="nav-vis"><a href="index.php">首页</a></li>
            <li><a href="course.php">课程</a></li>
            <li><a href="community.php">资源</a></li>
        </ul>
    </div>

    <script>
        $(function () {

            var flg=<?php echo $flg; ?>;
            console.log(flg);
            if(flg===1){
                var user=<?php echo getJs2($name) ?>;
                $(".lg-header").empty().append("<img width='50' src='img/<?php
                if(empty($_SESSION['username']))                              //传值判断并进行赋值
                {
                 echo "accountImg/defaultuser.png";
                }
                else{
                  $sql = "SELECT * FROM client WHERE user="."'".$_SESSION['username']."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    if($row['Simg']){
                        echo "accountImg/".$row['Simg'];
                    }
                    else{
                        echo "accountImg/defaultuser.png";
                    }
                }
            }
            else{
                 echo "accountImg/defaultuser.png";
            }
                }
            ?>'>")
                    .append("<span class='user'>"+user+"</span>&nbsp;&nbsp;<i class='fa fa-angle-double-down'></i>");
            }
            else{

                $(".lg-header").empty().append("<a href='login.html'>注册</a>").append('<a href="login.html">登录</a>');
            }

            var nid=<?php echo $navid ?>;
            $('#navbar ul>li').eq(nid).addClass('nav-vis').siblings('li').removeClass('nav-vis');

            //获取user-list
            $(".lg-header i").click(function () {
                $(".user-list").fadeToggle(400);
            })

            //退出事件
            $(".exit").click(function () {
                $.get("server/exit.php");
                location.pathname="Dhk/login.html";
            })


        })

        function searchCourse(){
            var Ckey=document.getElementById("searchCourse").value;
            window.location.href="course.php? Ckey="+Ckey;
        }

    </script>
</body>
</html>