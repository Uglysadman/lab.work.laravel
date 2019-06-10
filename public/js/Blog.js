document.querySelectorAll('.change-post').forEach(el => {
    el.addEventListener('click', () => {
        el.parentElement.nextElementSibling.style.display =
            el.parentElement.nextElementSibling.style.display === 'block' ? 'none' : 'block';
        el.innerHTML = el.parentElement.nextElementSibling.style.display ===
        'block' ? 'Отменить' : 'Изменить';
    })
});

document.querySelectorAll('.add-comment').forEach(el => {
    el.addEventListener('click', () => {
        el.parentElement.nextElementSibling.style.display =
            el.parentElement.nextElementSibling.style.display === 'block' ? 'none' : 'block';
        el.innerHTML = el.parentElement.nextElementSibling.style.display ===
        'block' ? 'Отменить' : 'Добавть комментарий';
    })
});