<script id="trip-type-dates">
    const tripType = document.getElementById('trip_type');
    let customDate = document.getElementById('custom-date');
    let batchDate = document.getElementById('batch-date');

    tripType.addEventListener('change', () => {
        if (tripType.value === 'community') {
            batchDate.classList.remove('hide');
            customDate.classList.add('hide');
            customDate.querySelector('input').removeAttribute('required');
            customDate.querySelector('input').removeAttribute('name');

        } else {
            batchDate.classList.add('hide');
            batchDate.querySelector('input').removeAttribute('required');
            batchDate.querySelector('input').removeAttribute('name');
            customDate.classList.remove('hide');

        }
    })
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
                progress.value += value;
            }
        });
    });

    document.querySelectorAll('.prev').forEach(button => {
        button.addEventListener('click', () => {
            steps[currentStep].classList.remove('active');
            currentStep--;
            steps[currentStep].classList.add('active');
            progress.value -= value;
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