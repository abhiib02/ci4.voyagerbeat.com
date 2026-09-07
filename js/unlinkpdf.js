
    function unlinkPDF() {
        if (confirm("Are you sure you want to unlink the PDF?")) {
            document.getElementById('package_pdf').value = '';
            document.getElementById('pdf').value = '';
            document.getElementById('linked_pdf').innerText = '(Current PDF : None)';
            alert("PDF unlinked. Changes will be saved after clicking the 'Update Package' button.");
        }
    }
