<?php
defined('BASEPATH') || exit('No direct script access allowed');

class JobModel extends CI_Model
{
    protected $table = 'Jobs';

    public function getJobs(): array
    {
        $this->db->select($this->table . '.*, employees.id as employee_id');
        $this->db->from($this->table);
        $this->db->join('employees', 'employees.job_id = ' . $this->table . '.id', 'left');
        return $this->db->get()->result();
    }

    public function getJobById(int $id): object|null
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function isValidJob(int $id): bool
    {
        return $this->db->get_where($this->table, ['id' => $id])->num_rows() > 0;
    }

    public function create(array $data): bool
    {
        return $this->db->insert($this->table, $data) ?? false;
    }

    public function update(int $id, array $data): bool
    {
        return $this->db->update($this->table, $data, ['id' => $id]) ?? false;
    }

    public function delete(int $id): bool
    {
        return $this->db->delete($this->table, ['id' => $id]) ?? false;
    }
}
