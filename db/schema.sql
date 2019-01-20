BEGIN;

CREATE TABLE location (
  location TEXT PRIMARY KEY
);

CREATE TABLE department (
  department_pk   SERIAL PRIMARY KEY,
  department_name TEXT,
  manager_id      INTEGER,
  location        TEXT NOT NULL REFERENCES location (location)
);

CREATE TABLE emp_role (
  emp_role_pk SERIAL PRIMARY KEY,
  role_name   TEXT    NOT NULL,
  rule        INTEGER NOT NULL DEFAULT 10
);

CREATE TABLE employee (
  employee_pk   SERIAL PRIMARY KEY,
  username      TEXT,
  password      TEXT,
  created TIMESTAMPTZ,
  last_login TIMESTAMPTZ,
  department_pk INTEGER REFERENCES department (department_pk)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  job_id        TEXT,
  role_id       INTEGER REFERENCES emp_role (emp_role_pk)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
);

ALTER TABLE department
  ADD FOREIGN KEY (manager_id) REFERENCES employee (employee_pk)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

CREATE TABLE employee_info (
  employee_info_pk SERIAL PRIMARY KEY,
  employee_pk      INTEGER REFERENCES employee (employee_pk)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  first_name       TEXT,
  last_name        TEXT,
  address          TEXT,
  birth_date       DATE,
  phone            TEXT
);

CREATE TABLE holiday_type (
  holiday_type TEXT PRIMARY KEY
);

CREATE TABLE holiday_allowance (
  holiday_allowance_pk SERIAL PRIMARY KEY,
  employee_pk          INTEGER NOT NULL REFERENCES employee (employee_pk)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  year                 TEXT,
  holiday_type         TEXT    NOT NULL REFERENCES holiday_type (holiday_type)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  total                NUMERIC(3, 1) DEFAULT 25
);

CREATE TABLE holiday_request (
  holiday_request_pk SERIAL PRIMARY KEY,
  employee_pk        INTEGER REFERENCES employee (employee_pk)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  holiday_type       TEXT REFERENCES holiday_type (holiday_type)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  start_date         DATE,
  end_date           DATE,
  duration           NUMERIC(2, 1),
  approved           BOOLEAN DEFAULT FALSE,
  approved_by        INTEGER REFERENCES employee (employee_pk)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  cancelled          BOOLEAN DEFAULT FALSE,
  cancelled_by       INTEGER REFERENCES employee (employee_pk)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
);