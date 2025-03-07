<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Job extends CI_Controller {
	protected $acceptedGenders = [0, 1];
	// Gender 0 = Male, 1 = Female

	public function __construct() {
		parent::__construct();
		$this->load->model('JobModel', 'job');
	}

	public function index()
	{
		$jobs = $this->job->getJobs();

		$this->load->view('/layouts/header');
		$this->load->view('/dashboard/navbar');
		$this->load->view('/job/list', ['jobs' => $jobs]);
		$this->load->view('/layouts/footer');
	}

	public function create()
	{
		$this->load->view('/layouts/header');
		$this->load->view('/dashboard/navbar');
		$this->load->view('/job/create');
		$this->load->view('/layouts/footer');
	}

	public function store()
	{
		if ($this->validateRequest() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('/job/create'));
		}

		$data = [
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
		];
		if ($this->job->create($data)) {
			$this->session->set_flashdata('success', 'Job created successfully');
			redirect(base_url('/job'));
		} else {
			$this->session->set_flashdata('error', 'Failed to create job');
			redirect(base_url('/job/create'));
		}
	}

	public function edit(int $id)
	{
		$job = $this->job->getJobById($id);

		if (empty($job)) {
			$this->session->set_flashdata('error', 'Job not found');
			redirect(base_url('/job'));
		}

		$this->load->view('/layouts/header');
		$this->load->view('/dashboard/navbar');
		$this->load->view('/job/edit', ['job' => $job]);
		$this->load->view('/layouts/footer');
	}

	public function update(int $id)
	{
		if ($this->validateRequest('update') === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('/job/edit/' . $id));
		}

		$data = [
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
		];

		if ($this->job->update($id, $data)) {
			$this->session->set_flashdata('success', 'Job updated successfully');
			redirect(base_url('/job'));
		} else {
			$this->session->set_flashdata('error', 'Failed to update job');
			redirect(base_url('/job/edit/)' . $id));
		}
	}

	public function delete(int $id)
	{
		if ($this->job->delete($id)) {
			$this->session->set_flashdata('success', 'Job deleted successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete job');
		}

		redirect(base_url('/job'));
	}

	private function validateRequest(string $type = 'create'): bool
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		return $this->form_validation->run();
	}
}

