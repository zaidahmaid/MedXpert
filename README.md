-- Insert data into users table (10 users, including 10 doctors)
INSERT INTO users (id, name, email, password, role) VALUES
(1, 'John Doe', 'john@example.com', 'password123', 'user'),
(2, 'Alice Smith', 'alice@example.com', 'password123', 'user'),
(3, 'Bob Brown', 'bob@example.com', 'password123', 'user'),
(4, 'Eve Black', 'eve@example.com', 'password123', 'user'),
(5, 'Charlie Lee', 'charlie@example.com', 'password123', 'user'),
(6, 'Dr. Adam Ray', 'adam@example.com', 'password123', 'doctor'),
(7, 'Dr. Susan Lee', 'susan@example.com', 'password123', 'doctor'),
(8, 'Dr. Mark Fox', 'mark@example.com', 'password123', 'doctor'),
(9, 'Dr. Lily Kim', 'lily@example.com', 'password123', 'doctor'),
(10, 'Dr. Alex Snow', 'alex@example.com', 'password123', 'doctor'),
(11, 'Dr. Ryan Hall', 'ryan@example.com', 'password123', 'doctor'),
(12, 'Dr. Jane Wood', 'jane@example.com', 'password123', 'doctor'),
(13, 'Dr. Luke Bond', 'luke@example.com', 'password123', 'doctor'),
(14, 'Dr. Mia Hart', 'mia@example.com', 'password123', 'doctor'),
(15, 'Dr. John Kent', 'john.k@example.com', 'password123', 'doctor');

-- Insert data into doctors table (linking doctors with their user_id)
INSERT INTO doctors (id, user_id, created_at, updated_at) VALUES
(1, 6, NOW(), NOW()),
(2, 7, NOW(), NOW()),
(3, 8, NOW(), NOW()),
(4, 9, NOW(), NOW()),
(5, 10, NOW(), NOW()),
(6, 11, NOW(), NOW()),
(7, 12, NOW(), NOW()),
(8, 13, NOW(), NOW()),
(9, 14, NOW(), NOW()),
(10, 15, NOW(), NOW());

-- Insert data into doctor_details table with a rating column (random values from 2 to 5)
INSERT INTO doctor_details (id, doctor_id, specialty, clinic_address, city, price, phone, experience_years, image, rating, created_at, updated_at) VALUES
(1, 1, 'Cardiology', '123 Heart St', 'amman', 100, '123-456-7890', 10, 'https://img.freepik.com/free-photo/portrait-experienced-professional-therapist-with-stethoscope-looking-camera_1098-19305.jpg', ROUND(RAND() _ 3 + 2, 1), NOW(), NOW()),
(2, 2, 'Neurology', '456 Brain Ave', 'zarqa', 120, '234-567-8901', 8, 'https://img.freepik.com/free-photo/portrait-experienced-professional-therapist-with-stethoscope-looking-camera_1098-19305.jpg', ROUND(RAND() _ 3 + 2, 1), NOW(), NOW()),
(3, 3, 'Orthopedics', '789 Bone Rd', 'irbid', 110, '345-678-9012', 12, 'https://img.freepik.com/free-photo/portrait-experienced-professional-therapist-with-stethoscope-looking-camera_1098-19305.jpg', ROUND(RAND() _ 3 + 2, 1), NOW(), NOW()),
(4, 4, 'Pediatrics', '159 Kids St', 'amman', 90, '456-789-0123', 5, 'https://img.freepik.com/free-photo/portrait-experienced-professional-therapist-with-stethoscope-looking-camera_1098-19305.jpg', ROUND(RAND() _ 3 + 2, 1), NOW(), NOW()),
(5, 5, 'Dermatology', '753 Skin Blvd', 'zarqa', 95, '567-890-1234', 7, 'https://img.freepik.com/free-photo/portrait-experienced-professional-therapist-with-stethoscope-looking-camera_1098-19305.jpg', ROUND(RAND() _ 3 + 2, 1), NOW(), NOW()),
(6, 6, 'Psychiatry', '321 Mind Ln', 'irbid', 130, '678-901-2345', 15, 'https://img.freepik.com/free-photo/portrait-experienced-professional-therapist-with-stethoscope-looking-camera_1098-19305.jpg', ROUND(RAND() _ 3 + 2, 1), NOW(), NOW()),
(7, 7, 'Oncology', '951 Cancer Dr', 'amman', 140, '789-012-3456', 9, 'https://img.freepik.com/free-photo/portrait-experienced-professional-therapist-with-stethoscope-looking-camera_1098-19305.jpg', ROUND(RAND() _ 3 + 2, 1), NOW(), NOW()),
(8, 8, 'Radiology', '852 Scan Ct', 'zarqa', 125, '890-123-4567', 11, 'https://img.freepik.com/free-photo/portrait-experienced-professional-therapist-with-stethoscope-looking-camera_1098-19305.jpg', ROUND(RAND() _ 3 + 2, 1), NOW(), NOW()),
(9, 9, 'Gastroenterology', '357 Digestive St', 'irbid', 105, '901-234-5678', 6, 'https://img.freepik.com/free-photo/portrait-experienced-professional-therapist-with-stethoscope-looking-camera_1098-19305.jpg', ROUND(RAND() _ 3 + 2, 1), NOW(), NOW()),
(10, 10, 'Endocrinology', '468 Hormone Way', 'amman', 150, '012-345-6789', 13, 'https://img.freepik.com/free-photo/portrait-experienced-professional-therapist-with-stethoscope-looking-camera_1098-19305.jpg', ROUND(RAND() _ 3 + 2, 1), NOW(), NOW());

INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, status, notes, created_at, updated_at) VALUES
(1, 6, '2025-04-02', '09:00:00', 'pending', 'Follow-up consultation.', NULL, NULL),
(1, 6, '2025-04-02', '09:30:00', 'pending', 'Routine blood test.', NULL, NULL),
(1, 6, '2025-04-03', '10:00:00', 'pending', 'Patient requested appointment.', NULL, NULL),
(1, 6, '2025-04-03', '10:30:00', 'pending', 'Discuss MRI results.', NULL, NULL),
(1, 6, '2025-04-04', '11:00:00', 'pending', 'Regular health check-up.', NULL, NULL),
(1, 6, '2025-04-04', '11:30:00', 'pending', 'Annual physical examination.', NULL, NULL),
(1, 6, '2025-04-05', '12:00:00', 'pending', 'Consultation for diet plan.', NULL, NULL),
(1, 6, '2025-04-05', '12:30:00', 'pending', 'Pre-operative discussion.', NULL, NULL),
(1, 6, '2025-04-06', '13:00:00', 'pending', 'Post-operative follow-up.', NULL, NULL),
(1, 6, '2025-04-06', '13:30:00', 'pending', 'Patient review session.', NULL, NULL),
(1, 6, '2025-04-07', '14:00:00', 'pending', 'Routine consultation.', NULL, NULL),
(1, 6, '2025-04-07', '14:30:00', 'pending', 'Health screening appointment.', NULL, NULL),
(1, 6, '2025-04-08', '15:00:00', 'pending', 'Regular check-up.', NULL, NULL),
(1, 6, '2025-04-08', '15:30:00', 'pending', 'Consultation for symptoms.', NULL, NULL),
(1, 6, '2025-04-09', '16:00:00', 'pending', 'Discussion for medication review.', NULL, NULL),
(1, 6, '2025-04-09', '16:30:00', 'pending', 'Scheduled patient inquiry.', NULL, NULL),
(1, 6, '2025-04-10', '17:00:00', 'pending', 'Specialist referral consultation.', NULL, NULL),
(1, 6, '2025-04-10', '17:30:00', 'pending', 'Routine patient evaluation.', NULL, NULL),
(1, 6, '2025-04-11', '18:00:00', 'pending', 'Follow-up on prescribed medications.', NULL, NULL),
(1, 6, '2025-04-11', '18:30:00', 'pending', 'Patient-requested follow-up.', NULL, NULL);
