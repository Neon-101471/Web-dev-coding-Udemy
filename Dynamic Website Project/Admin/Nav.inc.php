	<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
		<div class="sidebar-sticky pt-3">
			<ul class="nav flex-column">
			  <li class="nav-item">
				<a class="nav-link active" href="Index.php">
				  <span data-feather="home"></span>
				  Dashboard <span class="sr-only">(current)</span>
				</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="Post.php">
				  <span data-feather="file"></span>
				  All Posts
				</a>
			  </li>
			  <?php
			  if (isset($_SESSION['AuthorRole']))
			  {
				  if($_SESSION['AuthorRole']=="Admin")
				  {
			  ?>
			  <li class="nav-item">
				<a class="nav-link" href="Category.php">
				  <span data-feather="file"></span>
				  All Categories
				</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="Page.php">
				  <span data-feather="file"></span>
				  All Pages
				</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="Settings.php">
				  <span data-feather="file"></span>
				  Settings
				</a>
			  </li>
			  <?php
				  }
			  }		  
			  ?>
			</ul>
		  </div>
	</nav>