BEGIN;

INSERT INTO location (location)
VALUES ('Prague'),
  ('HK'),
  ('Brno');

INSERT INTO department (department_name, manager_id, location)
VALUES ('Support', null, 'HK'),
  ('HR', null, 'Prague'),
  ('Development', null, 'Brno');

INSERT INTO emp_role (role_name, rule)
VALUES ('employee', 10),
  ('manager', 100),
  ('director', 1000);

INSERT INTO employee (username, password, created, last_login, department_pk, job_id, role_id)
VALUES ('john.doe', md5('heslo'), now(), null, 1, 'manager', 2),
  ('joe.turner', md5('heslo'), now(), null, 1, 'programmer', 1),
  ('abel.tuter', md5('heslo'), now(), null, 1, 'support', 1),
  ('ellie.johnson', md5('heslo'), now(), null, 1, 'programmer', 1);

UPDATE department
SET manager_id = 1
WHERE department_name = 'Support';

INSERT INTO employee_info (employee_pk, first_name, last_name, address, birth_date, phone)
VALUES (1, 'John', 'Doe', 'HK', '01.02.1980' :: DATE, '123456789'),
  (2, 'Joe', 'Turner', 'HK', '25.03.1975' :: DATE, '123456789'),
  (3, 'Abel', 'Tuter', 'HK', '11.12.1985' :: DATE, '123456789'),
  (4, 'Ellie', 'Johnson', 'HK', '01.03.1990' :: DATE, '123456789');

INSERT INTO holiday_type (holiday_type)
VALUES ('holiday'),
  ('sick-day'),
  ('sickness'),
  ('compensatory leave'),
  ('by-law'),
  ('on-remote');