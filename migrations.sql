CREATE TABLE playground.employees (
	id BIGINT auto_increment NOT null primary KEY,
	email varchar(100) NOT null UNIQUE,
	name varchar(100) NOT null,
	gender smallint(1) not null default 1,
	job_id BIGINT not null,
	foreign key (job_id) references jobs(id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

CREATE TABLE playground.jobs (
	id BIGINT auto_increment NOT null primary KEY,
	name varchar(100) NOT null,
	description varchar(100)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;