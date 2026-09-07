function addedTag() {
    const input = document.getElementById('tags');
    let currentTags = input.value.split(',').map(t => t.trim()).filter(t => t);
    const tagButtons = document.querySelectorAll('.tag');

    tagButtons.forEach(button => {
        const tag = button.textContent.trim();
        if (currentTags.includes(tag)) {
            button.classList.remove('text-bg-dark');
            button.classList.add('text-bg-warning');
        } else {
            button.classList.remove('text-bg-warning');
            button.classList.add('text-bg-dark');
        }
    });
}

function addTag(tag) {
    const input = document.getElementById('tags');
    let currentTags = input.value.split(',').map(t => t.trim()).filter(t => t);
    if (!currentTags.includes(tag)) {
        currentTags.push(tag);
        input.value = currentTags.join(',');
    } else {
        currentTags.splice(currentTags.indexOf(tag), 1);
        input.value = currentTags.join(',');
    }

    addedTag();
}

function addBadge(badge) {
    const input = document.getElementById('badge');
    input.value = badge;
}