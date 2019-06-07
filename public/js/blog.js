document.querySelectorAll('.commenting').forEach(el => {
    el.addEventListener('click', () => {
        el.parentElement.nextElementSibling.style.display = 
            el.parentElement.nextElementSibling.style.display === 'block' ? 'none' : 'block';
            el.innerHTML = el.parentElement.nextElementSibling.style.display ===
                'block' ? 'Отменить' : 'Добавить комментарий';
    })
});

document.querySelectorAll('.send-comment').forEach(el => {
    el.addEventListener('click', () => {
        sendComment(el.parentElement);
        el.parentElement.previousElementSibling.lastElementChild.click();
    })
});

function sendComment(myform){
    let iframe;
    iframe = document.createElement('iframe');
    iframe.name = myform.target = Date.parse(new Date);
    iframe.style.display = 'none';
    iframe.onload = iframe.onreadystatechange = function(){
        const note_id = myform['note_id'].value;

        document.getElementById(note_id).lastElementChild.innerHTML =
            this.contentWindow.document.getElementById(note_id).lastElementChild.innerHTML;
        iframe.parentElement.removeChild(iframe);
    };
    document.body.insertBefore(iframe, document.body.firstElementChild);
    myform.submit();
}

document.querySelectorAll('.change-note').forEach(el => {
    el.addEventListener('click', () => {
        const note = el.parentElement;
        const topic_note = note.querySelector('.topic-note');
        const text_note = note.querySelector('.text-note');

        const form = document.createElement('form');
        form.method = 'post';
        form.action = '/admin/EditorBlog/index'
        document.body.appendChild(form);

        if (el.innerHTML == 'Изменить'){

            const topic_input = document.createElement('input');
            const text_input = document.createElement('textarea');

            topic_input.value = topic_note.innerHTML;
            text_input.innerHTML = text_note.innerHTML;

            topic_input.name = 'topic_input';
            text_input.name = 'text_input';

            topic_input.classList.add('edit-topic');
            text_input.classList.add('edit-text');

            form.appendChild(topic_input);
            form.appendChild(text_input);
            note.insertBefore(form, note.children[2]);
            el.innerHTML = 'Сохранить';
        }
        else {
            const topic_input = note.querySelector('.edit-topic');
            const text_input = note.querySelector('.edit-text');

            topic_note.innerHTML = topic_input.value;
            text_note.innerHTML = text_input.value;

            topic_note.style.display = 'block';
            text_note.style.display = 'block';

            const noteObj = {
                noteId: note.id,
                topic_note: topic_note.innerHTML,
                text_note: text_note.innerHTML
            };

            query = "/admin/editorBlog/index";
            const xhr = new XMLHttpRequest();
            xhr.open("POST",query,true);
            xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');

            xhr.onreadystatechange = function(){
                try {
                    if (xhr.readyState == 4){
                        if (xhr.status != 200){
                            alert("Не удалось получить данные\n" + xhr.statusText);
                            return
                        }
                    }
                }
                catch (e) {
                    alert('Caught Exception: ' + e.description);
                }
            };

            //xhr.send(JSON.stringify(noteObj));

            note.removeChild(topic_input.parentElement);
            el.innerHTML = 'Изменить';
        }
    })
});







