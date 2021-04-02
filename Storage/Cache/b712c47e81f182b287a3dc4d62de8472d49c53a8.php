<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="navbar-brand d-md-none d-block">
        <img src="/img/logo.png" class='d-md-none d-show' alt="Logo">
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        Menu
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav">

            <li class="nav-item active">
                <a class="nav-link" href="<?php echo e($url->make("homepage")); ?>">Home</span></a>
            </li>

            <?php $__currentLoopData = \App\Http\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e($url->make("pages.home",["category"=>$category->slug])); ?>"><?php echo e($category->title); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <li class="nav-item">
                <a class="nav-link" href="#">Contact us</a>
            </li>
        </ul>

        <ul class="ml-auto navbar-nav">
            <li class="nav-item dropdown">
                    <?php if(Auth()): ?>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="/img/uploads/<?php echo e(\App\Http\Models\User::find(\App\Http\Libraries\Authentication\Auth::id())->Profile->Image->image_name); ?>" alt="" class="profile_pic">
                        <?php echo e(\App\Http\Libraries\Authentication\Auth::getusername()); ?> </a>
                    <?php else: ?>
                        <a href="<?php echo e($url->make("login")); ?>">Login</a>
                    <?php endif; ?>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo e($url->make("profile.home",["username"=>\App\Http\Libraries\Authentication\Auth::getusername()])); ?>">View My Profile</a>
                    <a class="dropdown-item" href="<?php echo e($url->make("logout")); ?>">logout</a>
                </div>
            </li>

            <li class="nav-item">
                <form action="<?php echo e($url->make("search.view")); ?>" class="form-inline nav-link" method="get">
                    <input type="text" class="form-control" placeholder="search Articles" name="keyword">
                    <button class="btn btn-primary">Search</button>
                </form>
            </li>
        </ul>
    </div>

</nav><?php /**PATH /var/www/html/public_html/Views/Includes/Navbar.blade.php ENDPATH**/ ?>