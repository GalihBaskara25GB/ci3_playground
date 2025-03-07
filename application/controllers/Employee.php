<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Employee extends CI_Controller {
	protected $acceptedGenders = [0, 1];
	// Gender 0 = Male, 1 = Female

	public function __construct() {
		parent::__construct();
		$this->load->model('EmployeeModel', 'employee');
		$this->load->model('JobModel', 'job');
	}

	public function index()
	{
		$employees = $this->employee->getEmployees();

		$this->load->view('/layouts/header');
		$this->load->view('/dashboard/navbar');
		$this->load->view('/employee/list', ['employees' => $employees]);
		$this->load->view('/layouts/footer');
	}

	public function create()
	{
		$jobs = $this->job->getJobs();

		$this->load->view('/layouts/header');
		$this->load->view('/dashboard/navbar');
		$this->load->view('/employee/create', ['jobs' => $jobs]);
		$this->load->view('/layouts/footer');
	}

	public function store()
	{
		if ($this->validateRequest() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('/employee/create'));
		}

		if (!$this->job->isValidJob($this->input->post('job_id'))) {
			$this->session->set_flashdata('error', 'Job not found');
			redirect(base_url('/employee/create'));
		}

		$data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'gender' => $this->input->post('gender'),
			'job_id' => $this->input->post('job_id'),
		];
		if ($this->employee->create($data)) {
			$this->session->set_flashdata('success', 'Employee created successfully');
			redirect(base_url('/employee'));
		} else {
			$this->session->set_flashdata('error', 'Failed to create employee');
			redirect(base_url('/employee/create'));
		}
	}

	public function edit(int $id)
	{
		$employee = $this->employee->getEmployeeById($id);
		
		if (empty($employee)) {
			$this->session->set_flashdata('error', 'Employee not found');
			redirect(base_url('/employee'));
		}

		$jobs = $this->job->getJobs();

		$this->load->view('/layouts/header');
		$this->load->view('/dashboard/navbar');
		$this->load->view('/employee/edit', ['employee' => $employee, 'jobs' => $jobs]);
		$this->load->view('/layouts/footer');
	}

	public function update(int $id)
	{
		if ($this->validateRequest('update') === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url('/employee/edit/' . $id));
		}

		if (!$this->job->isValidJob($this->input->post('job_id'))) {
			$this->session->set_flashdata('error', 'Job not found');
			redirect(base_url('/employee/edit/' . $id));
		}

		if ($this->employee->isEmailExist($this->input->post('email'), $id)) {
			$this->session->set_flashdata('error', 'Email already exist');
			redirect(base_url('/employee/edit/' . $id));
		}

		$data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'gender' => $this->input->post('gender'),
			'job_id' => $this->input->post('job_id'),
		];

		if ($this->employee->update($id, $data)) {
			$this->session->set_flashdata('success', 'Employee updated successfully');
			redirect(base_url('/employee'));
		} else {
			$this->session->set_flashdata('error', 'Failed to update employee');
			redirect(base_url('/employee/edit/)' . $id));
		}
	}

	public function delete(int $id)
	{
		if ($this->employee->delete($id)) {
			$this->session->set_flashdata('success', 'Employee deleted successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete employee');
		}

		redirect(base_url('/employee'));
	}

	private function validateRequest(string $type = 'create'): bool
	{
		$additionalEmailValidation = $type === 'create' ? '|is_unique[employees.email]' : '';
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email' . $additionalEmailValidation);
		$this->form_validation->set_rules('gender', 'Gender', 'required|in_list[1,0]');
		$this->form_validation->set_rules('job_id', 'Job', 'required');

		return $this->form_validation->run();
	}
}

