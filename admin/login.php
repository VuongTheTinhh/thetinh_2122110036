<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
    <title>Đăng nhập quản trị</title>
    <Style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');
body{
    --border-color: #fff;
    color:#222;
    background-image:   
            linear-gradient(
                200deg, #198F, #AB99FA
            );
    font-family: Poppins;
    min-height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}
a{
    text-decoration: none;
}
.login{
    background-color: #efefef;
    width: 400px;
    text-align: center;
    border: 2px solid var(--border-color);
    border-radius: 30px;
    padding: 50px 30px;
    box-shadow: 0 50px 150px #5553;
    position: relative;
}
.login .title{
    font-size: x-large;
    font-weight: bold;
    margin-bottom: 20px;
}
.login .des{
    margin-bottom: 20px;
}
.login .group{
    background-color: var(--border-color);
    border-radius: 10px;
    height: 50px;
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.login .group input{
    width: 100%;
    height: 100%;
    border: none;
    background-color: transparent;
    padding: 20px;
    font-family: Poppins;
    outline: none;
}
.login .group span{
    color: #777;
    display: flex;
    margin-right: 15px;
    cursor: pointer;
}
.login .group span ion-icon:nth-child(2){
    display: none;
}
.login .recovery{
    text-align: right;
    margin-bottom: 20px;
    font-size: small;
}
.login .signIn button{
    background-color: #FA6A69;
    width: 100%;
    border-radius: 10px;
    height: 50px;
    border: none;
    font-family: Poppins;
    box-shadow: 0 10px 20px #FA6A6999;
    margin-bottom: 40px;
    transition: 0.5s;
    color: #fff;
}
.login .signIn button:active{
    box-shadow: none;
    transform: translateY(5px);
}
.login .or{
    font-size: small;
    margin-bottom: 20px;
    position: relative;
}
.login .or::before,
.login .or::after{
    width: 50px;
    height: 1px;
    background-image:  
        linear-gradient(
            to left, #444, transparent
        );
    content: '';
    position: absolute;
    top: 50%;
    left: 20px;
}
.login .or::after{
    left: unset;
    right: 20px;
    background-image:  
        linear-gradient(
            to right, #444, transparent
        );
}
.login  .list .item img{
    width: 30px;
}
.login .list{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: 40px;
    gap: 20px;
    margin-bottom: 30px;
}
.login .list .item{
    border: 1px solid var(--border-color);
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.login .register{
    font-size: small;
}
.login .recovery a{
    color: #1364cf;
}
    </Style>
</head>
<body>
    <?php
    require_once "../vendor/autoload.php";
    use App\Models\User;
    $error="";
        if(isset($_POST['DANGNHAP'])){
            $username = $_POST['username'];
            $password = sha1($_POST['password']);
            $args = [
                ['password','=', $password],    
                ['roles','=','1'],
                ['status','=',1],               
            ];
            if(filter_var($username, FILTER_VALIDATE_EMAIL)){
                $args[]=['email','=',$username];
             }
             else{
                $args[]=['username','=',$username];
            }
            $user = User::where($args)->first();
            if($user!==null){
                $_SESSION['useradmin']= $username;
                $_SESSION['user_id']= $user->id;
                $_SESSION['name']= $user->name;
                $_SESSION['image']= $user->image;
                header('location:index.php');

            }else{
                $error="Tài khoản không hợp lệ";
            }
        }
    ?>
        <form action="login.php" method="post">
        <div class="swapper mt-5 p-4">
        <div class="login">
		<div class="title">Xin Chào </div>
		<div class="des">
            Chào mừng bạn trở lại !
		</div>
        <div class="mb-3">
            <input class="form-control" type="text" name="username" placeholder="Tên đăng nhập hoặc email" required>
           </div>
           <div class="mb-3">
            <input class="form-control" type="password" name="password" placeholder="Mật khẩu" required>
           </div>
		<div class="recovery">
			<a href="">khôi phục mật khẩu</a>
		</div>
		<div class="signIn">
        <div class="mb-3 text-center">
            <input class="btn btn-success" type="submit" value="Đăng nhập" name="DANGNHAP">
            </div>
            </div>
	
		<div class="or">
            Hoặc tiếp tục với
		</div>
		<div class="list">
			<div class="item">
				<img src="https://cdn1.iconfinder.com/data/icons/google-s-logo/150/Google_Icons-09-512.png" alt="">
			</div>
			<div class="item">
				<img src="https://museumandgallery.org/wp-content/uploads/2020/03/Facebook-Icon-Facebook-Logo-Social-Media-Fb-Logo-Facebook-Logo-PNG-and-Vector-with-Transparent-Background-for-Free-Download.png" alt="">
			</div>
			<div class="item">
				<img src="https://www.iconpacks.net/icons/2/free-twitter-logo-icon-2429-thumb.png" alt="">
			</div>
		</div>
		<div class="register">
        Không phải là thành viên? <a href="">Đăng ký ngay bây giờ</a>
		</div>
        <div class="mb-3">
                <p>chú ý: (*) bắt buộc phải điền thông tin</p>
                <?php if(   $error!=""):?>
                    <p class="text-danger"><?=$error;?></p>
                    <?php endif;?>
            </div>
	</div>

           </div>
        </form>
</body>
</html>