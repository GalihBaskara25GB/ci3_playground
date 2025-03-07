<div class="container px-0 card my-5">
    <div class="card-header d-flex justify-content-between">
        <p class="py-0 my-0">
            Job List
        </p>
        <a href="<?php echo base_url('/job/create'); ?>" class="btn btn-sm btn-dark">Add New</a>
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
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($jobs as $job) : ?>
                <tr>
                    <td>
                        <a href="<?php echo base_url('/job/edit/' . $job->id) ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="<?php echo base_url('/job/delete/' . $job->id) ?>" class="btn btn-danger btn-sm <?php echo empty($job->employee_id) ? '' : 'disabled' ?>">Delete</a>
                    </td>
                    <td><?php echo $job->name ?></td>
                    <td><?php echo $job->description ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
