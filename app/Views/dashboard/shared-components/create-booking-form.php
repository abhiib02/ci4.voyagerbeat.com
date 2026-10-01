<dialog class="border-1 rounded dw-50-mw-100" id="create-booking">
    <div class="card">
        <div class="card-header">
            <div class="fw-bold">Create New Booking</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="contact" class="form-label fw-bold">Search Package For ID</label>
                            <input type="text" class=" form-control searchBoxInput">
                        </div>
                    </div>

                    <form action="/create-booking" method="post" id="create-booking-form">
                        <div class="row ">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="package_id" class="form-label fw-bold">Package ID</label>
                                    <div class="input-group mb-3">

                                        <input
                                            type="number"
                                            class="form-control"
                                            id="package_id"
                                            name="package_id"
                                            min="1"
                                            step="1"
                                            required
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="adults" class="form-label fw-bold">Adults</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="adults"
                                        name="adults"
                                        min="1"
                                        step="1"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="contact" class="form-label fw-bold">Contact No</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="contact"
                                        name="contact"
                                        inputmode="numeric"
                                        pattern="\d{1,10}"
                                        maxlength="10"
                                        required>
                                    <div class="form-text">Up to 10 digits, numbers only.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="amount" class="form-label fw-bold">Amount Paid</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="amount"
                                        name="amount"
                                        min="0"
                                        step="0.01"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="amount" class="form-label fw-bold">Total Amount</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="total_package_cost"
                                        name="total_package_cost"
                                        min="0"
                                        step="0.01"
                                        required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="agent" id="agent" value="<?= session()->get('id') ?>">
                    </form>
                </div>
                <div class="col-4">

                    <div class="list-group" id="packagesList" style="height:350px;overflow:auto;"></div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-success" form="create-booking-form">Create Link</button>
            <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#create-booking').close();">Close</button>
        </div>
    </div>


</dialog>
<script>
    function addPackageID(ID) {

        document.getElementById('package_id').value = ID;
        document.querySelector('.searchBoxInput').value = '';
        let packagesLists = document.querySelectorAll('#packagesList');
        packagesLists.forEach((packagesList) => {
            packagesList.innerHTML = '';
        })
    }
</script>
<script>
    const packages = <?= json_encode($AllPackagesNameAndID); ?>;
    const packagesTitleandID = packages.map((obj) => {
        return {
            PACKAGE_ID: obj.PACKAGE_ID,
            PACKAGE_NAME: obj.PACKAGE_NAME.toLowerCase(),
        };
    })
</script>
<script>
    let searchInputs = document.querySelectorAll('.searchBoxInput');

    function compareTitle(a, b) {

        // converting to uppercase to have case-insensitive comparison
        const name1 = a.PACKAGE_NAME.toLowerCase();
        const name2 = b.PACKAGE_NAME.toLowerCase();

        let comparison = 0;

        if (name1 > name2) {
            comparison = 1;
        } else if (name1 < name2) {
            comparison = -1;
        }
        return comparison;
    }

    function extractData(value) {
        let searchquery = value.toLowerCase();
        let suggestedPackages = packagesTitleandID.filter((obj) => {
            return obj.PACKAGE_NAME.includes(searchquery);
        })
        if (suggestedPackages.length != 0) {
            return suggestedPackages;
        }
        return [];


    }

    function emptyList() {
        let packagesLists = document.querySelectorAll('#packagesList');


        packagesLists.forEach((packagesList) => {
            packagesList.innerHTML = '';
        })

    };

    function generateList(packages) {

        let packagesLists = document.querySelectorAll('#packagesList');

        let generatedList = '';



        packages.forEach((package) => {
            generatedList += `<a onclick="addPackageID(${package.PACKAGE_ID})"class="list-group-item list-group-item-action text-capitalize">${package.PACKAGE_ID} | ${package.PACKAGE_NAME}</a>`;
        })
        packagesLists.forEach((packagesList) => {
            packagesList.innerHTML = generatedList;
        })

    }



    searchInputs.forEach((searchInput) => {
        searchInput.addEventListener('input', (e) => {
            if (e.target.value == "") {
                emptyList();
                return 0;
            }
            let queriedPackages = extractData(e.target.value);
            document.startViewTransition(() => {
                generateList(queriedPackages);
            });

        })
    })
</script>