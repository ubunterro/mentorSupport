function addElem(butt) {
    butt.insertAdjacentHTML('afterend', '<div class = orgListElem>\n' +
        '                    <input type="text" name="personalName[]" placeholder="Имя Фамилия">\n' +
        '                    <select name="participantType[]">\n' +
        '                    <option>Ментор</option>\n' +
        '                    <option>Организатор</option>\n' +
        '                    </select>\n' +
        '                    <input type="text" name="lastActive[]" placeholder="Время активности на сайте для ответов">\n' +
        '                    <select name="questionType[]">\n' +
        '                    <option>Технические вопросы</option>\n' +
        '                    <option>Организационные вопросы</option>\n' +
        '                    <option>Коммуникационные вопросы</option>\n' +
        '                    <option>Вопросы по задачам хакатона</option>\n' +
        '                    <option>Другие вопросы</option>\n' +
        '                    </select>\n' +
        '                    <input type="text" name="email[]" placeholder="email">\n' +
        '                    <input type="button" name="add" value="+" onclick="addElem(this)">\n' +
        '                </div>');
};