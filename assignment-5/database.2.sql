DROP TABLE IF EXISTS csb090;

-- Table created after roll number csb090
CREATE TABLE csb090 (
    id SERIAL PRIMARY KEY,
    course_code VARCHAR(20) NOT NULL,
    coursename VARCHAR(100) NOT NULL,
    books INT NOT NULL,
    expenses VARCHAR(100) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL
);

-- Inserting 5 sample records directly through SQL
INSERT INTO csb090 (course_code, coursename, books, expenses, amount) VALUES
('CS101', 'Microprocessor', 2, 'Lab manual', 45.50),
('CS102', 'Computer Networks', 3, 'Textbooks and notes', 120.00),
('CS103', 'Database Systems', 1, 'Online subscription', 29.99),
('CS104', 'Operating Systems', 4, 'Reference guides', 85.00),
('CS105', 'Cloud Computing', 2, 'Practice workbooks', 50.00);