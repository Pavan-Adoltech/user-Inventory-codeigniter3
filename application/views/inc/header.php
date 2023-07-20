<!DOCTYPE html>
<head>

<style>
body {
  background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQhZQMoZ71ID1P3lHnfupkI1cXAMwytjjdUQ&usqp=CAU') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}



.navbar ul li { 
	padding: 0px 20px; 
 }   
table, th, td {    
border: 1px solid black;  
margin-left: auto;  
margin-right: auto;  
border-collapse: collapse;    
width: 500px;  
text-align: center;  
font-size: 20px;  
}    


.btn{
margin-left:10px;
}
</style>


    <title>Products</title>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
</head>



<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?=site_url('main/product')?>">Products</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?=site_url('main/product')?>">Home <span class="sr-only">(current)</span></a>
      </li>
    
      <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action on Your products
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="add_item">Add_item</a>
    <a class="dropdown-item" href="update_item">update_item</a>
    <a class="dropdown-item" href="delete_item">Delete_item</a>
  </div>
</div>

<button type="submit" class="btn btn-primary" onclick="window.location.replace('sales');">view the added products</button>

    

    </ul>
    <button type="submit" class="btn btn-primary" onclick="window.location.replace('logout');">Logout</button>
   
    <button type="submit" class="btn btn-primary" onclick="window.location.replace('sale_list');">view history</button>

    <form class="form-inline my-2 my-lg-0" action="" method="get">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

