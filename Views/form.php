
<form action="<?= App::$params['basic_url']?>/home/index" method="post">
    <div class="input">
        <label>Число ячеек</label><br>
        <input type="number" name="fieldsCount" placeholder="Введите чисо ячеек" value="" min="1" max="250" required />
    </div>
    <div class="input">
        <label>Число фишек</label><br>
        <input type="number" name="chipCount" placeholder="Введите чисо фишек" value="" min="1" max="250" required />
    </div>
    <div class="input"><button type="submit">Расчитать</button></div>
</form>

<style type="text/css">
    div.input {
        padding-top: 10px;
        padding-bottom:10px;
    }
    input {
        border: 4px double black;
        width: 200px;
    }

    input:invalid:not(:placeholder-shown) {border-color: red;}
    input:valid:not(:placeholder-shown) {border-color: green;}
</style>