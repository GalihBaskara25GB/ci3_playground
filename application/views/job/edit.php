<div class="container px-0 card my-5">
    <div class="card-header d-flex justify-content-between">
        <p class="py-0 my-0">
            Edit Job
        </p>
        <a href="<?php echo base_url('/job'); ?>" class="btn btn-sm btn-dark">Job List</a>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo base_url('/job/update/' . $job->id); ?>">
            <div class="form-group">
                <label class="px-2" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="job name" value="<?php echo $job->name; ?>">
            </div>
            <div class="form-group">
                <label class="px-2" for="description">Description</label>
                <textarea class="form-control" id="description" name="description"><?php echo $job->description; ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
</div>

