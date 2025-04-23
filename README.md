# Daycare Enrollment System

A modern, responsive web application for daycare enrollment management built with HTML, Tailwind CSS, and JavaScript.

## Features

- Multi-step enrollment form
- Parent information collection
- Multiple child enrollment support
- Medical records upload
- Program selection
- Form validation
- Responsive design
- Modern UI with Tailwind CSS

## Getting Started

1. Clone this repository
2. Open `index.html` in your web browser
3. No build process required - the application uses CDN links for dependencies

## Usage

The enrollment process consists of three steps:

1. **Parent Information**
   - Enter parent's first and last name
   - Provide email address
   - Add phone number

2. **Child Information**
   - Add one or more children
   - For each child:
     - Enter first and last name
     - Select date of birth
     - Upload medical records (optional)
   - Use "Add Another Child" button to enroll multiple children

3. **Program Selection**
   - Choose program type:
     - Full Time (7:00 AM - 6:00 PM)
     - Half Day (9:00 AM - 1:00 PM)
     - After School (2:00 PM - 6:00 PM)
   - Select start date

## Form Validation

- All required fields must be filled out before proceeding to the next step
- Email format is validated
- Phone number is required
- At least one child must be added
- Program type and start date are required

## Data Structure

The form submission generates a JSON object with the following structure:

```json
{
  "parent": {
    "firstName": "string",
    "lastName": "string",
    "email": "string",
    "phone": "string"
  },
  "children": [
    {
      "firstName": "string",
      "lastName": "string",
      "dateOfBirth": "string",
      "medicalRecord": "string"
    }
  ],
  "program": {
    "type": "string",
    "startDate": "string"
  }
}
```

## Browser Support

The application is compatible with modern browsers:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Dependencies

- Tailwind CSS (via CDN)
- Font Awesome (via CDN)

## License

This project is open source and available under the MIT License. 