    <?php if ($isAdmin): ?>
        <div class="btn-group w-100 mb-1" role="group" aria-label="Basic example">
            <a href="/package-edit/<?= $package->PACKAGE_ID ?>?Adminlist=0" type="button" class="btn btn-sm btn-primary d-flex justify-content-center" title="Edit"><i class='bx bxs-edit fs-4'></i></a>
            &nbsp;
            <form action="/deletePackageProcess" method="post" id="package_delete_form">
                <input type="hidden" name="id" value="<?= $package->PACKAGE_ID ?>">
                <input type="hidden" name="pdf" value="<?= $package->PACKAGE_PDF ?>">
            </form>
            <button type="button" onclick="deletePackage()" class="btn btn-sm btn-danger d-flex justify-content-center" form="package_delete_form" title="Delete"><i class='bx bxs-trash fs-4 pe-none'></i></button>
            &nbsp;
            <button type="button" onclick="duplicatePackage()" href="/duplicatePackageProcess/<?= $package->PACKAGE_ID ?>" type="button" class="btn btn-sm btn-dark d-flex justify-content-center" title="Duplicate"><i class='pe-none bx bxs-duplicate fs-4'></i></button>
        </div>
    <?php endif; ?>

    <script>
        function deletePackage() {
            let formName = this.event.target.getAttribute('form');

            let deleteConfirm = window.confirm('Are You Sure Do you want to Delete This Package ?');
            if (deleteConfirm) {
                document.getElementById(formName).submit();
                return;
            }
            return;
        }

        function duplicatePackage() {
            let link = this.event.target.getAttribute('href');

            let duplicateConfirm = window.confirm('Are You Sure Do you want to Duplicate This Package ?');
            if (duplicateConfirm) {
                window.location.href = link;
                return;
            }
            return;
        }
    </script>