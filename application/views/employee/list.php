<div class="container px-0 card my-5">
    <div class="card-header d-flex justify-content-between">
        <p class="py-0 my-0">
            Employee List
        </p>
        <a href="<?php echo base_url('/employee/create'); ?>" class="btn btn-sm btn-dark">Add New</a>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Job</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($employees as $employee) : ?>
                <tr>
                    <td>
                        <a href="<?php echo base_url('/employee/edit/' . $employee->id) ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="<?php echo base_url('/employee/delete/' . $employee->id) ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                    <td><?php echo $employee->name ?></td>
                    <td><?php echo $employee->email ?></td>
                    <td><?php echo $employee->gender == 0 ? 'Male' : 'Female' ?></td>
                    <td><?php echo $employee->job_name ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
