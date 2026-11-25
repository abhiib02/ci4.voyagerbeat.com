<script id="trip-type-dates">
    const tripType = document.getElementById('trip_type');
    const customDate = document.getElementById('custom-date');
    const batchDate = document.getElementById('batch-date');

    const getField = (wrapper) => wrapper.querySelector('input, select, textarea');

    function enableField(wrapper, name) {
        const field = getField(wrapper);
        if (!field) return;
        field.setAttribute('required', '');
        field.setAttribute('name', name);
        field.disabled = false;
    }

    function disableField(wrapper) {
        const field = getField(wrapper);
        if (!field) return;
        field.removeAttribute('required');
        field.disabled = true; // disabled fields aren't submitted
    }

    tripType.addEventListener('change', () => {
        if (tripType.value === 'community') {
            batchDate.classList.remove('hide');
            customDate.classList.add('hide');
            enableField(batchDate, 'date');
            disableField(customDate);
        } else if (tripType.value === 'personalised') {
            customDate.classList.remove('hide');
            batchDate.classList.add('hide');
            enableField(customDate, 'date');
            disableField(batchDate);
        }
    });
</script>

<script>
    function updateAll() {
        let travelers = document.querySelectorAll(".traveler");
        let data = []; // Initialize as an array

        travelers.forEach((t) => {
            // Push a new object for each traveler

            data.push({
                name: t.querySelector(".name")?.value || "",
                gender: t.querySelector(".gender")?.value || "",
                contact: t.querySelector(".contact")?.value || "",
                boarding_city: t.querySelector(".boarding_city")?.value || "",
                drop_point: t.querySelector(".drop_point")?.value || "",
                adhaar: t.querySelector(".adhaar_number")?.value || "",
                adhaarCard_file: (t.querySelector(".adhaar_number")?.value || "") + "_file",
                sharing: (t.querySelector(".sharing")?.value || "").toLowerCase()
            });
        });

        document.getElementById("pax_details_json").value = JSON.stringify(data);
    }

    // Auto update on typing
    document.addEventListener("input", updateAll);
</script>

<script>
    const steps = document.querySelectorAll('.step');
    //const progress = document.getElementById('progress');
    const value = 100 / (steps.length - 1);
    //progress.value = 0;
    let currentStep = 0;

    document.querySelectorAll('.next').forEach(button => {
        button.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                steps[currentStep].classList.remove('active');
                currentStep++;
                steps[currentStep].classList.add('active');
                //progress.value += value;
            }
        });
    });

    document.querySelectorAll('.prev').forEach(button => {
        button.addEventListener('click', () => {
            steps[currentStep].classList.remove('active');
            currentStep--;
            steps[currentStep].classList.add('active');
            //progress.value -= value;
        });
    });

    document.getElementById('submit').addEventListener('click', () => {
        if (validateStep(currentStep)) {

        }
    });

    function validateStep(step) {
        const inputs = steps[step].querySelectorAll('input, select');
        for (let input of inputs) {
            if (!input.checkValidity()) {

                input.reportValidity();
                return false;
            }
        }
        return true;
    }
</script>
<script>
    // Get today's date in YYYY-MM-DD format
    const today = new Date().toISOString().split('T')[0];

    // Set the min attribute to today
    document.getElementById('date').setAttribute('min', today);
</script>
<script>
    // Select all file inputs by their class
    const fileInputs = document.querySelectorAll('.adhaarCard_file');
    const errorDisplay = document.getElementById('errorMessage');

    // Define your allowed extensions
    const allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];

    // Loop through each input and attach the validation listener
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0]; // Get the selected file for this input

            // Clear previous error message
            errorDisplay.textContent = "";

            if (file) {
                // Extract the extension from the file name
                const fileExtension = file.name.split('.').pop().toLowerCase();

                // Validate the extension
                if (!allowedExtensions.includes(fileExtension)) {
                    errorDisplay.textContent = `Invalid file type: "${file.name}". Only .jpg, .jpeg, .png, and .pdf are allowed.`;

                    // Clear the value of this specific input field
                    this.value = '';
                }
            }
        });
    });
</script>