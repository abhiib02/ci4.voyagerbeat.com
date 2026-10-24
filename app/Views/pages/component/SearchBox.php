<?php

/**
 * @var string $AllPackagesNameAndID
 */
?>
<!-- Modal -->
<div class="modal fade" id="SearchBox" tabindex="-1" aria-labelledby="SearchBoxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header sticky-top bg-white">
                <h1 class="modal-title fs-5 w-100" id="SearchBoxLabel">
                    <form action="/search" method="get">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class='bx bx-search'></i></span>
                            <input type="text" class="form-control searchBoxInput" placeholder="Search" aria-label="Search" name="q" aria-describedby="Search" autofocus autocomplete="off">
                            <button class="btn btn-theme btn-voyager" type="submit" id="button-addon2">Search</button>
                        </div>
                    </form>
                </h1>
            </div>
            <div class="modal-body" style="overflow-y: scroll;max-height: 50vh;" data-lenis-prevent>
                <div id="packagesListCount">Search For Results</div>
                <div id="packagesList" class="list-group">
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
                <kbd>Esc</kbd> to Close <kbd>Tab</kbd> Select & Down
            </div>
        </div>
    </div>
</div>
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
        let packagesListCount = document.querySelector('#packagesListCount');
        packagesListCount.innerHTML = '';
        packagesLists.forEach((packagesList) => {
            packagesList.innerHTML = '';
        })

    };

    function generateList(packages) {

        let packagesLists = document.querySelectorAll('#packagesList');
        let packagesListCount = document.querySelector('#packagesListCount');
        let generatedList = '';
        packagesListCount.innerHTML = '';
        packagesListCount.innerHTML = `<p class='list-count'>${packages.length} results found</p>`;

        packages.forEach((package) => {
            generatedList += `<a href="/packageid/${package.PACKAGE_ID}" class="list-group-item list-group-item-action text-capitalize">${package.PACKAGE_NAME}</a>`;
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