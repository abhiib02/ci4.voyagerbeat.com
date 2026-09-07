let name = document.querySelector("#package_name");
let slug = document.querySelector("#package_slug");
name.addEventListener("input", (e) => {
    slug.value = name.value.trim()
        .toLowerCase()
        .replace(/[^\w\s-]/g, '') // remove non-word characters
        .replace(/\s+/g, '-') // replace multiple spaces with dash
        .replace(/\|/g, '-')
        .replace(/--+/g, '-');
    //slug.value = name.value.replaceAll(" ", "-").toLowerCase();
});