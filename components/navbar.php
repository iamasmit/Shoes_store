<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/navbar.css">
</head>
<body>

<nav class="custom-navbar">
  <a class="navbar-brand" href="index.php">Shoe Store</a>
  <div class="custom-collapse" id="navbarSupportedContent">
    <ul class="custom-nav">
      <li class="custom-nav-item active">
        <a class="custom-nav-link" href="index.php">Home</a>
      </li>
      <li class="custom-nav-item active">
        <a class="custom-nav-link" href="shoes.php">Shoes</a>
      </li>
      <li class="custom-nav-item active">
        <a class="custom-nav-link" href="slides.php">Slides</a>
      </li>
      <li class="custom-nav-item active">
        <a class="custom-nav-link" href="orderhistory.php">Orders History</a>
      </li>
      <li class="custom-nav-item active">
        <a class="custom-nav-link" href="contact.php">Contact Us</a>
      </li>
      <li class="custom-nav-item active">
        <a class="custom-nav-link" href="register.php">Register</a>
      </li>
    </ul>
  </div>
  <ul class="custom-nav nav-user">
    <?php if(isset($_SESSION['loggedIn'])){ ?>
      <li class="custom-nav-item">
        <div class="custom-user-info">
          <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/ffffff/user--v1.png" alt="user--v1"/>
          <h5 class="custom-user-name"><?php echo "".$_SESSION["username"]."" ?></h5>
        </div>
      </li>
    <?php } ?>
    <li class="custom-nav-item bag-img">
      <a href="cart.php"><img width="35px" src="images/bag.png"></a>
    </li>
    <?php if(isset($_SESSION['loggedIn'])){ ?>
      <li class="custom-nav-item">
        <form action="logout.php" method="post">
          <button class="custom-logout-btn" type="submit" name="submit">Logout</button>
        </form>
      </li>
    <?php } else { ?>
      <li class="custom-nav-item active">
        <a class="custom-nav-link" href="login.php">Login</a>
      </li>
    <?php } ?>
  </ul>
</nav>

  
</body>
</html>