<div class="container px-0 card my-5">
    <div class="card-header d-flex justify-content-between">
        <p class="py-0 my-0">
            Add New Employee
        </p>
        <a href="<?php echo base_url('/employee'); ?>" class="btn btn-sm btn-dark">Employee List</a>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($jobs)): ?>
            <div class="alert alert-warning" role="alert">
                Please add at least 1 Job, before adding an Employee.
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo base_url('/employee/store'); ?>">
            <div class="form-group">
                <label class="px-2" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="full name" value="<?php echo set_value('name'); ?>">
            </div>
            <div class="form-group">
                <label class="px-2" for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php echo set_value('email'); ?>">
            </div>
            <div class="form-group">
                <label class="px-2" for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" value="<?php echo set_value('gender'); ?>">
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label class="px-2" for="job_id">Job</label>
                <select class="form-control" id="job_id" name="job_id" value="<?php echo set_value('job_id'); ?>">
                    <option value="">Select Job</option>
                    <?php 
                        foreach ($jobs as $job) {
                            echo '<option value="' . $job->id . '">' . $job->name . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" <?php echo empty($jobs) ? "disabled" : "" ?>>Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
</div>

