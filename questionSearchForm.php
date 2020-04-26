<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/searchForm.css">
</head>

<body>
    <div class="wrapper">
        <div class="header">Есть вопросы? Так пиши скорее!</div>
        <div class="submitform">
            <select class="qselect" name="question">
                <option></option>
                <option value="Кеш хуеш">Кеш хуеш</option>
            </select>
        </div>
    </div>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/select2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.qselect').select2({
            placeholder: 'А как какать...?',
            allowClear: true,
            language: {
                "noResults": function() {
                    return "<center>Не нашёл похожего вопроса?</center><center><a href='#' class='btn btn-danger'>Задай свой вопрос напрямую!</a></center>";
                }
            },
            escapeMarkup: function(markup) {
                return markup;
            }
        });
    });
</script>

</html>