document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('enrollmentForm');
    const steps = document.querySelectorAll('[id^="step"]');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');
    const addChildBtn = document.getElementById('addChild');
    const successMessage = document.getElementById('successMessage');
    const progressBar = document.querySelector('.progress-bar');
    const stepIcons = document.querySelectorAll('.step-icon');
    const stepTexts = document.querySelectorAll('.step-text');
    
    let currentStep = 0;

    // Function to update step indicators
    function updateStepIndicators() {
        // Update progress bar width
        const progressPercentage = (currentStep / (steps.length - 1)) * 100;
        progressBar.style.width = `${progressPercentage}%`;
        
        // Update step icons and texts
        stepIcons.forEach((icon, index) => {
            if (index < currentStep) {
                // Completed steps
                icon.classList.remove('active');
                icon.classList.add('completed');
                stepTexts[index].classList.remove('active');
                stepTexts[index].classList.add('completed');
            } else if (index === currentStep) {
                // Current step
                icon.classList.remove('completed');
                icon.classList.add('active');
                stepTexts[index].classList.remove('completed');
                stepTexts[index].classList.add('active');
            } else {
                // Upcoming steps
                icon.classList.remove('active', 'completed');
                stepTexts[index].classList.remove('active', 'completed');
            }
        });
    }

    // Function to show/hide steps
    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            if (index === stepIndex) {
                step.classList.remove('hidden');
                // Add animation for the current step
                step.style.animation = 'fadeIn 0.5s ease-in-out';
            } else {
                step.classList.add('hidden');
                step.style.animation = '';
            }
        });
        
        // Update buttons
        prevBtn.classList.toggle('hidden', stepIndex === 0);
        nextBtn.classList.toggle('hidden', stepIndex === steps.length - 1);
        submitBtn.classList.toggle('hidden', stepIndex !== steps.length - 1);
        
        updateStepIndicators();
    }

    // Function to validate current step
    function validateStep(stepIndex) {
        const currentStepElement = steps[stepIndex];
        const inputs = currentStepElement.querySelectorAll('input[required], select[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.classList.add('border-red-500');
                
                // Add shake animation for invalid fields
                input.style.animation = 'shake 0.5s ease-in-out';
                setTimeout(() => {
                    input.style.animation = '';
                }, 500);
            } else {
                input.classList.remove('border-red-500');
            }
        });

        return isValid;
    }

    // Add shake animation keyframes
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
    `;
    document.head.appendChild(style);

    // Next button click handler
    nextBtn.addEventListener('click', () => {
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
        }
    });

    // Previous button click handler
    prevBtn.addEventListener('click', () => {
        currentStep--;
        showStep(currentStep);
    });

    // Add child button click handler
    addChildBtn.addEventListener('click', () => {
        const childrenContainer = document.getElementById('childrenContainer');
        const newChildSection = document.createElement('div');
        newChildSection.className = 'child-section border-b pb-8 mb-8';
        newChildSection.innerHTML = `
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                <div>
                    <label class="block mb-2">Child's First Name</label>
                    <input type="text" name="childFirstName[]" required class="w-full rounded-lg">
                </div>
                <div>
                    <label class="block mb-2">Child's Last Name</label>
                    <input type="text" name="childLastName[]" required class="w-full rounded-lg">
                </div>
                <div>
                    <label class="block mb-2">Date of Birth</label>
                    <input type="date" name="childDOB[]" required class="w-full rounded-lg">
                </div>
                <div>
                    <label class="block mb-2">Medical Records</label>
                    <div class="file-input w-full">
                        <input type="file" name="medicalRecords[]" accept=".pdf,.jpg,.jpeg,.png" class="w-full">
                        <div class="text-sm text-gray-500 mt-2">Upload vaccination records or medical documents</div>
                    </div>
                </div>
            </div>
            <button type="button" class="remove-child mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <i class="fas fa-trash-alt mr-2"></i> Remove Child
            </button>
        `;
        childrenContainer.appendChild(newChildSection);
        
        // Add animation for the new child section
        newChildSection.style.animation = 'fadeIn 0.5s ease-in-out';

        // Add remove child functionality
        newChildSection.querySelector('.remove-child').addEventListener('click', function() {
            newChildSection.style.animation = 'fadeOut 0.5s ease-in-out';
            setTimeout(() => {
                newChildSection.remove();
            }, 500);
        });
    });

    // Form submission handler
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        if (!validateStep(currentStep)) {
            return;
        }

        // Create enrollment data object
        const formData = new FormData(form);
        const enrollmentData = {
            parent: {
                firstName: formData.get('parentFirstName'),
                lastName: formData.get('parentLastName'),
                email: formData.get('parentEmail'),
                phone: formData.get('parentPhone')
            },
            children: [],
            program: {
                type: formData.get('programType'),
                startDate: formData.get('startDate')
            }
        };

        // Add children data
        const childFirstNames = formData.getAll('childFirstName[]');
        const childLastNames = formData.getAll('childLastName[]');
        const childDOBs = formData.getAll('childDOB[]');
        const medicalRecords = formData.getAll('medicalRecords[]');

        for (let i = 0; i < childFirstNames.length; i++) {
            enrollmentData.children.push({
                firstName: childFirstNames[i],
                lastName: childLastNames[i],
                dateOfBirth: childDOBs[i],
                medicalRecord: medicalRecords[i] ? medicalRecords[i].name : null
            });
        }

        // Log the enrollment data (in a real application, this would be sent to a server)
        console.log('Enrollment Data:', enrollmentData);

        // Show success message with animation
        form.style.animation = 'fadeOut 0.5s ease-in-out';
        setTimeout(() => {
            form.classList.add('hidden');
            successMessage.classList.remove('hidden');
        }, 500);

        // Reset form after 3 seconds
        setTimeout(() => {
            form.reset();
            form.classList.remove('hidden');
            form.style.animation = '';
            successMessage.classList.add('hidden');
            currentStep = 0;
            showStep(currentStep);
        }, 3000);
    });

    // Initialize the form
    showStep(currentStep);
}); 