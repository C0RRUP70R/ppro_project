BEGIN;

INSERT INTO holiday_request (employee_pk, holiday_type, start_date, end_date, duration, approved, approved_by, cancelled_by)
VALUES (1, 'holiday', '02.01.2019'::DATE, '02.01.2019'::DATE, 1, false, null, null),
  (1, 'holiday', '04.01.2019'::DATE, '04.01.2019'::DATE, 1, false, null, null),
  (2, 'holiday', '02.01.2019'::DATE, '02.01.2019'::DATE, 0.5, false, null, null),
  (3, 'sick-day', '02.01.2019'::DATE, '02.01.2019'::DATE, 1, false, null, null),
  (3, 'sick-day', '05.01.2019'::DATE, '05.01.2019'::DATE, 1, true, 1, NULL);