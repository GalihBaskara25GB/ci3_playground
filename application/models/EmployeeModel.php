<?php
defined('BASEPATH') || exit('No direct script access allowed');

class EmployeeModel extends CI_Model
{
    protected $table = 'employees';

    public function getEmployees(): array
    {
        $this->db->select($this->table . '.*, jobs.name as job_name');
        $this->db->from($this->table);
        $this->db->join('jobs', 'jobs.id = ' . $this->table . '.job_id', 'left');
        return $this->db->get()->result();
    }

    public function getEmployeeById(int $id): object|null
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function getEmployeeByEmail(string $email): object|null
    {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }

    public function isEmailExist(string $email, int $id = 0): bool
    {
        $params = ['email' => $email];
        if ($id > 0) {
            $params['id !='] = $id;
        }
        return $this->db->get_where($this->table, $params)->num_rows() > 0;
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
