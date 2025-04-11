CREATE DATABASE IF NOT EXISTS voting_system;
USE voting_system;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES
('admin', 'admin123'),
('alice', 'alice123'),
('bob', 'bob123'),
('charlie', 'charlie123'),
('eve', 'eve123');

-- Candidates Table
CREATE TABLE candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

INSERT INTO candidates (name) VALUES
('Candidate A'),
('Candidate B'),
('Candidate C'),
('Candidate D'),
('Candidate E');

-- Votes Table
CREATE TABLE votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    candidate_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (candidate_id) REFERENCES candidates(id)
);

-- Votes Data (Sample Votes)
INSERT INTO votes (user_id, candidate_id) VALUES
(1, 2),
(2, 1),
(3, 3),
(4, 1),
(5, 2);