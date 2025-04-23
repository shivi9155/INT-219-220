-- Create the database
CREATE DATABASE IF NOT EXISTS doodle_desk;
USE doodle_desk;

-- Create team_members table
CREATE TABLE IF NOT EXISTS team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    bio TEXT,
    image_url VARCHAR(255),
    position_order INT DEFAULT 0,
    active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create core_values table
CREATE TABLE IF NOT EXISTS core_values (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    icon_class VARCHAR(50) NOT NULL,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample team members
INSERT INTO team_members (name, position, bio, position_order) VALUES
('Sarah Johnson', 'Director', 'With over 15 years of experience in early childhood education, Sarah leads our team with passion and dedication.', 1),
('Michael Chen', 'Lead Teacher', 'Michael brings creativity and innovation to our classroom, making learning fun and engaging for every child.', 2),
('Emma Rodriguez', 'Art Specialist', 'Emma\'s artistic approach helps children express themselves and develop their creative abilities.', 3);

-- Insert core values with updated icons
INSERT INTO core_values (title, description, icon_class, display_order) VALUES
('Love & Care', 'We provide a nurturing environment where every child feels loved and cared for.', 'fa-heart', 1),
('Education', 'We believe in making learning fun and engaging through play-based activities.', 'fa-book-open', 2),
('Community', 'We foster a sense of belonging and encourage positive relationships.', 'fa-users', 3),
('Joy', 'We create an atmosphere of happiness and excitement for learning.', 'fa-laugh', 4); 