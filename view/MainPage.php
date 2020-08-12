<?php $list_of_tasks = db::requestListOfTasks($params);  ?>
<html>
    <head>
        <link rel="stylesheet" href="view/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="view/style/style.css">
        <link rel="stylesheet" href="view/style/style.css">
        <script src="view/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!--Start Header-->
        <header class="header-area">
            <div class = "section">
                <div class = "row header" style = "text-align: center;">              
                    <div class="col" style="background-color: rgb(247, 247, 252); text-align: center;">
                        <a href="#" style="text-decoration: none; color: black;">
                            <h1 class="text-center">List of tasks</h1>
                        </a>
                    </div>
                </div>
            </div>
        </header>
       

        
        <!--Start Main Content-->
        <div class="blog-area section" ></div>
            <div class = "row main_section">
                <!--Start SideBar-->
                <div id = "sidebar" class = "col-sm-3 " style = "padding: 30px; background-color: rgb(245, 245, 245);" >
                    <!--For Admin-->
                    <form action="">
                        <div class="form-group">
                          <label for="email">Login:</label>
                          <input type="email" class="form-control" placeholder="Enter email" id="email">
                        </div>
                        <div class="form-group">
                          <label for="pwd">Password:</label>
                          <input type="password" class="form-control" placeholder="Enter password" id="pwd">
                        </div>
                        <div class="form-group form-check">
                          <!--<label class="form-check-label">
                            <input class="form-check-input" type="checkbox"> Remember me
                          </label>-->
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                
                    <!--New Task-->
                    <a href="#" style = "font-size: 20px;">New Task</a>
                </div>
                

                
                <!--Section with the posts-->
                <div id = "main_content" class = "col-sm-9" style = " padding: 50px;">
                    <div class="container" style="padding: 30px; padding-top: 0px;">
                        <div class = "row" style="text-align: center;">
                            <div class="col-3 sort_item">
                                Sort by
                            </div>
                            <div class="col-3 sort_item">
                                <a href = "#"><img src="view/bootstrap/icons/sort-alpha-up.svg" alt="" width="24" height="24" title="Bootstrap"></a>
                                <span>Email</span>
                                <a href = "#"><img src="view/bootstrap/icons/sort-alpha-down.svg" alt="" width="24" height="24" title="Bootstrap"></a>
                            </div>
                            <div class="col-3 sort_item">
                                <a href = "#"><img src="view/bootstrap/icons/sort-alpha-up.svg" alt="" width="24" height="24" title="Bootstrap"></a>
                                <span>User</span>
                                <a href = "#"><img src="view/bootstrap/icons/sort-alpha-down.svg" alt="" width="24" height="24" title="Bootstrap"></a>
                            </div>
                            <div class="col-3 sort_item">
                                <a href = "#"><img src="view/bootstrap/icons/sort-numeric-up.svg" alt="" width="24" height="24" title="Bootstrap"></a>
                                <span>Stat</span>
                                <a href = "#"><img src="view/bootstrap/icons/sort-numeric-down.svg" alt="" width="24" height="24" title="Bootstrap"></a>
                            </div>
                        </div>
                    </div>
                    
                    <?php for($i = 0; $i < count($list_of_tasks) && $i < 3; $i++) {?>
                    <!--Template Single Post-->
                    <div class = "single-blog-post my_single">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col user_name"> <?php echo $list_of_tasks[$i]['user'].', '.$list_of_tasks[$i]['email'];?></div>
                                </div>
                                <div class="row">
                                    <div class="col text_style">
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list_of_tasks[$i]['text_task'];?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" style="text-align: right;">    
                                <a href="#" style="padding: 15px; padding-right: 20px">editing</a>
                                <label class="form-check-label" style="padding: 15px;">
                                    <input  class="form-check-input"  type="checkbox"> 
                                    execution status
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                   
                    <!--Padding panel-->
                    <div>
                        <nav aria-label="Page navigation-center example">
                            <ul class="pagination mt-50">
                                <?php 
                                    $counts_padding = (count($list_of_tasks) - 3) / 3;
                                    if($counts_padding > 0){
                                        for($i = 0; $i <= $counts_padding; $i++){
                                ?>
                                <li class="page-item <?php if($params === $i) echo "active";?>"><a class="page-link" href="<?php if($params === $i) echo "#"; else echo "";?>"><?php echo $i+1;?></a></li>
                                <?php 
                                        }
                                    }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!--Start Footer-->
        <footer class="footer-area">
            <div class = "section">
                <div class = "row footer">
                    <div class = "col" style="background-color:ghostwhite;"><p class="text-center" style="font-size: 18px; font-family: cursive; padding: 10px;">Copyright ...</p></div>
                </div>
            </div>
        </footer>
    </body>
</html>