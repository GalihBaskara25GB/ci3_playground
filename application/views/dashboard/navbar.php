<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
  <a class="navbar-brand" href="#">Hi, </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('/dashboard'); ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Employee
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?php echo base_url('/employee'); ?>">All Employees</a>
          <a class="dropdown-item" href="<?php echo base_url('/employee/create'); ?>">Add Employee</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Job
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?php echo base_url('/job'); ?>">All Jobs</a>
          <a class="dropdown-item" href="<?php echo base_url('/job/create'); ?>">Add Job</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a class="btn btn-outline-light btn-sm" href="<?php echo base_url('/auth/logout'); ?>">Logout</a>
    </form>
  </div>
</nav>